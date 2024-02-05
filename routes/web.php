<?php

use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\FemaleNameController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\ListNameController;
use App\Http\Controllers\ListSearchController;
use App\Http\Controllers\ListSystemController;
use App\Http\Controllers\MaleNameController;
use App\Http\Controllers\MixteNameController;
use App\Http\Controllers\NameController;
use App\Http\Controllers\NameFavoriteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicListController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ShareController;
use App\Http\Controllers\TermsController;
use App\Http\Controllers\UserNameController;
use Illuminate\Support\Facades\Route;

Route::get('partage/{uuid}', [ShareController::class, 'show'])->name('share.show');

Route::get('', [HomeController::class, 'index'])->name('home.index');
Route::get('recherche', [SearchController::class, 'index'])->name('search.index');
Route::post('recherche', [SearchController::class, 'post'])->name('search.post');
Route::get('prenoms', [NameController::class, 'index'])->name('name.index');

Route::get('conditions', [TermsController::class, 'index'])->name('terms.index');

Route::get('prenoms/garcons', [MaleNameController::class, 'index'])->name('name.garcon.index');
Route::get('prenoms/filles', [FemaleNameController::class, 'index'])->name('name.fille.index');
Route::get('prenoms/mixtes', [MixteNameController::class, 'index'])->name('name.mixte.index');

Route::middleware(['letter'])->group(function (): void {
    Route::get('prenoms/garcons/{letter}', [MaleNameController::class, 'letter'])->name('name.garcon.letter');
    Route::get('prenoms/filles/{letter}', [FemaleNameController::class, 'letter'])->name('name.fille.letter');
    Route::get('prenoms/mixte/{letter}', [MixteNameController::class, 'letter'])->name('name.mixte.letter');
    Route::get('prenoms/{letter}', [NameController::class, 'letter'])->name('name.letter');
});

Route::middleware(['name'])->group(function (): void {
    Route::get('prenoms/{id}/{name}', [NameController::class, 'show'])->name('name.show');
});

Route::middleware(['auth', 'verified'])->group(function (): void {
    Route::middleware(['name'])->group(function (): void {

        // set favorites
        // used in the list of names
        Route::put('prenoms/{id}/favorite', [FavoriteController::class, 'update'])->name('favorite.update');

        // used on the show page
        Route::put('prenoms/{id}/show/favorite', [NameFavoriteController::class, 'update'])->name('favorite.name.update');

        // set the note for the given name
        Route::get('notes/{id}', [UserNameController::class, 'show'])->name('user.name.show');
        Route::get('notes/{id}/edit', [UserNameController::class, 'edit'])->name('user.name.edit');
        Route::put('notes/{id}', [UserNameController::class, 'update'])->name('user.name.update');
        Route::delete('notes/{id}', [UserNameController::class, 'destroy'])->name('user.name.destroy');
    });

    Route::get('favoris', [FavoriteController::class, 'index'])->name('favorite.index');
    Route::get('listes', [ListController::class, 'index'])->name('list.index');
    Route::get('listes/nouveau', [ListController::class, 'new'])->name('list.new');
    Route::post('listes', [ListController::class, 'store'])->name('list.store');

    Route::middleware(['list'])->group(function (): void {
        Route::get('listes/{liste}/edition', [ListController::class, 'edit'])->name('list.edit');
        Route::put('listes/{liste}', [ListController::class, 'update'])->name('list.update');
        Route::get('listes/{liste}/suppression', [ListController::class, 'delete'])->name('list.delete');
        Route::get('listes/{liste}/system', [ListSystemController::class, 'update'])->name('list.system.update');
        Route::delete('listes/{liste}', [ListController::class, 'destroy'])->name('list.destroy');

        Route::post('listes/{liste}/search', [ListSearchController::class, 'index'])->name('list.search.index');
        Route::post('listes/{liste}/prenoms/{id}', [ListNameController::class, 'store'])->name('list.name.store');
        Route::get('listes/{liste}/prenoms', [ListNameController::class, 'index'])->name('list.name.index');
        Route::delete('listes/{liste}/prenoms/{id}', [ListNameController::class, 'destroy'])->name('list.name.destroy');

        Route::put('listes/{liste}/prenoms/{id}/set', [NameController::class, 'storeNameInList'])->name('name.list.store');
    });

    Route::get('profil', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('profil', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('profil/nom', [ProfileController::class, 'name'])->name('profile.name');
});

Route::middleware(['list'])->group(function (): void {
    Route::get('listes/{liste}', [ListController::class, 'show'])->name('list.show');

    Route::get('public/listes/{liste}', [PublicListController::class, 'show'])->name('list.public.show');
});

require __DIR__ . '/auth.php';
