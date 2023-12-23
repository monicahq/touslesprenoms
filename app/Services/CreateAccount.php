<?php

namespace App\Services;

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

        return $this->user;
    }

    private function createUser(): void
    {
        $this->user = User::create([
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);
    }
}
