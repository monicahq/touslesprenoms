<x-guest-layout>
  <div class="bg-violet-100 mb-10">
    <div class="border-b border-violet-200">
      @include('layouts.unlogged-navigation')
    </div>

    <div class="border-b border-violet-200">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 py-2">
        <ul class="text-xs">
          <li class="inline after:content-['>'] after:text-gray-500 after:text-xs">
            <a  href="{{ route('home.index') }}" class="text-violet-900 underline">Accueil</a>
          </li>
          <li class="inline after:content-['>'] after:text-gray-500 after:text-xs">
            <a  href="{{ route('list.index') }}" class="text-violet-900 underline">Toutes vos listes de prénoms</a>
          </li>
          <li class="inline">Détail de votre liste</li>
        </ul>
      </div>
    </div>
  </div>

  <div>
    <div class="mx-auto max-w-4xl sm:px-6 lg:px-8 py-2" x-data="{ showShare: false, showSearch: false }">
      <h3 class="text-center text-3xl mb-4">{{ $list['name'] }}</h3>

      @if ($list['description'] !== null)
      <p class="text-center text-gray-500 mb-4">{{ $list['description'] }}</p>
      @endif

      <!-- actions -->
      <div class="mb-8 text-sm flex items-center justify-center">
        <div class="mr-4" @click="showSearch = !showSearch">
          <span class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 cursor-pointer flex items-center">
            <x-heroicon-o-plus-circle class="w-5 h-5 mr-2 text-gray-500" />
            <span>
              Ajouter un prénom à la liste
            </span>
          </span>
        </div>
        <div class="mr-4" @click="showShare = !showShare">
          <span class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 cursor-pointer flex items-center">
            <x-heroicon-o-share class="w-4 h-4 mr-2 text-gray-500" />
            <span>Partager la liste et activer les votes</span>
          </span>
        </div>
        <div class="mr-4">
          <a href="{{ $list['url']['edit'] }}" class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 cursor-pointer flex items-center">
            <x-heroicon-o-pencil-square class="w-4 h-4 mr-2 text-gray-500" />
            <span>Editer</span>
          </a>
        </div>
        <div class="mr-4">
          <a href="{{ $list['url']['delete'] }}" class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 cursor-pointer flex items-center">
            <x-heroicon-o-trash class="w-4 h-4 mr-2 text-gray-500" />
            <span>Supprimer</span>
          </a>
        </div>
      </div>

      @if (auth()->user()->is_administrator)
      <div class="mb-8 text-sm flex items-center justify-center">
        @if ($list['visibility'])
        <p class="flex items-center mr-4">
          <x-heroicon-o-eye class="w-4 h-4 mr-2 text-green-500" />
          <span>La liste est publique.</span>
        </p>
        <a href="{{ $list['url']['visibility'] }}" class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 cursor-pointer flex items-center">
          <x-heroicon-o-bell-alert class="w-4 h-4 mr-2 text-gray-500" />
          <span>Rendre la liste privée</span>
        </a>
        @else
        <p class="flex items-center mr-4">
          <x-heroicon-o-eye-slash class="w-4 h-4 mr-2 text-red-500" />
          <span>La liste est privée.</span>
        </p>
        <a href="{{ $list['url']['visibility'] }}" class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 cursor-pointer flex items-center">
          <x-heroicon-o-bell-alert class="w-4 h-4 mr-2 text-gray-500" />
          <span>Définir comme publique</span>
        </a>
        @endif
      </div>
      @endif

      <!-- share box -->
      <div x-show="showShare" x-cloak class="mb-10 border rounded-lg p-3 max-w-xl mx-auto" x-data="{ input: '{{ $list['uuid'] }}' }">
        <p>Pour permettre aux gens de voter sur cette liste, copier le lien ci-dessous et envoyez le à ceux qui comptent. Voter sur la liste ne nécessite pas de compte. De plus, chaque personne qui recoit le lien aura droit à un vote.</p>
        <p class="mb-4">Vous pourrez réinitialiser les votes quand vous voudrez.</p>
        <div class="flex">
          <input
            type="text"
            name="term"
            x-model="input"
            value="{{ $list['uuid'] }}"
            class="rounded-l-lg w-full sm:w-full py-2 px-4 border border-gray-300 bg-gray-100 dark:bg-gray-800 dark:border-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:border-gray-400"
          />
          <button
            @click="$clipboard(input)"
            class="border-t border-b border-r border-gray-300 bg-gray-100 dark:bg-gray-700 rounded-r-lg px-4 py-2 text-gray-900 dark:text-gray-100 font-bold">
            <x-heroicon-o-document-duplicate class="w-5 h-5" />
          </button>
        </div>
      </div>

      <div x-show="showSearch" x-cloak hx-target="this" hx-swap="innerHTML" class="px-2 py-2 bg-gray-100 rounded-lg border-gray-300 border mb-10">
        @include('user.lists.partials.search-items')
      </div>

      <!-- names -->
      <div
        hx-target="#names-index" hx-swap="innerHTML"
        hx-get="{{ route('list.name.index', $list['id']) }}"
        hx-trigger="loadNames from:body"
        class="mb-10"
        x-data="{ last_name: '{{ auth()->check() ? auth()->user()->last_name : "" }}' }">
        @include('user.lists.partials.names')
      </div>

      @if (count($list['names']) === 0)
      <div class="mt-10 text-center">
        <p class="mb-3">La liste ne contient pas encore de noms.</p>
        <p class="flex items-center justify-center">
          Pour ajouter un prénom dans cette liste, recherchez un prénom et ajoutez le dans la liste.
        </p>
      </div>
      @endif
    </div>
  </div>
</x-guest-layout>
