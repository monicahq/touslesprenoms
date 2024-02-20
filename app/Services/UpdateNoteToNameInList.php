<?php

namespace App\Services;

use App\Models\Note;
use Illuminate\Support\Facades\DB;

class UpdateNoteToNameInList extends BaseService
{
    public function __construct(
        public int $nameListId,
        public int $nameId,
        public string $note,
    ) {
    }

    public function execute(): void
    {
        $this->create();
    }

    private function create(): void
    {
        DB::table('list_name')
            ->where('list_id', $this->nameListId)
            ->where('name_id', $this->nameId)
            ->update(['public_note' => $this->note]);
    }
}
