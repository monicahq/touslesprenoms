<?php

namespace App\Services;

use App\Models\Level;
use App\Models\User;
use Exception;

class UpdateLevel extends BaseService
{
    public function __construct(
        public Level $level,
        public string $label,
    ) {
    }

    public function execute(): Level
    {
        $this->checkPermissions();
        $this->checkLevel();
        $this->update();

        return $this->level;
    }

    private function checkPermissions(): void
    {
        if (
            auth()->user()->permissions !== User::ROLE_ACCOUNT_MANAGER &&
            auth()->user()->permissions !== User::ROLE_ADMINISTRATOR
        ) {
            throw new Exception(__('You do not have permission to do this action.'));
        }
    }

    private function checkLevel(): void
    {
        if ($this->level->organization_id !== auth()->user()->organization_id) {
            throw new Exception(__('You do not have permission to do this action.'));
        }
    }

    private function update(): void
    {
        $this->level->update([
            'label' => $this->label,
        ]);
    }
}
