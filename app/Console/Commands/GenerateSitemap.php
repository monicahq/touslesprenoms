<?php

namespace App\Console\Commands;

use App\Models\Name;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\SitemapIndex;
use Spatie\Sitemap\Tags\Sitemap as SitemapTag;
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
        $sitemapIndex = SitemapIndex::create();

        Name::where('name', '!=', '_PRENOMS_RARES')
            ->chunkById(2000, function (Collection $names, int $key) use ($sitemapIndex) {

                $file = 'sitemap_' . Str::padLeft($key, 2, '0') . '.xml';
                $sitemap = Sitemap::create();

                $names->each(function (Name $name) use ($sitemap) {
                    $sitemap->add(
                        Url::create(route('name.show', [
                            'id' => $name->id,
                            'name' => Str::lower($name->name),
                        ]))
                            ->setPriority(0.9)
                            ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                            ->setLastModificationDate($name->updated_at)
                    );
                });

                $sitemap->writeToFile(public_path($file));
                $sitemap = null;

                $sitemapIndex->add(SitemapTag::create(url($file)));
            }, 'id');

        $sitemapIndex->writeToFile(public_path('sitemap.xml'));
    }
}
