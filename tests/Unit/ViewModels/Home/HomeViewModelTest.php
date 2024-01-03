<?php

namespace Tests\Unit\ViewModels\Home;

use App\Http\ViewModels\Home\HomeViewModel;
use App\Models\Name;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class HomeViewModelTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_gets_the_twenty_popular_names(): void
    {
        $maleName = Name::factory()->create([
            'gender' => 'male',
            'name' => 'JEAN-JACQUES',
            'unisex' => 0,
        ]);
        $femaleName = Name::factory()->create([
            'gender' => 'female',
            'name' => 'HÉLOÏSE',
            'unisex' => 1,
        ]);

        $array = HomeViewModel::twentyMostPopularNames();

        $this->assertCount(4, $array);
        $this->assertArrayHasKey('male_names', $array);
        $this->assertArrayHasKey('female_names', $array);
        $this->assertArrayHasKey('mixted_names', $array);
        $this->assertArrayHasKey('random_names', $array);

        $this->assertEquals(
            [
                0 => [
                    'id' => $maleName->id,
                    'name' => 'Jean-Jacques',
                    'url' => [
                        'show' => env('APP_URL') . '/prenoms/' . $maleName->id . '/jean-jacques',
                        'favorite' => env('APP_URL') . '/prenoms/' . $maleName->id . '/favorite',
                    ],
                ],
            ],
            $array['male_names']->toArray()
        );

        $this->assertEquals(
            [
                0 => [
                    'id' => $femaleName->id,
                    'name' => 'Héloïse',
                    'url' => [
                        'show' => env('APP_URL') . '/prenoms/' . $femaleName->id . '/heloise',
                        'favorite' => env('APP_URL') . '/prenoms/' . $femaleName->id . '/favorite',
                    ],
                ],
            ],
            $array['female_names']->toArray()
        );

        $this->assertEquals(
            [
                0 => [
                    'id' => $femaleName->id,
                    'name' => 'Héloïse',
                    'url' => [
                        'show' => env('APP_URL') . '/prenoms/' . $femaleName->id . '/heloise',
                        'favorite' => env('APP_URL') . '/prenoms/' . $femaleName->id . '/favorite',
                    ],
                ],
            ],
            $array['mixted_names']->toArray()
        );
    }

    /** @test */
    public function it_gets_the_name_that_is_in_the_spotlight(): void
    {
        $name = Name::factory()->create([
            'name' => 'JEAN-JACQUES',
            'total' => 1000000,
            'origins' => 'This is the origins of the name Jean-Jacques and it is very long and this is insane because i want to test if Occaecat tempor aliqua nostrud magna adipisicing nulla excepteur ea. Occaecat tempor aliqua nostrud magna adipisicing nulla excepteur ea. This is the origins of the name Jean-Jacques and it is very long and this is insane because i want to test if Occaecat tempor aliqua nostrud magna adipisicing nulla excepteur ea. Occaecat tempor aliqua nostrud magna adipisicing nulla excepteur ea.',
        ]);
        $array = HomeViewModel::nameSpotlight();

        $this->assertEquals(
            [
                'id' => $name->id,
                'name' => 'Jean-Jacques',
                'origins' => 'This is the origins of the name Jean-Jacques and it is very long and this is insane because i want to test if Occaecat tempor aliqua nostrud magna adipisicing nulla excepteur ea. Occaecat tempor aliqua nostrud magna adipisicing nulla excepteur ea. This is the origins of the name Jean-Jacques and...',
                'url' => env('APP_URL') . '/prenoms/' . $name->id . '/jean-jacques',
            ],
            $array
        );
    }

    /** @test */
    public function it_gets_the_stats_of_the_server(): void
    {
        $name = Name::factory()->count(1000)->create();
        $array = HomeViewModel::serverStats();

        $this->assertEquals(
            [
                'total_names' => '1 000',
            ],
            $array
        );
    }
}
