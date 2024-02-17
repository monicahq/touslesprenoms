<x-guest-layout>
  <div class="bg-violet-100 mb-8">
    <div class="border-b border-violet-200">
      @include('layouts.unlogged-navigation')
    </div>
    <div class="border-b border-violet-200">
      <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8 py-2">
        <ul class="text-xs">
          <li class="inline after:content-['>'] after:text-gray-500 after:text-xs">
            <a hx-boost="true" hx-target="#page" hx-swap="show:none" href="{{ route('home.index') }}" class="text-violet-900 underline">Accueil</a>
          </li>
          <li class="inline after:content-['>'] after:text-gray-500 after:text-xs">
            <a hx-boost="true" hx-target="#page" hx-swap="show:none" href="{{ route('name.index') }}" class="text-violet-900 underline">Tous les prénoms</a>
          </li>
          <li class="inline">Tous les prénoms commençant par la lettre {{ $activeLetter }}</li>
        </ul>
      </div>
    </div>
  </div>

  <div>
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 py-2">
      <div class="grid name-index-grid gap-4">

        <!-- left -->
        <div>
          @include('names.partials.sidebar')
        </div>

        <!-- right -->
        <div class="sm:px-0 px-2">

          <!-- list of letters -->
          <div id="letters" class="grid grid-cols-6 sm:grid-cols-12 gap-y-2 gap-2 mb-12" hx-boost="true" hx-swap="show:none">
            @foreach ($letters as $letter)
            <a hx-boost="true" href="{{ $letter['url'] }}" class="flex flex-col rounded-lg px-2 py-1 border hover:bg-violet-100 {{ $activeLetter === $letter['letter'] ? 'bg-violet-100' : '' }}">
              <div>{{ $letter['letter'] }}</div>
              <div class="text-xs text-gray-600">{{ $letter['count'] }}</div>
            </a>
            @endforeach
          </div>

          <!-- names -->
          <h2 class="mb-2 font-bold text-xl text-center">Tous les prénoms commençant par la lettre {{ $activeLetter }}</h2>
          <p class="text-gray-600 mb-8 text-center">Les prénoms sont triés par popularité.</p>

          <div class="grid grid-cols-2 sm:grid-cols-3 gap-10 gap-y-1 mb-10" x-data="{ last_name: '{{ optional(auth()->user())->last_name }}' }">
            @foreach ($names as $name)
              <x-name-items :name="$name" favorited="{{ $favorites->contains($name['id']) }}" />
            @endforeach
          </div>

          <div id="nav" class="flex justify-center" hx-boost="true" hx-swap="show:none">
            {{ $namesPagination->onEachSide(2)->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
</x-guest-layout>
