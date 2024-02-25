<?php

namespace App\Console\Commands;

use App\Models\Name;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Psr\Http\Message\UriInterface;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\SitemapIndex;
use Spatie\Sitemap\Tags\Sitemap as SitemapTag;
use Spatie\Sitemap\Tags\Url;

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
        $file = $this->file('sitemap.xml');

        $sitemapIndex = SitemapIndex::create();
        $this->sitemap_root($sitemapIndex);
        $this->sitemap_names($sitemapIndex);
        $sitemapIndex->writeToFile($file['file']);

        // Replace sitemap in robots.txt
        $robots = public_path('robots.txt');
        $content = Str::of(File::get($robots))
            ->replaceMatches('/Sitemap: .*/', 'Sitemap: ' . $file['url']);

        File::put($robots, $content);
    }

    /**
     * Get root sitemap.
     */
    private function sitemap_root(SitemapIndex $sitemapIndex): void
    {
        $file = $this->file('sitemap_root.xml');

        SitemapGenerator::create(config('app.url'))
            ->shouldCrawl(function (UriInterface $url): bool {
                return $url->getQuery() === ''
                    && ! Str::isMatch('/\/prenoms\/\d+\/\w+/', $url->getPath());
            })
            ->hasCrawled(function (Url $url) {
                $frequency = Str::isMatch('/\/public\/\w+/', $url->url)
                    || Str::isMatch('/\/prenoms\/\d+\/\w+/', $url->url)
                    || Str::finish($url->url, '/') === Str::finish(config('app.url'), '/')
                    ? Url::CHANGE_FREQUENCY_WEEKLY
                    : Url::CHANGE_FREQUENCY_MONTHLY;
                $url->setChangeFrequency($frequency);

                return $url;
            })
            ->writeToFile($file['file']);

        $sitemapIndex->add(SitemapTag::create($file['url']));
    }

    /**
     * Get names sitemap.
     */
    private function sitemap_names(SitemapIndex $sitemapIndex): void
    {
        Name::nonRares()
            ->chunkById(2000, function (Collection $names, int $key) use ($sitemapIndex) {

                $file = $this->file('sitemap_' . Str::padLeft("$key", 2, '0') . '.xml');

                Sitemap::create()
                    ->add($names)
                    ->writeToFile($file['file']);

                $sitemapIndex->add(SitemapTag::create($file['url']));
            }, 'id');
    }

    /**
     * Get file path and url.
     */
    private function file(string $name): array
    {
        $file = public_path(static::PREFIX_PATH . '/' . $name);
        $this->line("$file ...");

        return [
            'file' => $file,
            'url' => url(static::PREFIX_PATH . '/' . $name),
        ];
    }
}
