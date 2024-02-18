<?php

namespace App\Services;

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
        $list = auth()->user()->lists()
            ->findOrFail($this->listId);

        $list->names()->toggle([$this->nameId]);
    }
}
