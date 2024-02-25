<?php

namespace Tests\Unit\ViewModels\Names;

use App\Http\ViewModels\Names\NameViewModel;
use App\Models\Name;
use App\Models\NameStatistic;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class NameViewModelTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_gets_the_summary_of_a_name(): void
    {
        $name = Name::factory()->create([
            'name' => 'HÉLOÏSE',
        ]);

        $array = NameViewModel::summary($name);

        $this->assertArrayHasKey('id', $array);
        $this->assertArrayHasKey('name', $array);
        $this->assertArrayHasKey('url', $array);

        $this->assertEquals(
            [
                'id' => $name->id,
                'name' => 'Héloïse',
                'url' => [
                    'show' => env('APP_URL') . '/prenoms/' . $name->id . '/heloise',
                    'favorite' => env('APP_URL') . '/prenoms/' . $name->id . '/favorite',
                ],
            ],
            $array
        );
    }

    /** @test */
    public function it_gets_the_details_of_a_name(): void
    {
        $name = Name::factory()->create([
            'name' => 'HÉLOÏSE',
            'origins' => 'Origine du prénom Héloïse',
            'personality' => 'Personnalité du prénom Héloïse',
            'syllabes' => 2,
            'celebrities' => 'Célébrités du prénom Héloïse',
            'elfic_traits' => 'Traits elfiques du prénom Héloïse',
            'name_day' => 'Fête du prénom Héloïse',
            'litterature_artistics_references' => 'Références littéraires et artistiques du prénom Héloïse',
            'similar_names_in_other_languages' => 'Autres langues du prénom Héloïse',
            'klingon_translation' => 'Traduction klingonne du prénom Héloïse',
            'total' => 3000,
        ]);

        $array = NameViewModel::details($name);

        $this->assertArrayHasKey('id', $array);
        $this->assertArrayHasKey('name', $array);
        $this->assertArrayHasKey('origins', $array);
        $this->assertArrayHasKey('personality', $array);
        $this->assertArrayHasKey('syllabes', $array);
        $this->assertArrayHasKey('celebrities', $array);
        $this->assertArrayHasKey('elfic_traits', $array);
        $this->assertArrayHasKey('name_day', $array);
        $this->assertArrayHasKey('litterature_artistics_references', $array);
        $this->assertArrayHasKey('similar_names_in_other_languages', $array);
        $this->assertArrayHasKey('klingon_translation', $array);
        $this->assertArrayHasKey('total', $array);
        $this->assertArrayHasKey('gender', $array);
        $this->assertArrayHasKey('mixte', $array);
        $this->assertArrayHasKey('url', $array);

        $this->assertEquals(
            [
                'show' => env('APP_URL') . '/prenoms/' . $name->id . '/heloise',
                'favorite' => env('APP_URL') . '/prenoms/' . $name->id . '/show/favorite',
                'note_edit' => env('APP_URL') . '/notes/' . $name->id,
            ],
            $array['url']
        );
    }

    /** @test */
    public function it_gets_the_stats_per_decade(): void
    {
        $name = Name::factory()->create();
        NameStatistic::factory()->create([
            'name_id' => $name->id,
            'year' => 1903,
            'count' => 100,
        ]);
        NameStatistic::factory()->create([
            'name_id' => $name->id,
            'year' => 1910,
            'count' => 200,
        ]);
        NameStatistic::factory()->create([
            'name_id' => $name->id,
            'year' => 1924,
            'count' => 2,
        ]);
        NameStatistic::factory()->create([
            'name_id' => $name->id,
            'year' => 2021,
            'count' => 391,
        ]);

        $array = NameViewModel::popularity($name);

        $this->assertCount(2, $array);
        $this->assertArrayHasKey('decades', $array);
        $this->assertArrayHasKey('total', $array);
        $this->assertEquals(
            [
                0 => [
                    'decade' => '1900s',
                    'popularity' => 100,
                    'percentage' => '14',
                ],
                1 => [
                    'decade' => '1910s',
                    'popularity' => 200,
                    'percentage' => '29',
                ],
                2 => [
                    'decade' => '1920s',
                    'popularity' => 2,
                    'percentage' => '0',
                ],
                3 => [
                    'decade' => '1930s',
                    'popularity' => 0,
                    'percentage' => '0',
                ],
                4 => [
                    'decade' => '1940s',
                    'popularity' => 0,
                    'percentage' => '0',
                ],
                5 => [
                    'decade' => '1950s',
                    'popularity' => 0,
                    'percentage' => '0',
                ],
                6 => [
                    'decade' => '1960s',
                    'popularity' => 0,
                    'percentage' => '0',
                ],
                7 => [
                    'decade' => '1970s',
                    'popularity' => 0,
                    'percentage' => '0',
                ],
                8 => [
                    'decade' => '1980s',
                    'popularity' => 0,
                    'percentage' => '0',
                ],
                9 => [
                    'decade' => '1990s',
                    'popularity' => 0,
                    'percentage' => '0',
                ],
                10 => [
                    'decade' => '2000s',
                    'popularity' => 0,
                    'percentage' => '0',
                ],
                11 => [
                    'decade' => '2010s',
                    'popularity' => 0,
                    'percentage' => '0',
                ],
                12 => [
                    'decade' => '2020s',
                    'popularity' => 391,
                    'percentage' => '56',
                ],
            ],
            $array['decades']->toArray()
        );
    }

    /** @test */
    public function it_gets_the_data_to_feed_the_json_schema_ld_file(): void
    {
        Carbon::setTestNow(Carbon::create(2018, 1, 1));
        $name = Name::factory()->create([
            'name' => 'HÉLOÏSE',
        ]);
        $array = NameViewModel::jsonLdSchema($name);

        $this->assertEquals(
            [
                'headline' => 'Tout savoir sur le prénom Héloïse',
                'image' => env('APP_URL') . '/img/facebook.png',
                'created_at' => '2018-01-01',
                'updated_at' => '2018-01-01',
                'url' => env('APP_URL') . '/prenoms/' . $name->id . '/heloise',
            ],
            $array
        );
    }

    /** @test */
    public function it_gets_a_collection_of_related_names(): void
    {
        $name1 = Name::factory()->female()->create();
        $name = Name::factory()->female()->create([
            'name' => 'HÉLOÏSE',
        ]);

        $collection = NameViewModel::relatedNames($name1);

        $this->assertEquals(
            [
                0 => [
                    'id' => $name->id,
                    'name' => 'Héloïse',
                    'url' => [
                        'show' => env('APP_URL') . '/prenoms/' . $name->id . '/heloise',
                        'favorite' => env('APP_URL') . '/prenoms/' . $name->id . '/favorite',
                    ],
                ],
            ],
            $collection->toArray()
        );
    }

    /** @test */
    public function it_gets_the_number_associated_with_the_name(): void
    {
        $name = Name::factory()->create([
            'name' => 'HÉLOÏSE',
        ]);

        $number = NameViewModel::numerology($name);
        $this->assertEquals(5, $number);
    }
}
