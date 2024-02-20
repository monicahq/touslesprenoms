<?php

namespace Tests\Unit\ViewModels\User;

use App\Http\ViewModels\User\PublicListViewModel;
use App\Models\Name;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class PublicListViewModelTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_gets_the_list_of_names_in_the_list(): void
    {
        $name = Name::factory()->create([
            'name' => 'test',
            'total' => 1000,
            'origins' => 'test',
        ]);
        $user = User::factory()->create();
        $nameList = $user->lists()->create([
            'is_list_of_favorites' => true,
            'uuid' => '1234567890',
        ]);
        $nameList->names()->attach($name->id);

        $this->be($user);

        $array = PublicListViewModel::show($nameList);

        $this->assertCount(6, $array);
        $this->assertArrayHasKey('id', $array);
        $this->assertArrayHasKey('name', $array);
        $this->assertArrayHasKey('description', $array);
        $this->assertArrayHasKey('names', $array);
        $this->assertArrayHasKey('url', $array);
        $this->assertEquals(
            [
                0 => [
                    'id' => $name->id,
                    'name' => 'Test',
                    'total' => '1 000',
                    'public_note' => null,
                    'url' => [
                        'show' => env('APP_URL') . '/prenoms/' . $name->id . '/test',
                        'favorite' => env('APP_URL') . '/prenoms/' . $name->id . '/favorite',
                    ],
                ],
            ],
            $array['names']->toArray()
        );
    }
}
