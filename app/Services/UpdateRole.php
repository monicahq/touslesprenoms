<?php

namespace App\Services;

use App\Models\Role;
use App\Models\User;
use Exception;

class UpdateRole extends BaseService
{
    public function __construct(
        public Role $role,
        public string $label,
    ) {
    }

    public function execute(): Role
    {
        $this->checkPermissions();
        $this->checkRole();
        $this->update();

        return $this->role;
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

    private function checkRole(): void
    {
        if ($this->role->organization_id !== auth()->user()->organization_id) {
            throw new Exception(__('You do not have permission to do this action.'));
        }
    }

    private function update(): void
    {
        $this->role->update([
            'label' => $this->label,
        ]);
    }
}
