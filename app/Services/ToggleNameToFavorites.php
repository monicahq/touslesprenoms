<?php

namespace App\Services;

use App\Models\NameList;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ToggleNameToFavorites extends BaseService
{
    private NameList $list;

    public function __construct(
        public int $nameId,
    ) {
    }

    public function execute(): void
    {
        $this->findFavoritesList();
        $this->addOrRemove();
    }

    private function findFavoritesList(): void
    {
        $this->list = NameList::where('user_id', auth()->id())
            ->where('is_list_of_favorites', true)
            ->first();
    }

    private function addOrRemove(): void
    {
        $this->list->names()->toggle([$this->nameId]);
    }
}
