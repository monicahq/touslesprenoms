<?php

use App\Http\Controllers\FemaleNameController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\MaleNameController;
use App\Http\Controllers\NameController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Settings\SettingsController;
use Illuminate\Support\Facades\Route;

Route::get('locale/{locale}', [LocaleController::class, 'update'])->name('locale.update');

Route::get('', [HomeController::class, 'index'])->name('home.index');
Route::get('recherche', [SearchController::class, 'index'])->name('search.index');
Route::post('recherche', [SearchController::class, 'post'])->name('search.post');
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
});

require __DIR__ . '/auth.php';
