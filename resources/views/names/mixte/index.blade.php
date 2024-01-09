<x-guest-layout>
  <div class="bg-violet-100 mb-8">
    <div class="border-b border-violet-200">
      @include('layouts.unlogged-navigation')
    </div>

    <div class="border-b border-violet-200">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 py-2">
        <ul class="text-xs">
          <li class="inline after:content-['>'] after:text-gray-500 after:text-xs">
            <a href="{{ route('home.index') }}" class="text-violet-900 underline">Accueil</a>
          </li>
          <li class="inline">Tous les prénoms mixtes</li>
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
        <div>

          <!-- list of letters -->
          <div class="grid grid-cols-12 gap-y-2 gap-2 mb-12">
            @foreach ($letters as $letter)
            <a href="{{ $letter['url'] }}" class="flex flex-col rounded-lg px-2 py-1 border hover:bg-violet-100">
              <div>{{ $letter['letter'] }}</div>
              <div class="text-xs text-gray-600">{{ $letter['count'] }}</div>
            </a>
            @endforeach
          </div>

          <!-- names -->
          <h2 class="mb-8 font-bold text-xl text-center">Tous les prénoms mixtes</h2>
          <div class="grid grid-cols-3 gap-10 gap-y-1 mb-10" x-data="{ last_name: '{{ auth()->check() ? auth()->user()->last_name : "" }}' }">
            @foreach ($names as $name)
              <x-name-items :name="$name" favorited="{{ $favorites->contains($name['id']) }}" />
            @endforeach
          </div>

          <div class="flex justify-center">
              {{ $namesPagination->onEachSide(2)->links('vendor.pagination.tailwind') }}
            </div>
        </div>
      </div>
    </div>
  </div>
</x-guest-layout>
