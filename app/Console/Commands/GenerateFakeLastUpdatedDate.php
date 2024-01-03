<?php

namespace App\Console\Commands;

use App\Models\Name;
use Carbon\Carbon;
use Illuminate\Console\Command;

class GenerateFakeLastUpdatedDate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'openname:last-update';

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
            // generate a fake date in the last two years for the last updated date
            $name->updated_at = Carbon::now()->subDays(rand(1, 320));
            $name->save();
        }
    }
}
