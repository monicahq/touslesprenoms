<?php

namespace Tests\Unit\ViewModels\Home;

use App\Http\ViewModels\Names\FemaleNamesViewModel;
use App\Models\Name;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class FemaleNamesViewModelTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_gets_all_the_first_letters_of_the_males_names_and_the_total(): void
    {
        Name::factory()->create([
            'name' => 'HÉLOÏSE',
            'gender' => 'female',
        ]);

        $collection = FemaleNamesViewModel::index();

        $this->assertEquals(
            [
                0 => [
                    'letter' => 'Tous',
                    'count' => '1',
                    'url' => env('APP_URL') . '/prenoms/filles',
                ],
                1 => [
                    'letter' => 'A',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/filles/a',
                ],
                2 => [
                    'letter' => 'B',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/filles/b',
                ],
                3 => [
                    'letter' => 'C',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/filles/c',
                ],
                4 => [
                    'letter' => 'D',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/filles/d',
                ],
                5 => [
                    'letter' => 'E',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/filles/e',
                ],
                6 => [
                    'letter' => 'F',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/filles/f',
                ],
                7 => [
                    'letter' => 'G',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/filles/g',
                ],
                8 => [
                    'letter' => 'H',
                    'count' => '1',
                    'url' => env('APP_URL') . '/prenoms/filles/h',
                ],
                9 => [
                    'letter' => 'I',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/filles/i',
                ],
                10 => [
                    'letter' => 'J',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/filles/j',
                ],
                11 => [
                    'letter' => 'K',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/filles/k',
                ],
                12 => [
                    'letter' => 'L',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/filles/l',
                ],
                13 => [
                    'letter' => 'M',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/filles/m',
                ],
                14 => [
                    'letter' => 'N',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/filles/n',
                ],
                15 => [
                    'letter' => 'O',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/filles/o',
                ],
                16 => [
                    'letter' => 'P',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/filles/p',
                ],
                17 => [
                    'letter' => 'Q',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/filles/q',
                ],
                18 => [
                    'letter' => 'R',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/filles/r',
                ],
                19 => [
                    'letter' => 'S',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/filles/s',
                ],
                20 => [
                    'letter' => 'T',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/filles/t',
                ],
                21 => [
                    'letter' => 'U',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/filles/u',
                ],
                22 => [
                    'letter' => 'V',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/filles/v',
                ],
                23 => [
                    'letter' => 'W',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/filles/w',
                ],
                24 => [
                    'letter' => 'X',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/filles/x',
                ],
                25 => [
                    'letter' => 'Y',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/filles/y',
                ],
                26 => [
                    'letter' => 'Z',
                    'count' => '0',
                    'url' => env('APP_URL') . '/prenoms/filles/z',
                ],
            ],
            $collection->toArray()
        );
    }
}
