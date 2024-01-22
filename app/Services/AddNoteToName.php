<?php

namespace App\Services;

use App\Models\Note;

class AddNoteToName extends BaseService
{
    private Note $note;

    public function __construct(
        public int $nameId,
        public int $userId,
        public string $noteText,
    ) {
    }

    public function execute(): Note
    {
        $this->create();

        return $this->note;
    }

    private function create(): void
    {
        $this->note = Note::updateOrCreate([
            'name_id' => $this->nameId,
            'user_id' => $this->userId,
        ], [
            'content' => $this->noteText,
        ]);
    }
}
