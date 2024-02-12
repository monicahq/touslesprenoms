<?php

namespace App\Services;

use App\Models\NameList;

/**
 * This service toggles a name to the user's list of favorites: it adds it or
 * removes it.
 */
class ToggleNameToFavorites extends BaseService
{
    private NameList $list;

    public function __construct(
        public int $nameId,
    ) {
    }

    public function execute(): bool
    {
        $this->findFavoritesList();
        $this->addOrRemove();

        return $this->list->names->contains($this->nameId);
    }

    private function findFavoritesList(): void
    {
        $this->list = auth()->user()->lists()
            ->favorite()
            ->firstOrFail();
    }

    private function addOrRemove(): void
    {
        $this->list->names()->toggle([$this->nameId]);
    }
}
