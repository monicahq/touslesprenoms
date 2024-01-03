<?php

namespace App\Services;

class AddNameToList extends BaseService
{
    public function __construct(
        public int $nameId,
        public int $listId,
    ) {
    }

    public function execute(): void
    {
    }
}
