<?php

namespace App\Http\ViewModels\Settings;

use App\Models\Role;

class SettingsRoleViewModel
{
    public static function index(): array
    {
        $roles = Role::where('organization_id', auth()->user()->organization_id)
            ->get()
            ->map(fn (Role $role) => self::role($role))
            ->sortBy('label');

        return [
            'roles' => $roles,
        ];
    }

    public static function role(Role $role): array
    {
        return [
            'id' => $role->id,
            'label' => $role->label,
        ];
    }
}
