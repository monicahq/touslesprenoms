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
    <div class="mx-auto max-w-5xl sm:px-6 px-2 lg:px-8 py-2">

      <h1>{{ $list['name'] }}</h1>

      <div class="grid list-show-grid sm:gap-5">

        <!-- left -->
        <div>
          {{ $list['description'] }}
        </div>

        <!-- right -->
        <div>
          <div>
            <ul class="space-y-1">
              @foreach ($list['names'] as $name)
              <li>
                <x-name-items :name="$name" favorited="{{ $favorites->contains($name['id']) }}" />
              </li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-guest-layout>
