<?php

namespace App\Services;

use App\Models\Level;
use App\Models\User;
use Exception;

class DestroyLevel extends BaseService
{
    public function __construct(
        public Level $level,
    ) {
    }

    public function execute(): void
    {
        $this->checkPermissions();
        $this->checkLevel();
        $this->destroy();
    }

    public function destroy(): void
    {
        $this->level->delete();
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
}
