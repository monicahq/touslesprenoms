<?php

namespace App\Jobs;

use App\Models\Name;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class IncrementPageViewForName implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public int $nameId
    ) { }

    public function handle(): void
    {
        // we use the DB facade and not the model for performance reasons
        // if we call the model inside the job, the model will be serialized
        // and will consume resources. we don't need to serialize the model for
        // this operation.
        DB::table('names')
            ->where('id', $this->nameId)
            ->increment('page_views');
    }
}
