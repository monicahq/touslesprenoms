<?php

namespace Tests\Unit\ViewModels\Home;

use App\Http\ViewModels\Names\MaleNamesViewModel;
use App\Models\Name;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class MaleNamesViewModelTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_gets_all_the_first_letters_of_the_males_names_and_the_total(): void
    {
        Name::factory()->create([
            'name' => 'PIERÔÏ',
            'gender' => 'male',
        ]);

        $collection = MaleNamesViewModel::index();

        $this->assertEquals(
            [
                0 => [
                    'letter' => 'Tous',
                    'count' => '1',
                    'url' => env('APP_URL') . '/prenoms/garcons',
                ],
                1 => [
                    'letter' => 'A',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/garcons/a',
                ],
                2 => [
                    'letter' => 'B',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/garcons/b',
                ],
                3 => [
                    'letter' => 'C',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/garcons/c',
                ],
                4 => [
                    'letter' => 'D',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/garcons/d',
                ],
                5 => [
                    'letter' => 'E',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/garcons/e',
                ],
                6 => [
                    'letter' => 'F',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/garcons/f',
                ],
                7 => [
                    'letter' => 'G',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/garcons/g',
                ],
                8 => [
                    'letter' => 'H',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/garcons/h',
                ],
                9 => [
                    'letter' => 'I',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/garcons/i',
                ],
                10 => [
                    'letter' => 'J',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/garcons/j',
                ],
                11 => [
                    'letter' => 'K',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/garcons/k',
                ],
                12 => [
                    'letter' => 'L',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/garcons/l',
                ],
                13 => [
                    'letter' => 'M',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/garcons/m',
                ],
                14 => [
                    'letter' => 'N',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/garcons/n',
                ],
                15 => [
                    'letter' => 'O',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/garcons/o',
                ],
                16 => [
                    'letter' => 'P',
                    'count' => '1',
                    'url' => env('APP_URL') . '/prenoms/garcons/p',
                ],
                17 => [
                    'letter' => 'Q',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/garcons/q',
                ],
                18 => [
                    'letter' => 'R',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/garcons/r',
                ],
                19 => [
                    'letter' => 'S',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/garcons/s',
                ],
                20 => [
                    'letter' => 'T',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/garcons/t',
                ],
                21 => [
                    'letter' => 'U',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/garcons/u',
                ],
                22 => [
                    'letter' => 'V',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/garcons/v',
                ],
                23 => [
                    'letter' => 'W',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/garcons/w',
                ],
                24 => [
                    'letter' => 'X',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/garcons/x',
                ],
                25 => [
                    'letter' => 'Y',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/garcons/y',
                ],
                26 => [
                    'letter' => 'Z',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/garcons/z',
                ],
            ],
            $collection->toArray()
        );
    }
}
