<?php

namespace App\Console\Commands;

use App\Jobs\ProcessCelebrities;
use App\Jobs\ProcessCountryOfOrigin;
use App\Jobs\ProcessElficTraits;
use App\Jobs\ProcessKlingonName;
use App\Jobs\ProcessLitteratureReferences;
use App\Jobs\ProcessMainCaracteristics;
use App\Jobs\ProcessMixte;
use App\Jobs\ProcessOrigins;
use App\Jobs\ProcessPersonality;
use App\Jobs\ProcessSimilarNames;
use App\Jobs\ProcessSyllabes;
use App\Models\Name;
use Illuminate\Console\Command;

class FetchMetaData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'touslesprenoms:fetch-meta-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        foreach (Name::orderBy('total', 'desc')->lazy() as $name) {
            if ($name->name === '_PRENOMS_RARES') {
                continue;
            }

            if (is_null($name->origins)) {
                ProcessOrigins::dispatch($name);
            }

            if (is_null($name->personality)) {
                ProcessPersonality::dispatch($name);
            }

            // if (is_null($name->country_of_origin)) {
            //     ProcessCountryOfOrigin::dispatch($name);
            // }

            if (is_null($name->celebrities)) {
                ProcessCelebrities::dispatch($name);
            }

            if (is_null($name->elfic_traits)) {
                ProcessElficTraits::dispatch($name);
            }

            if (is_null($name->litterature_artistics_references)) {
                ProcessLitteratureReferences::dispatch($name);
            }

            if (is_null($name->similar_names_in_other_languages)) {
                ProcessSimilarNames::dispatch($name);
            }

            if (is_null($name->klingon_translation)) {
                //ProcessKlingonName::dispatch($name);
            }

            if (is_null($name->unisex)) {
                ProcessMixte::dispatch($name);
            }

            if ($name->syllabes === 0) {
                ProcessSyllabes::dispatch($name);
            }

            if (is_null($name->characteristics)) {
                ProcessMainCaracteristics::dispatch($name);
            }
        }
    }
}
