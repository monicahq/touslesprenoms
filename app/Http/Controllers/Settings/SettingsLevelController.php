<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\ViewModels\Settings\SettingsLevelViewModel;
use App\Models\Level;
use App\Services\CreateLevel;
use App\Services\DestroyLevel;
use App\Services\UpdateLevel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class SettingsLevelController extends Controller
{
    public function index(Request $request): View
    {
        if ($request->header('hx-request') && $request->header('hx-target') == 'levels-index') {
            return view('settings.level.partials.index', [
                'data' => SettingsLevelViewModel::index(),
            ]);
        }

        return view('settings.level.index', [
            'data' => SettingsLevelViewModel::index(),
        ]);
    }

    public function new(): View
    {
        return view('settings.level.new');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'label' => 'required|string|max:255',
        ]);

        (new CreateLevel(
            label: $validated['label'],
        ))->execute();

        $request->session()->flash('status', __('The level has been created'));

        return redirect()->route('settings.level.index');
    }

    public function edit(Request $request, Level $level): View|RedirectResponse
    {
        try {
            Level::where('organization_id', auth()->user()->organization_id)
                ->findOrFail($level->id);
        } catch (ModelNotFoundException) {
            return redirect()->route('settings.level.index');
        }

        return view('settings.level.edit', [
            'data' => SettingsLevelViewModel::level($level),
        ]);
    }

    public function update(Request $request, Level $level): RedirectResponse
    {
        $validated = $request->validate([
            'label' => 'required|string|max:255',
        ]);

        (new UpdateLevel(
            level: $level,
            label: $validated['label'],
        ))->execute();

        $request->session()->flash('status', __('Changes saved'));

        return redirect()->route('settings.level.index');
    }

    public function destroy(Request $request, Level $level): Response
    {
        try {
            Level::where('organization_id', auth()->user()->organization_id)
                ->findOrFail($level->id);
        } catch (ModelNotFoundException) {
        }

        (new DestroyLevel(
            level: $level,
        ))->execute();

        return response()->make('', 200, ['HX-Trigger' => 'loadLevels']);
    }
}
