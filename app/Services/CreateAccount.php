<?php

namespace App\Services;

use App\Models\NameList;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

/**
 * Create an account for the user.
 */
class CreateAccount extends BaseService
{
    private User $user;

    public function __construct(
        public string $email,
        public string $password,
    ) {
    }

    public function execute(): User
    {
        $this->createUser();
        $this->createFirstList();

        return $this->user;
    }

    private function createUser(): void
    {
        $this->user = User::create([
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);
    }

    private function createFirstList(): void
    {
        NameList::create([
            'user_id' => $this->user->id,
            'name' => 'Favoris',
            'is_public' => false,
            'can_be_modified' => false,
            'is_list_of_favorites' => true,
        ]);
    }
}
