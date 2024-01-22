<?php

namespace Tests\Unit\ViewModels\User;

use App\Http\ViewModels\User\ListViewModel;
use App\Models\Name;
use App\Models\NameList;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ListViewModelTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_gets_the_lists_of_the_user(): void
    {
        $name = Name::factory()->create();
        $user = User::factory()->create();
        $nameList = $user->lists()->create([
            'name' => 'Ma liste',
            'description' => 'Ma description',
            'is_list_of_favorites' => false,
        ]);
        $nameList->names()->attach($name->id);

        $this->be($user);

        $array = ListViewModel::index();

        $this->assertCount(1, $array['lists']);
        $this->assertArrayHasKey('lists', $array);

        $this->assertEquals(
            [
                0 => [
                    'id' => $nameList->id,
                    'name' => 'Ma liste',
                    'total' => '1',
                    'url' => [
                        'show' => env('APP_URL') . '/listes/' . $nameList->id,
                    ],
                ],
            ],
            $array['lists']->toArray()
        );
    }

    /** @test */
    public function it_gets_the_list_of_names_in_the_list(): void
    {
        $name = Name::factory()->create([
            'name' => 'test',
            'total' => 1000,
        ]);
        $user = User::factory()->create();
        $nameList = $user->lists()->create([
            'is_list_of_favorites' => true,
            'uuid' => '1234567890',
        ]);
        $nameList->names()->attach($name->id);

        $this->be($user);

        $array = ListViewModel::show($nameList);

        $this->assertCount(6, $array);
        $this->assertArrayHasKey('id', $array);
        $this->assertArrayHasKey('name', $array);
        $this->assertArrayHasKey('description', $array);
        $this->assertArrayHasKey('names', $array);
        $this->assertArrayHasKey('uuid', $array);
        $this->assertArrayHasKey('url', $array);
        $this->assertEquals(
            [
                0 => [
                    'id' => $name->id,
                    'total' => '1 000',
                    'name' => 'Test',
                    'url' => [
                        'show' => env('APP_URL') . '/prenoms/' . $name->id . '/test',
                        'destroy' => env('APP_URL') . '/listes/' . $nameList->id . '/prenoms/' . $name->id,
                    ],
                ],
            ],
            $array['names']->toArray()
        );
    }

    /** @test */
    public function it_gets_the_list_details_for_the_edit_page(): void
    {
        $name = Name::factory()->create();
        $nameList = NameList::factory()->create([
            'name' => 'Ma liste',
            'description' => 'Ma description',
        ]);
        $nameList->names()->attach($name->id);

        $array = ListViewModel::edit($nameList);

        $this->assertCount(4, $array);

        $this->assertEquals(
            [
                'id' => $nameList->id,
                'name' => 'Ma liste',
                'description' => 'Ma description',
                'url' => [
                    'update' => env('APP_URL') . '/listes/' . $nameList->id,
                ],
            ],
            $array
        );
    }

    /** @test */
    public function it_gets_the_list_details_for_the_delete_page(): void
    {
        $name = Name::factory()->create();
        $nameList = NameList::factory()->create([
            'name' => 'Ma liste',
        ]);
        $nameList->names()->attach($name->id);

        $array = ListViewModel::delete($nameList);

        $this->assertCount(3, $array);

        $this->assertEquals(
            [
                'id' => $nameList->id,
                'name' => 'Ma liste',
                'url' => [
                    'destroy' => env('APP_URL') . '/listes/' . $nameList->id,
                ],
            ],
            $array
        );
    }
}
