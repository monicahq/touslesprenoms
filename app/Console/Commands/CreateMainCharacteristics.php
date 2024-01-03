<?php

namespace App\Console\Commands;

use App\Models\Characteristic;
use App\Models\Name;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class CreateMainCharacteristics extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'openname:create-main-characteristics';

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

            if (is_null($name->characteristics)) {
                continue;
            }

            $strings = explode(',', $name->characteristics);
            foreach ($strings as $string) {
                // lowercase
                $lowercase = Str::lower($string);

                // remove the space at the beginning and the end
                $string = Str::of($lowercase)->trim()->__toString();

                // remove any comma or dot at the end
                $string = Str::of($string)->rtrim(',.')->__toString();

                // count the number of words and skip the word if there is more than 1
                $words = explode(' ', $string);
                if (count($words) > 1) {
                    continue;
                }

                $characteristic = Characteristic::firstOrCreate([
                    'name' => $string,
                ]);

                $name->mainCharacteristics()->syncWithoutDetaching([$characteristic->id]);
            }
        }
    }
}
