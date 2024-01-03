<?php

namespace App\Services;

use App\Models\NameList;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AddNameToList extends BaseService
{
    private NameList $list;

    public function __construct(
        public int $nameId,
        public int $listId,
    ) {
    }

    public function execute(): User
    {
        $this->add();

        return $this->user;
    }

    private function add(): void
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
