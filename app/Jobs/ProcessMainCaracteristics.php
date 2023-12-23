<?php

namespace App\Jobs;

use App\Helpers\OpenAIHelper;
use App\Models\Characteristic;
use App\Models\Name;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class ProcessMainCaracteristics implements ShouldQueue
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
        if (is_null($this->name->characteristics)) {
            $strings = OpenAIHelper::getMainCharacteristics($this->name->name);

            $this->name->characteristics = Str::lower($strings);
            $this->name->save();
        }
    }
}
