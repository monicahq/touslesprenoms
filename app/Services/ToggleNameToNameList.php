<?php

namespace App\Services;

use App\Models\NameList;

/**
 * This service toggles a name to the provided list of names: it adds it or
 * removes it.
 */
class ToggleNameToNameList extends BaseService
{
    public function __construct(
        public int $nameId,
        public int $listId,
    ) {
    }

    public function execute(): void
    {
        $this->addOrRemove();
    }

    private function addOrRemove(): void
    {
        $list = NameList::where('user_id', auth()->id())
            ->where('id', $this->listId)
            ->firstOrFail();

        $list->names()->toggle([$this->nameId]);
    }
}
