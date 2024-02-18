<?php

namespace App\Console\Commands;

use App\Models\Name;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\SitemapIndex;
use Spatie\Sitemap\Tags\Sitemap as SitemapTag;

class GenerateSitemap extends Command
{
    public const PREFIX_PATH = 'sitemap';

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
        $sitemapIndex = SitemapIndex::create();

        SitemapGenerator::create(config('app.url'))
            ->writeToFile(public_path(static::PREFIX_PATH . '/sitemap_00.xml'));

        $sitemapIndex->add(SitemapTag::create(url(static::PREFIX_PATH . '/sitemap_00.xml')));

        $this->sitemap_names($sitemapIndex);

        $sitemapIndex->writeToFile(public_path(static::PREFIX_PATH . '/sitemap.xml'));

        // Replace sitemap in robots.txt
        $robots = File::get(public_path('robots.txt'));
        $robots = Str::of($robots)->replaceMatches('/Sitemap: .*/', 'Sitemap: ' . url(static::PREFIX_PATH . '/sitemap.xml'));
        File::put(public_path('robots.txt'), $robots);
    }

    /**
     * Get names sitemap.
     */
    private function sitemap_names(SitemapIndex $sitemapIndex): void
    {
        Name::where('name', '!=', '_PRENOMS_RARES')
            ->chunkById(2000, function (Collection $names, int $key) use ($sitemapIndex) {

                $file = static::PREFIX_PATH . '/sitemap_' . Str::padLeft("$key", 2, '0') . '.xml';

                Sitemap::create()
                    ->add($names)
                    ->writeToFile(public_path($file));

                $sitemapIndex->add(SitemapTag::create(url($file)));
            }, 'id');
    }
}
