<?php

namespace App\Jobs;

use App\Helpers\OpenAIHelper;
use App\Models\Name;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessSyllabes implements ShouldQueue
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
        if ($this->name->syllabes === 0) {
            $number = OpenAIHelper::getSyllabes($this->name->name);

            $this->name->syllabes = (int) $number;
            $this->name->save();
        }
    }
}
