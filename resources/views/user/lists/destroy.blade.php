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
          <li class="inline">Suppression d'une liste</li>
        </ul>
      </div>
    </div>
  </div>

  <div>
    <div class="mx-auto max-w-2xl sm:px-6 lg:px-8 py-2">
      <form method="POST" action="{{ $list['url']['destroy'] }}" class="mb-8 shadow sm:rounded-lg">
        @csrf
        @method('DELETE')

        <div class="relative border-b dark:border-gray-600 px-6 py-4 bg-yellow-50">
          <h1 class="text-center font-bold">Supprimez la liste de prénoms</h1>
        </div>

        <div class="relative px-6 pt-4 pb-2">
          Voulez-vous vraiment supprimer la liste de prénoms nommées {{ $list['name'] }} ? Ceci est irrévocable.
        </div>

        <!-- actions -->
        <div class="flex items-center justify-between border-t dark:border-gray-600 bg-white dark:bg-gray-800 px-6 py-4">
            <x-link href="{{ route('list.show', $list['id']) }}">Retour</x-link>

            <div>
              <x-primary-button class="w-full text-center" dusk="submit-form-button">
                Supprimer
              </x-primary-button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</x-guest-layout>
