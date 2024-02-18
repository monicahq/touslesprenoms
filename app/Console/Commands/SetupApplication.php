<?php

namespace App\Console\Commands;

use Illuminate\Console\ConfirmableTrait;
use Illuminate\Support\Facades\Schema;

/**
 * @codeCoverageIgnore
 */
class SetupApplication extends Command
{
    use ConfirmableTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setup
                            {--force : Force the operation to run when in production.}
                            {--skip-storage-link : Skip storage link create.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install or update the application, and run migrations after a new release';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        if ($this->confirmToProceed()) {
            try {
                $this->artisan('✓ Maintenance mode: on', 'down', [
                    '--retry' => '10',
                ]);
                $this->resetCache();
                $this->clearConfig();
                $this->symlink();
                $this->migrate();
                $this->cacheConfig();
                $this->scout();
                $this->sitemap();
                $this->cloudflare();
            } finally {
                $this->artisan('✓ Maintenance mode: off', 'up');
            }
        }
    }

    /**
     * Clear or rebuild all cache.
     */
    protected function resetCache(): void
    {
        if (config('cache.default') !== 'database' || Schema::hasTable(config('cache.stores.database.table'))) {
            $this->artisan('✓ Resetting application cache', 'cache:clear');
        }
    }

    /**
     * Clear configuration.
     */
    protected function clearConfig(): void
    {
        if ($this->getLaravel()->environment() === 'production') {
            $this->artisan('✓ Clear config cache', 'config:clear');
            $this->artisan('✓ Resetting route cache', 'route:cache');
            $this->artisan('✓ Resetting view cache', 'view:clear');
        } else {
            $this->artisan('✓ Clear config cache', 'config:clear');
            $this->artisan('✓ Clear route cache', 'route:clear');
            $this->artisan('✓ Clear view cache', 'view:clear');
        }
    }

    /**
     * Cache configuration.
     */
    protected function cacheConfig(): void
    {
        // Cache config
        if ($this->getLaravel()->environment() === 'production'
            && (config('cache.default') !== 'database' || Schema::hasTable(config('cache.stores.database.table')))) {
            $this->artisan('✓ Cache configuraton', 'config:cache');
        }
    }

    /**
     * Symlink storage to public.
     */
    protected function symlink(): void
    {
        if ($this->option('skip-storage-link') !== true
            && $this->getLaravel()->environment() !== 'testing'
            && ! file_exists(public_path('storage'))) {
            $this->artisan('✓ Symlink the storage folder', 'storage:link');
        }
    }

    /**
     * Run migrations.
     */
    protected function migrate(): void
    {
        $this->artisan('✓ Performing migrations', 'migrate', ['--force' => true]);
    }

    /**
     * Configure scout.
     */
    protected function scout(): void
    {
        $this->artisan('✓ Setup scout', 'scout:setup', ['--force' => true]);
    }

    /**
     * Reload cloudflare ips.
     */
    protected function cloudflare(): void
    {
        if ((bool) config('laravelcloudflare.enabled')) {
            $this->artisan('✓ Reload cloudflare ips', 'cloudflare:reload');
        }
    }

    /**
     * Setup sitemap.
     */
    protected function sitemap(): void
    {
        if ($this->getLaravel()->environment() === 'production') {
            $this->artisan('✓ Generate sitemap', 'sitemap:generate');
        }
    }
}
