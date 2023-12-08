<?php

namespace App\Services;

use App\Jobs\PopulateAccount;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

/**
 * Create an account for the user.
 */
class CreateAccount extends BaseService
{
    private User $user;
    private Organization $organization;

    public function __construct(
        public string $email,
        public string $password,
        public string $firstName,
        public string $lastName,
        public string $organizationName
    ) {
    }

    public function execute(): User
    {
        $this->createOrganization();
        $this->createUser();

        PopulateAccount::dispatch($this->organization);

        return $this->user;
    }

    private function createUser(): void
    {
        $this->user = User::create([
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'email' => $this->email,
            'name_for_avatar' => $this->firstName,
            'password' => Hash::make($this->password),
            'organization_id' => $this->organization->id,
            'permissions' => User::ROLE_ADMINISTRATOR,
        ]);
    }

    private function createOrganization(): void
    {
        $this->organization = Organization::create([
            'name' => $this->organizationName,
        ]);
    }
}
