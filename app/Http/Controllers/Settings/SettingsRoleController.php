<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\ViewModels\Settings\SettingsRoleViewModel;
use App\Models\Role;
use App\Services\CreateRole;
use App\Services\DestroyRole;
use App\Services\UpdateRole;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class SettingsRoleController extends Controller
{
    public function index(Request $request): View
    {
        if ($request->header('hx-request') && $request->header('hx-target') == 'roles-index') {
            return view('settings.role.partials.index', [
                'data' => SettingsRoleViewModel::index(),
            ]);
        }

        return view('settings.role.index', [
            'data' => SettingsRoleViewModel::index(),
        ]);
    }

    public function new(): View
    {
        return view('settings.role.new');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'label' => 'required|string|max:255',
        ]);

        (new CreateRole(
            label: $validated['label'],
        ))->execute();

        $request->session()->flash('status', __('The role has been created'));

        return redirect()->route('settings.role.index');
    }

    public function edit(Request $request, Role $role): View|RedirectResponse
    {
        try {
            Role::where('organization_id', auth()->user()->organization_id)
                ->findOrFail($role->id);
        } catch (ModelNotFoundException) {
            return redirect()->route('settings.role.index');
        }

        return view('settings.role.edit', [
            'data' => SettingsRoleViewModel::role($role),
        ]);
    }

    public function update(Request $request, Role $role): RedirectResponse
    {
        $validated = $request->validate([
            'label' => 'required|string|max:255',
        ]);

        (new UpdateRole(
            role: $role,
            label: $validated['label'],
        ))->execute();

        $request->session()->flash('status', __('Changes saved'));

        return redirect()->route('settings.role.index');
    }

    public function destroy(Request $request, Role $role): Response
    {
        try {
            Role::where('organization_id', auth()->user()->organization_id)
                ->findOrFail($role->id);
        } catch (ModelNotFoundException) {
        }

        (new DestroyRole(
            role: $role,
        ))->execute();

        return response()->make('', 200, ['HX-Trigger' => 'loadRoles']);
    }
}
