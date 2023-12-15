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
          <li class="inline">Tous les prénoms féminins</li>
        </ul>
      </div>
    </div>
  </div>

  <div>
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 py-2">
      <div class="grid name-index-grid">

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
          <h2 class="mb-8 font-bold text-xl text-center">Tous les prénoms féminins</h2>
          <div class="grid grid-cols-4 gap-10 gap-y-1 mb-10">
            @foreach ($names as $name)
              <div class="flex items-center border border-transparent hover:bg-gray-50 hover:border-gray-200 px-2 py-1 rounded-sm">
                <div class="rounded-full w-6 mr-4 ring-4 ring-violet-100">{!! $name['avatar'] !!}</div>
                <a href="{{ $name['url'] }}" class="text-lg">{{ $name['name'] }}</a>
              </div>
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
