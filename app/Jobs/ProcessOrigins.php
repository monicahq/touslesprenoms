<?php

namespace App\Jobs;

use App\Helpers\OpenAIHelper;
use App\Models\Name;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessOrigins implements ShouldQueue
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
        if ($this->name->origins === null) {
            $origins = OpenAIHelper::getOrigin($this->name->name);
            $this->name->origins = $origins;
            $this->name->save();
        }
    }
}
