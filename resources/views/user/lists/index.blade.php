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
          <li class="inline">Toutes vos listes de prénoms</li>
        </ul>
      </div>
    </div>
  </div>

  <div>
    <div class="mx-auto max-w-3xl sm:px-6 lg:px-8 py-2">
      <h3 class="text-center text-3xl mb-4">Toutes vos listes de prénoms</h3>

      @if (count($lists) !== 0)
      <p class="flex items-center mb-10 justify-center">
        <span class="text-gray-500">Une liste vous permet de classer vos prénoms autour d'une thématique donnée.</span>
      </p>

      <div class="text-center mb-8">
        <a hx-boost="true" href="{{ route('list.new') }}" class="bg-amber-300 px-4 py-2 rounded-lg font-bold shadow">Créer une nouvelle liste</a>
      </div>
      @endif

      <!-- lists -->
      <div class="mb-10">
        @foreach ($lists as $list)
        <div class="flex items-center justify-between border border-gray-200 px-2 py-1 rounded-lg mb-4">
          <div class="flex items-center">
            <div class="flex-col">
              <a href="{{ $list['url']['show'] }}" class="text-lg hover:underline">{{ $list['name'] }} <span x-text="last_name"></span></a>
              <p class="text-xs text-gray-700">{{ $list['total'] }} noms</p>
            </div>
          </div>
        </div>
        @endforeach
      </div>

      @if (count($lists) === 0)
      <div class="mt-10 text-center">
        <p class="mb-3">Vous n'avez pas encore mis de listes.</p>
        <p class="flex items-center justify-center mb-8">Une liste vous permet de classer vos prénoms autour d'une thématique donnée, et de faire voter vos choix par vos proches.</p>

        <a hx-boost="true" href="{{ route('list.new') }}" class="bg-amber-300 px-4 py-2 rounded-lg font-bold shadow">Créez votre première liste</a>
      </div>
      @endif
    </div>
  </div>
</x-guest-layout>
