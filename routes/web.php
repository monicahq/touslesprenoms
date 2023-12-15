<?php

use App\Http\Controllers\FemaleNameController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\MaleNameController;
use App\Http\Controllers\NameController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Settings\SettingsController;
use App\Http\Controllers\Settings\SettingsLevelController;
use App\Http\Controllers\Settings\SettingsProfileController;
use App\Http\Controllers\Settings\SettingsRoleController;
use Illuminate\Support\Facades\Route;

Route::get('locale/{locale}', [LocaleController::class, 'update'])->name('locale.update');

Route::get('', [HomeController::class, 'index'])->name('home.index');
Route::get('prenoms', [NameController::class, 'index'])->name('name.index');

Route::get('prenoms/garcons', [MaleNameController::class, 'index'])->name('name.garcon.index');
Route::get('prenoms/filles', [FemaleNameController::class, 'index'])->name('name.fille.index');
Route::get('prenoms/mixtes', [NameController::class, 'index'])->name('name.mixte.index');
Route::get('prenoms/mixtes/{letter}', [NameController::class, 'index'])->name('name.mixte.show');

Route::middleware(['letter'])->group(function (): void {
    Route::get('prenoms/garcons/{letter}', [MaleNameController::class, 'letter'])->name('name.garcon.letter');
    Route::get('prenoms/filles/{letter}', [FemaleNameController::class, 'letter'])->name('name.fille.letter');
    Route::get('prenoms/{letter}', [NameController::class, 'letter'])->name('name.letter');
});

Route::middleware(['name'])->group(function (): void {
    Route::get('prenoms/{id}/{name}', [NameController::class, 'show'])->name('name.show');
});

Route::get('dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function (): void {
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // settings
    Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');

    Route::middleware(['administrator'])->group(function (): void {
        // profile
        Route::get('settings/profile', [SettingsProfileController::class, 'index'])->name('settings.profile.index');

        // roles
        Route::get('settings/roles', [SettingsRoleController::class, 'index'])->name('settings.role.index');
        Route::get('settings/roles/new', [SettingsRoleController::class, 'new'])->name('settings.role.new');
        Route::post('settings/roles', [SettingsRoleController::class, 'store'])->name('settings.role.store');
        Route::get('settings/roles/{role}/edit', [SettingsRoleController::class, 'edit'])->name('settings.role.edit');
        Route::put('settings/roles/{role}', [SettingsRoleController::class, 'update'])->name('settings.role.update');
        Route::delete('settings/roles/{role}', [SettingsRoleController::class, 'destroy'])->name('settings.role.destroy');

        // levels
        Route::get('settings/levels', [SettingsLevelController::class, 'index'])->name('settings.level.index');
        Route::get('settings/levels/new', [SettingsLevelController::class, 'new'])->name('settings.level.new');
        Route::post('settings/levels', [SettingsLevelController::class, 'store'])->name('settings.level.store');
        Route::get('settings/levels/{level}/edit', [SettingsLevelController::class, 'edit'])->name('settings.level.edit');
        Route::put('settings/levels/{level}', [SettingsLevelController::class, 'update'])->name('settings.level.update');
        Route::delete('settings/levels/{level}', [SettingsLevelController::class, 'destroy'])->name('settings.level.destroy');
    });
});

require __DIR__ . '/auth.php';
