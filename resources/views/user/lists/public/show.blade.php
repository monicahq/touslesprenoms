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
          <li class="inline">Détail de la liste {{ $list['name'] }}</li>
        </ul>
      </div>
    </div>
  </div>

  <div>
    <div class="mx-auto max-w-6xl sm:px-6 px-2 lg:px-8 py-2">

      <h1 class="text-3xl mb-12 text-center">{{ $list['name'] }}</h1>

      <div class="grid list-show-grid sm:gap-5">

        <!-- left -->
        <div>
          <div class="mb-3 text-gray-600">
            {{ $list['description'] }}
          </div>

          <p class="text-xs text-gray-700">Liste créée le {{ $list['created_at'] }}.</p>
        </div>

        <!-- right -->
        <div>
          <div class="mb-10">
            <div class="space-y-1">
              @foreach ($list['names'] as $name)
              <div class="border hover:bg-blue-50 hover:border-blue-400 px-3 py-2 mb-2 rounded-md">
                <div class="flex items-center justify-between">
                  <!-- avatar + name / public note -->
                  <div class="relative">
                    <!-- avatar -->
                    <div class="absolute top-1 rounded-full w-5 mr-4 ring-4 ring-violet-100">{!! \App\Helpers\NameHelper::getAvatar($name['name']) !!}</div>

                    <div class="ml-8">
                      <!-- name -->
                      <a href="{{ $name['url']['show'] }}" class="font-semibold mb-2 text-lg hover:underline">
                        {{ $name['name']}}
                      </a>

                      <!-- public note -->
                      <div class="mb-1">
                        {{ $name['public_note'] }}
                      </div>

                      <!-- stats -->
                      <p class="text-xs text-gray-700 flex">
                        <x-heroicon-c-arrow-trending-up class="w-4 h-4 mr-1 text-gray-500" />
                        {{ $name['total'] }} utilisations depuis 1900</p>
                    </div>
                  </div>

                  <!-- favorite -->
                  <div>
                    {{-- <x-heroicon-o-heart
                      class="w-4 h-4 ml-2 text-gray-400 hover:text-rose-400 hover:w-5 hover:h-5 transition-all cursor-pointer" /> --}}
                  </div>
                </div>
              </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-guest-layout>
