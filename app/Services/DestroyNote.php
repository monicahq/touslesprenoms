<?php

namespace App\Services;

use App\Models\Note;

class DestroyNote extends BaseService
{
    private Note $note;

    public function __construct(
        public int $userId,
        public int $nameId,
    ) {
    }

    public function execute(): void
    {
        $this->check();
    }

    private function check(): void
    {
        $this->note = Note::where([
            'name_id' => $this->nameId,
            'user_id' => $this->userId,
        ])->firstOrFail();

        $this->note->delete();
    }
}
