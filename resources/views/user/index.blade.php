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
          <li class="inline">Tous vos favoris</li>
        </ul>
      </div>
    </div>
  </div>

  <div>
    <div class="mx-auto max-w-4xl sm:px-6 lg:px-8 py-2">
      <h3 class="text-center text-3xl mb-4">Tous vos prénoms favoris</h3>

      @if (count($names) !== 0)
      <p class="flex items-center mb-10 justify-center">
        <span class="text-gray-500">Pour enlever un favori, cliquez sur le petit symbole vert </span>
        <svg
          class="w-4 h-4 ml-2 text-gray-400 hover:text-rose-400 hover:w-5 hover:h-5 transition-all cursor-pointer"
          xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#009926" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bookmark-check"><path d="m19 21-7-4-7 4V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2Z"/><path d="m9 10 2 2 4-4"/>
        </svg>.
      </p>
      @endif

      <!-- names -->
      <div class="grid grid-cols-2 gap-10 gap-y-1 mb-10" x-data="{ last_name: '{{ auth()->check() ? auth()->user()->last_name : "" }}' }">
        @foreach ($names as $name)
        <div
          class="flex items-center justify-between border border-transparent hover:bg-gray-50 hover:border-gray-200 px-2 py-1 rounded-sm"
          hx-target="this"
          hx-swap="delete"
          >
          <div class="flex items-center">
            <div class="rounded-full w-6 mr-4 ring-4 ring-violet-100">{!! \App\Helpers\NameHelper::getAvatar($name['name']) !!}</div>

            <div class="flex-col">
              <a href="{{ $name['url']['show'] }}" class="text-lg hover:underline">{{ $name['name'] }} <span x-text="last_name"></span></a>
              <p class="text-xs text-gray-700">{{ $name['total'] }} utilisations depuis 1900</p>
            </div>
          </div>

          <svg
            hx-put="{{ $name['url']['favorite'] }}"
            hx-headers='{"X-CSRF-TOKEN": "{{ csrf_token() }}"}'
            class="w-5 h-5 ml-2 text-gray-400 hover:text-rose-400 hover:w-5 hover:h-5 transition-all cursor-pointer"
            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#009926" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bookmark-check"><path d="m19 21-7-4-7 4V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2Z"/><path d="m9 10 2 2 4-4"/>
          </svg>

        </div>
        @endforeach
      </div>

      @if (count($names) === 0)
      <div class="mt-10 text-center">
        <p class="mb-3">Vous n'avez pas encore mis de prénoms en favoris.</p>
        <p class="flex items-center justify-center">
          <span>Pour ajouter un prénom en favori, cliquez sur le petit symbole de coeur près d'un prénom</span>
          <x-heroicon-o-heart class="w-4 h-4 ml-2 text-gray-400 hover:text-rose-400 hover:w-5 hover:h-5 transition-all cursor-pointer" />.
        </p>
      </div>
      @endif
    </div>
  </div>
</x-guest-layout>
