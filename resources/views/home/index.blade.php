<x-guest-layout>
  <div class="bg-violet-100">
    <div class="border-b border-violet-200">
      @include('layouts.unlogged-navigation')
    </div>

    <div class="py-12 mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
      <!-- grid start -->
      <div class="grid grid-row-2 sm:grid-cols-2 gap-4">

        <!-- left -->
        <div class="text-gray-900">
          <div class="rounded-lg p-2 bg-violet-300 font-bold text-sm mb-4 shadow-md inline-block -rotate-2">+ de 39 000 prénoms</div>
          <h1 class="text-4xl font-bold tracking-tight mb-6">Choisissez le prénom parfait pour votre futur enfant</h1>
          <h2 class="text-xl mb-6">Parcourez le site de fiches de prénoms le plus complet. Créez des listes et faites voter vos proches. Un site qui vous respecte, sans pub et open source.</h2>

          <p class="sm:mb-0 mb-6">
            <a href="{{ route('name.index') }}" class="bg-amber-300 px-4 py-2 rounded-lg font-bold shadow">Parcourir tous les prénoms</a>
          </p>
        </div>

        <!-- right -->
        <div>
          <div class="bg-white shadow-md rounded-lg">
            <div class="flex items-center border-b">
              <img src="/img/prenom_du_jour.svg" alt="Prénom du jour" class="w-48 mx-auto py-2" />
            </div>

            <div class="p-6">
              <!-- title -->
              <div class="flex items-center mb-5">
                <div class="rounded-full w-14 mr-4 ring-4 ring-violet-100">{!! \App\Helpers\NameHelper::getAvatar($nameSpotlight['name']) !!}</div>

                <h3 class="text-xl font-bold">{{ $nameSpotlight['name'] }}</h3>
              </div>

              <!-- origins -->
              <div class="prose mb-5">{{ $nameSpotlight['origins'] }}</div>

              <p class="text-center">
                <a href="{{ $nameSpotlight['url'] }}" class="bg-amber-300 px-4 py-2 rounded-lg font-bold shadow">Lire plus +</a>
              </p>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  <div class="py-8 sm:py-20 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <h2 class="text-center mb-4 text-xl">Recherche instantanée</h2>
    <form method="POST" action="{{ route('search.post') }}" class="mb-2" x-data="{ name: '' }">
      @csrf

      <div class="flex items-center px-2 py-2 bg-gray-100 rounded-lg border-gray-300 border">
        <input x-model="name" type="text" name="term" class="rounded-l-lg w-full sm:w-96 py-2 px-4 border border-gray-300 bg-white dark:bg-gray-800 dark:border-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:border-gray-400" placeholder="Rechercher un prénom" />
        <button type="submit" x-bind:disabled="name.length < 3" class="border-t border-b border-r border-gray-300 bg-gray-100 dark:bg-gray-700 rounded-r-lg px-4 py-2 text-gray-900 dark:text-gray-100 font-bold">Rechercher</button>
      </div>
    </form>

    <p class="text-gray-500 text-xs text-center">La base de données contient {{ $stats['total_names'] }} prénoms.</p>
  </div>

  <div class="bg-yellow-100">
    <div class="py-12 mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
      <!-- list of popular names -->
      <div class="grid grid-row-4 sm:grid-cols-4 gap-10">
        <!-- male names -->
        <div>
          <h2 class="font-semibold text-lg mb-4">Prénoms masculins populaires</h2>
          <ul class="space-y-4" x-data="{ last_name: '{{ auth()->check() ? auth()->user()->last_name : "" }}' }">
            @foreach ($twentyMostPopularNames['male_names'] as $name)
            <li>
              <x-name-items :name="$name" favorited="{{ $favorites->contains($name['id']) }}" />
            </li>
            @endforeach
          </ul>
        </div>

        <!-- female names -->
        <div>
          <h2 class="font-semibold text-lg mb-4">Prénoms féminins populaires</h2>
          <ul class="space-y-4" x-data="{ last_name: '{{ auth()->check() ? auth()->user()->last_name : "" }}' }">
            @foreach ($twentyMostPopularNames['female_names'] as $name)
            <li>
              <x-name-items :name="$name" favorited="{{ $favorites->contains($name['id']) }}" />
            </li>
            @endforeach
          </ul>
        </div>

        <!-- mixte names -->
        <div>
          <h2 class="font-semibold text-lg mb-4">Prénoms mixtes populaires</h2>
          <ul class="space-y-4" x-data="{ last_name: '{{ auth()->check() ? auth()->user()->last_name : "" }}' }">
            @foreach ($twentyMostPopularNames['mixted_names'] as $name)
            <li>
              <x-name-items :name="$name" favorited="{{ $favorites->contains($name['id']) }}" />
            </li>
            @endforeach
          </ul>
        </div>

        <!-- random names -->
        <div>
          <h2 class="font-semibold text-lg mb-4">Prénoms aléatoires</h2>
          <ul class="space-y-4" x-data="{ last_name: '{{ auth()->check() ? auth()->user()->last_name : "" }}' }">
            @foreach ($twentyMostPopularNames['random_names'] as $name)
            <li>
              <x-name-items :name="$name" favorited="{{ $favorites->contains($name['id']) }}" />
            </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>

  <div>
    <div class="py-20 mx-auto max-w-7xl sm:px-6 lg:px-8">
      <h2 class="text-center mb-4 text-xl">Quelques inspirations pour vous aider</h2>

      <div class="grid grid-row-1 sm:grid-cols-2 gap-x-10 gap-y-4 w-full">
        @foreach($lists as $list)
        <div class="flex items-center border border-gray-200 px-2 py-1 rounded-lg">
          <!-- avatars -->
          <div class="flex -space-x-4 rtl:space-x-reverse mr-5">
            @foreach ($list['names'] as $name)
            <div class="rounded-full w-6 h-6 mr-4 ring-4 ring-violet-100">{!! \App\Helpers\NameHelper::getAvatar($name['name']) !!}</div>
            @endforeach
          </div>

          <div>
            <!-- list name -->
            <a href="{{ $list['url']['show'] }}" class="block text-xl mb-1 hover:underline">{{ $list['name'] }}</a>

            <!-- some names in the list -->
            <div class="flex items-center text-gray-600 text-xs mb-1">
              <p class="mr-3">Quelques exemples :</p>
              @foreach ($list['names'] as $name)
              <div class="flex items-center mr-2">
                <a href="{{ $name['url']['show'] }}" class="hover:underline">{{ $name['name'] }}</a>
              </div>
              @endforeach
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</x-guest-layout>
