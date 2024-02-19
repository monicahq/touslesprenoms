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
    <div class="mx-auto max-w-4xl sm:px-6 px-2 lg:px-8 py-2">

      <h1 class="text-3xl mb-12 text-center">{{ $list['name'] }}</h1>

      <div class="grid list-show-grid sm:gap-5">

        <!-- left -->
        <div>
          <p class="text-xs text-gray-700 mb-3">Liste créée le {{ $list['created_at'] }}.</p>

          <div>
            {{ $list['description'] }}
          </div>
        </div>

        <!-- right -->
        <div>
          <div class="mb-10">
            <ul class="space-y-1">
              @foreach ($list['names'] as $name)
              <li>
                <x-name-items :name="$name" favorited="{{ $favorites->contains($name['id']) }}" showOrigins="true" />
              </li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-guest-layout>
