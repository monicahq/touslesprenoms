<x-guest-layout>
  <div class="bg-violet-100 mb-8">
    <div class="border-b border-violet-200">
      @include('layouts.unlogged-navigation')
    </div>

    <div class="border-b border-violet-200">
      <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8 py-2">
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
    <div class="mx-auto max-w-2xl px-2 sm:px-6 lg:px-8 py-2 mb-10">
      <h2 class="text-center mb-4 text-xl">Recherche instantanée</h2>
      <form method="POST" action="{{ route('search.post') }}" class="mb-4" x-data="{ name: '{{ $term }}' }">
        @csrf

        <div class="flex items-center px-2 py-2 bg-gray-100 rounded-lg border-gray-300 border">
          <input x-model="name" type="text" name="term" class="rounded-l-lg w-full py-2 px-4 border border-gray-300 bg-white dark:bg-gray-800 dark:border-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:border-gray-400" placeholder="Merci d'entrer au moins 3 caractères." />
          <button type="submit" x-bind:disabled="name.length < 3" class="disabled:bg-red-100 disabled:text-gray-600 border-t border-b border-r border-gray-300 bg-gray-100 dark:bg-gray-700 rounded-r-lg px-4 py-2 text-gray-900 dark:text-gray-100 font-bold">Rechercher</button>
        </div>
      </form>

      <p class="text-gray-500 text-xs text-center">La base de données contient {{ $stats['total_names'] }} noms</p>
    </div>

    @if (count($names) > 0)
    <div class="mx-auto max-w-2xl px-2 sm:px-6 lg:px-8 py-2 mb-10" x-data="{ last_name: '{{ auth()->check() ? auth()->user()->last_name : "" }}' }">
      <h2>Nous avons trouvé {{ $names['total'] }} résultats avec les caractères <kbd class="px-2 py-1.5 text-xs font-semibold text-gray-800 bg-gray-100 border border-gray-200 rounded-lg dark:bg-gray-600 dark:text-gray-100 dark:border-gray-500">{{ $term }}</kbd>. Les résultats sont classés par popularité.</h2>

      <ul class="overflow-auto h-50 bg-white rounded-b-lg mt-4" x-data="{ last_name: '{{ auth()->check() ? auth()->user()->last_name : "" }}' }">
        @foreach ($names['names'] as $name)
        <x-name-items :name="$name" favorited="{{ $favorites->contains($name['id']) }}" class="py-2" />
        @endforeach
      </ul>
    </div>
    @endif
  </div>
</x-guest-layout>
