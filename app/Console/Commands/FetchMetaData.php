<?php

namespace App\Console\Commands;

use App\Jobs\ProcessCelebrities;
use App\Jobs\ProcessCountryOfOrigin;
use App\Jobs\ProcessElficTraits;
use App\Jobs\ProcessKlingonName;
use App\Jobs\ProcessLitteratureReferences;
use App\Jobs\ProcessOrigins;
use App\Jobs\ProcessPersonality;
use App\Jobs\ProcessSimilarNames;
use App\Models\Name;
use Illuminate\Console\Command;

class FetchMetaData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'openname:fetch-meta-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        foreach (Name::orderBy('total', 'desc')->lazy() as $name) {
            dd($name);
            if ($name->name === '_PRENOMS_RARES') {
                continue;
            }

            if ($name->origins === null) {
                ProcessOrigins::dispatch($name);
            }

            if ($name->personality === null) {
                ProcessPersonality::dispatch($name);
            }

            if ($name->country_of_origin === null) {
                ProcessCountryOfOrigin::dispatch($name);
            }

            if ($name->celebrities === null) {
                ProcessCelebrities::dispatch($name);
            }

            if ($name->elfic_traits === null) {
                ProcessElficTraits::dispatch($name);
            }

            if ($name->litterature_artistics_references === null) {
                ProcessLitteratureReferences::dispatch($name);
            }

            if ($name->similar_names_in_other_languages === null) {
                ProcessSimilarNames::dispatch($name);
            }

            if ($name->klingon_translation === null) {
                //ProcessKlingonName::dispatch($name);
            }
        }
    }
}
