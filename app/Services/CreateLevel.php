<?php

namespace App\Services;

use App\Models\Level;
use App\Models\User;
use Exception;

class CreateLevel extends BaseService
{
    private Level $level;

    public function __construct(
        public string $label,
    ) {
    }

    public function execute(): Level
    {
        $this->checkPermissions();
        $this->create();

        return $this->level;
    }

    private function checkPermissions(): void
    {
        if (auth()->user()->permissions !== User::ROLE_ACCOUNT_MANAGER &&
            auth()->user()->permissions !== User::ROLE_ADMINISTRATOR) {
            throw new Exception(__('You do not have permission to do this action.'));
        }
    }

    private function create(): void
    {
        $this->level = Level::create([
            'organization_id' => auth()->user()->organization_id,
            'label' => $this->label,
        ]);
    }
}
