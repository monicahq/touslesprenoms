<?php

namespace App\Jobs;

use App\Helpers\OpenAIHelper;
use App\Models\Name;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessCountryOfOrigin implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Name $name
    ) {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if ($this->name->country_of_origin === null) {
            $countryOfOrigin = OpenAIHelper::getCountryOfOrigin($this->name->name);
            $this->name->country_of_origin = $countryOfOrigin;
            $this->name->save();
        }
    }
}
