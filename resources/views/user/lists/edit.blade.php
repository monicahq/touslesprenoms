<x-guest-layout class="bg-gray-50">
  <div class="bg-violet-100 mb-10">
    <div class="border-b border-violet-200">
      @include('layouts.unlogged-navigation')
    </div>

    <div class="border-b border-violet-200">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 py-2">
        <ul class="text-xs">
          <li class="inline after:content-['>'] after:text-gray-500 after:text-xs">
            <a hx-boost="true" href="{{ route('home.index') }}" class="text-violet-900 underline">Accueil</a>
          </li>
          <li class="inline after:content-['>'] after:text-gray-500 after:text-xs">
            <a hx-boost="true" href="{{ route('list.index') }}" class="text-violet-900 underline">Toutes vos listes de prénoms</a>
          </li>
          <li class="inline">Édition d'une liste</li>
        </ul>
      </div>
    </div>
  </div>

  <div>
    <div class="mx-auto max-w-2xl sm:px-6 lg:px-8 py-2">
      <form method="POST" action="{{ $list['url']['update'] }}" class="mb-8 shadow sm:rounded-lg">
        @csrf
        @method('PUT')

        <div class="relative border-b dark:border-gray-600 px-6 py-4 bg-yellow-50">
          <h1 class="text-center font-bold">Éditez la liste de prénoms</h1>
        </div>

        <!-- name -->
        <div class="relative px-6 pt-4 pb-2">
          <x-input-label for="list-name"
                        :value="__('Quel est nom de votre liste ?')" />

          <x-text-input class="mt-1 block w-full"
                        id="list-name"
                        name="list-name"
                        type="text"
                        :value="old('list-name', $list['name'])"
                        autofocus />

          <x-input-error class="mt-2" :messages="$errors->get('list-name')" />
        </div>

        <!-- description -->
        <div class="relative px-6 pt-4 pb-6">
          <x-input-label for="description"
                        :optional="true"
                        :value="'Description (optionnel)'" />

          <x-textarea class="mt-1 block w-full"
                    id="description"
                    name="description"
                    type="text">{{ old('description', $list['description']) }}</x-textarea>

          <x-input-error class="mt-2" :messages="$errors->get('description')" />
        </div>

        @if (auth()->user()->is_administrator)
        <div class="relative px-6 pt-4 pb-4">
        <label for="country" class="block text-sm font-medium leading-6 text-gray-900">Catégories (pour administrateur seulement)</label>
          <div class="mt-2">
            <select id="category" name="category" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
              @foreach ($listCategories as $category)
                <option value="{{ $category['id'] }}" @selected($category['id'] === $list['list_category_id'])>{{ $category['name'] }}</option>
              @endforeach
            </select>
          </div>
        </div>
        @endif

        <!-- actions -->
        <div class="flex items-center justify-between border-t dark:border-gray-600 bg-white dark:bg-gray-800 px-6 py-4">
            <x-link href="{{ route('list.show', $list['id']) }}">Retour</x-link>

            <div>
              <x-primary-button class="w-full text-center" dusk="submit-form-button">
                Sauvegarder
              </x-primary-button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</x-guest-layout>
