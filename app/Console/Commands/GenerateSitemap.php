<?php

namespace App\Console\Commands;

use App\Models\Name;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the sitemap.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $sitemap = Sitemap::create();

        Name::where('name', '!=', '_PRENOMS_RARES')
            ->get()
            ->each(function (Name $name) use ($sitemap) {
                $sitemap->add(
                    Url::create(route('name.show', [
                        'id' => $name->id,
                        'name' => $name->name,
                    ]))
                        ->setPriority(0.9)
                        ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                );
            });

        $sitemap->writeToFile(public_path('sitemap.xml'));
    }
}
