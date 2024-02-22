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
          <li class="inline">Création d'une liste</li>
        </ul>
      </div>
    </div>
  </div>

  <div>
    <div class="mx-auto max-w-2xl sm:px-6 lg:px-8 py-2">
      <form method="POST" action="{{ route('list.store') }}" class="mb-8 shadow sm:rounded-lg">
        @csrf

        <div class="relative border-b dark:border-gray-600 px-6 py-4 bg-yellow-50">
          <h1 class="text-center font-bold">Créez une liste de prénoms</h1>
        </div>

        <!-- name -->
        <div class="relative px-6 pt-4 pb-2">
          <x-input-label for="list-name"
                        :value="__('Quel est nom de votre liste ?')" />

          <x-text-input class="mt-1 block w-full"
                        id="list-name"
                        name="list-name"
                        type="text"
                        autofocus />

          <x-input-error class="mt-2" :messages="$errors->get('list-name')" />
        </div>

        <!-- description -->
        <div class="relative px-6 pt-4 pb-2">
          <x-input-label for="description"
                        :optional="true"
                        :value="'Description (optionnel)'" />

          <x-textarea class="mt-1 block w-full"
                    id="description"
                    name="description"
                    type="text">{{ old('description') }}</x-textarea>

          <x-input-error class="mt-2" :messages="$errors->get('description')" />
        </div>

        <!-- is public -->
        <div class="relative px-6 pt-4 pb-2">
          <p class="block font-medium text-sm text-gray-700 dark:text-gray-300">{{ __('Genre de la liste') }}</p>
          <div class="grid grid-flow-row sm:grid-flow-col sm:grid-cols-3 gap-4 pt-2 pb-4">
            <div class="flex p-3 ps-4 border border-gray-200 rounded dark:border-gray-700">
              <div class="flex items-center h-5">
                <input id="gender-boy" name="gender" checked type="radio" value="male" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
              </div>
              <div class="ms-2 text-sm">
                <label for="gender-boy" class="font-medium text-gray-900 dark:text-gray-300">{{ __('Garçons') }}</label>
                <p class="text-xs font-normal text-gray-500 dark:text-gray-300">{{ __('La liste contient des prénoms de garçons.') }}</p>
              </div>
            </div>
            <div class="flex p-3 ps-4 border border-gray-200 rounded dark:border-gray-700">
              <div class="flex items-center h-5">
                <input id="gender-girl" name="gender" type="radio" value="female" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
              </div>
              <div class="ms-2 text-sm">
                <label for="gender-girl" class="font-medium text-gray-900 dark:text-gray-300">{{ __('Filles') }}</label>
                <p class="text-xs font-normal text-gray-500 dark:text-gray-300">{{ __('La liste contient des prénoms de filles.') }}</p>
              </div>
            </div>
            <div class="flex p-3 ps-4 border border-gray-200 rounded dark:border-gray-700">
              <div class="flex items-center h-5">
                <input id="gender-mixte" name="gender" type="radio" value="unisex" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
              </div>
              <div class="ms-2 text-sm">
                <label for="gender-mixte" class="font-medium text-gray-900 dark:text-gray-300">{{ __('Mixtes') }}</label>
                <p class="text-xs font-normal text-gray-500 dark:text-gray-300">{{ __('La liste contient des prénoms mixtes.') }}</p>
              </div>
            </div>
          </div>
        </div>

        @if (auth()->user()->is_administrator)
        <div class="relative px-6 pt-4 pb-4">
        <label for="country" class="block text-sm font-medium leading-6 text-gray-900">Catégories (pour administrateur seulement)</label>
          <div class="mt-2">
            <select id="category" name="category" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
              @foreach ($listCategories as $category)
                <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
              @endforeach
            </select>
          </div>
        </div>
        @endif

        <!-- actions -->
        <div class="flex items-center justify-between border-t dark:border-gray-600 bg-white dark:bg-gray-800 px-6 py-4">
            <x-link href="{{ route('list.index') }}">{{ __('Back') }}</x-link>

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
