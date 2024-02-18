<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use Psr\Http\Message\UriInterface;
use Spatie\Crawler\CrawlProfiles\CrawlProfile;

class CustomCrawlProfile extends CrawlProfile
{
    public function shouldCrawl(UriInterface $url): bool
    {
        if ($url->getQuery() !== ''
            || Str::isMatch('/\/prenoms\/\d+\/\w+/', $url->getPath())) {
            return false;
        }

        return true;
    }
}
