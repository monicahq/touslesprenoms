<?php

namespace Tests\Unit\ViewModels\User;

use App\Http\ViewModels\User\UserViewModel;
use App\Models\Name;
use App\Models\Note;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UserViewModelTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_gets_the_list_of_favorites(): void
    {
        $name = Name::factory()->create();
        $user = User::factory()->create();
        $nameList = $user->lists()->create([
            'is_list_of_favorites' => true,
        ]);
        $nameList->names()->attach($name->id);

        $this->be($user);

        $collection = UserViewModel::favorites();

        $this->assertEquals(
            [
                0 => $name->id,
            ],
            $collection->toArray()
        );
    }

    /** @test */
    public function it_gets_the_list_of_favorites_for_the_index_page(): void
    {
        $name = Name::factory()->create([
            'name' => 'test',
            'total' => 1000,
        ]);
        $user = User::factory()->create();
        $nameList = $user->lists()->create([
            'is_list_of_favorites' => true,
        ]);
        $nameList->names()->attach($name->id);
        Note::factory()->create([
            'name_id' => $name->id,
            'user_id' => $user->id,
            'content' => 'this is a note',
        ]);

        $this->be($user);

        $array = UserViewModel::index();

        $this->assertEquals(
            [
                0 => [
                    'id' => $name->id,
                    'name' => 'Test',
                    'total' => '1 000',
                    'note' => 'this is a note',
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
