<?php

namespace App\Http\ViewModels\Settings;

use App\Models\Level;

class SettingsLevelViewModel
{
    public static function index(): array
    {
        $levels = Level::where('organization_id', auth()->user()->organization_id)
            ->get()
            ->map(fn (Level $level) => self::level($level))
            ->sortBy('label');

        return [
            'levels' => $levels,
        ];
    }

    public static function level(Level $level): array
    {
        return [
            'id' => $level->id,
            'label' => $level->label,
        ];
    }
}
