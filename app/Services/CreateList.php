<?php

namespace App\Services;

use App\Models\NameList;
use Illuminate\Support\Str;

class CreateList extends BaseService
{
    private NameList $nameList;

    public function __construct(
        public ?string $name,
        public ?string $description,
        public bool $isPublic,
        public bool $canBeModified,
        public string $gender,
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
            'uuid' => Str::uuid(),
            'name' => $this->name,
            'description' => $this->description,
            'is_public' => $this->isPublic,
            'can_be_modified' => $this->canBeModified,
            'gender' => $this->gender,
        ]);
    }
}
