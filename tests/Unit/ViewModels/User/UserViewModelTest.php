<?php

namespace Tests\Unit\ViewModels\User;

use App\Http\ViewModels\User\UserViewModel;
use App\Models\Name;
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
}
