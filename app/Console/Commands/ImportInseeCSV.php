<?php

namespace App\Console\Commands;

use App\Models\Name;
use App\Models\NameStatistic;
use Illuminate\Console\Command;
use Spatie\SimpleExcel\SimpleExcelReader;

class ImportInseeCSV extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'openname:import';

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
        $oldName = null;
        $name = null;

        $rows = SimpleExcelReader::create(public_path('new.csv'))
            ->getRows()
            ->each(function (array $rowProperties) use (&$oldName, &$name) {
                if ($oldName !== $rowProperties['preusuel']) {
                    $oldName = $rowProperties['preusuel'];

                    $gender = match ($rowProperties['sexe']) {
                        '1' => 'male',
                        '2' => 'female',
                        default => 'unknown',
                    };

                    $name = Name::create([
                        'gender' => $gender,
                        'name' => $rowProperties['preusuel'],
                    ]);
                }

                if ($rowProperties['annais'] === 'XXXX') {
                    return;
                }

                NameStatistic::create([
                    'name_id' => $name->id,
                    'year' => $rowProperties['annais'],
                    'count' => $rowProperties['nombre'],
                ]);
            });

        $this->artisan('☐ Counting total after import', 'openname:count-total-after-import');
    }

    private function artisan(string $message, string $command, array $arguments = []): void
    {
        $this->info($message);
        $this->callSilent($command, $arguments);
    }
}
