<?php

namespace App\Services;

use App\Models\NameList;

class CreateList extends BaseService
{
    private NameList $nameList;

    public function __construct(
        public ?string $name,
        public ?string $description,
        public bool $isPublic,
        public bool $canBeModified,
    ) {
    }

    public function execute(): NameList
    {
        $this->createList();

        return $this->nameList;
    }

    private function createList(): void
    {
        $this->nameList = NameList::create([
            'user_id' => auth()->id(),
            'name' => $this->name,
            'description' => $this->description,
            'is_public' => $this->isPublic,
            'can_be_modified' => $this->canBeModified,
        ]);
    }
}
