<?php

namespace Tests\Unit\ViewModels\Names;

use App\Http\ViewModels\Names\AllNamesViewModel;
use App\Models\Name;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AllNamesViewModelTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_gets_all_the_first_letters_of_all_names_and_the_total(): void
    {
        Name::factory()->create([
            'name' => 'HÉLOÏSE',
        ]);

        $collection = AllNamesViewModel::index();

        $this->assertEquals(
            [
                0 => [
                    'letter' => 'Tous',
                    'count' => '1',
                    'url' => env('APP_URL') . '/prenoms',
                ],
                1 => [
                    'letter' => 'A',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/a',
                ],
                2 => [
                    'letter' => 'B',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/b',
                ],
                3 => [
                    'letter' => 'C',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/c',
                ],
                4 => [
                    'letter' => 'D',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/d',
                ],
                5 => [
                    'letter' => 'E',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/e',
                ],
                6 => [
                    'letter' => 'F',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/f',
                ],
                7 => [
                    'letter' => 'G',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/g',
                ],
                8 => [
                    'letter' => 'H',
                    'count' => '1',
                    'url' => env('APP_URL') . '/prenoms/h',
                ],
                9 => [
                    'letter' => 'I',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/i',
                ],
                10 => [
                    'letter' => 'J',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/j',
                ],
                11 => [
                    'letter' => 'K',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/k',
                ],
                12 => [
                    'letter' => 'L',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/l',
                ],
                13 => [
                    'letter' => 'M',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/m',
                ],
                14 => [
                    'letter' => 'N',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/n',
                ],
                15 => [
                    'letter' => 'O',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/o',
                ],
                16 => [
                    'letter' => 'P',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/p',
                ],
                17 => [
                    'letter' => 'Q',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/q',
                ],
                18 => [
                    'letter' => 'R',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/r',
                ],
                19 => [
                    'letter' => 'S',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/s',
                ],
                20 => [
                    'letter' => 'T',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/t',
                ],
                21 => [
                    'letter' => 'U',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/u',
                ],
                22 => [
                    'letter' => 'V',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/v',
                ],
                23 => [
                    'letter' => 'W',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/w',
                ],
                24 => [
                    'letter' => 'X',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/x',
                ],
                25 => [
                    'letter' => 'Y',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/y',
                ],
                26 => [
                    'letter' => 'Z',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/z',
                ],
            ],
            $collection->toArray()
        );
    }
}
