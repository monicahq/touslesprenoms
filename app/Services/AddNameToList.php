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

    public function execute(): void
    {
    }
}
