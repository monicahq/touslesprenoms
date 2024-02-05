<?php

namespace App\Console\Commands;

use App\Models\Name;
use Illuminate\Console\Command;

/**
 * @codeCoverageIgnore
 */
class CountTotalAfterImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'touslesprenoms:count-total-after-import';

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
        foreach (Name::lazy() as $name) {
            $total = $name->nameStatistics()->sum('count');
            $name->total = $total;
            $name->save();
        }
    }
}
