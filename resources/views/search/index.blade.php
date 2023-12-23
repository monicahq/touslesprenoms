<x-guest-layout>
  <div class="bg-violet-100 mb-8">
    <div class="border-b border-violet-200">
      @include('layouts.unlogged-navigation')
    </div>

    <div class="border-b border-violet-200">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 py-2">
        <ul class="text-xs">
          <li class="inline after:content-['>'] after:text-gray-500 after:text-xs">
            <a hx-boost="true" href="{{ route('home.index') }}" class="text-violet-900 underline">Accueil</a>
          </li>
          <li class="inline">Recherche de prénoms</li>
        </ul>
      </div>
    </div>
  </div>

  <div>
    <div class="mx-auto max-w-2xl sm:px-6 lg:px-8 py-2 mb-10">
      <h2 class="text-center mb-4 text-xl">Recherche instantanée</h2>
      <form action="" class="mb-2">
        <div class="flex items-center px-2 py-2 bg-gray-100 rounded-lg border-gray-300 border">
          <input type="text" name="term" class="rounded-l-lg w-full py-2 px-4 border border-gray-300 bg-white dark:bg-gray-800 dark:border-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:border-gray-400" placeholder="Rechercher un prénom" />
          <button
            hx-post="{{ route('search.post') }}"
            hx-headers='{"X-CSRF-TOKEN": "{{ csrf_token() }}"}'
            hx-target="#search-results"
            class="border-t border-b border-r border-gray-300 bg-gray-100 dark:bg-gray-700 rounded-r-lg px-4 py-2 text-gray-900 dark:text-gray-100 font-bold">Rechercher</button>
        </div>
      </form>

      <p class="text-gray-500 text-xs text-center">{{ $stats['total_names'] }} noms | 371 listes de prénoms</p>
    </div>

    <div id="search-results" class="mx-auto max-w-2xl sm:px-6 lg:px-8 py-2">
      <div>
        <h2 class="font-semibold text-xl mb-4">Les résultats</h2>
        @include('search.partials.results')
      </div>
    </div>
  </div>
</x-guest-layout>
