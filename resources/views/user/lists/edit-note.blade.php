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
          <li class="inline after:content-['>'] after:text-gray-500 after:text-xs">
            <a hx-boost="true" href="{{ $list['url']['show'] }}" class="text-violet-900 underline">{{ $list['name'] }}</a>
          </li>
          <li class="inline">Ajout d'une note</li>
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
          <h1 class="text-center font-bold">Ajout d'une note au prénom {{ $name }}</h1>
        </div>

        <!-- description -->
        <div class="relative px-6 pt-4 pb-6">
          <x-input-label for="note"
                        :value="'Note'" />

          <x-textarea class="mt-1 block w-full"
                    id="note"
                    name="note"
                    type="text">{{ old('note', $note) }}</x-textarea>

          <x-input-error class="mt-2" :messages="$errors->get('description')" />
        </div>

        <!-- actions -->
        <div class="flex items-center justify-between border-t dark:border-gray-600 bg-white dark:bg-gray-800 px-6 py-4">
            <x-link href="{{ $list['url']['show'] }}">Retour</x-link>

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
