<nav class=""
     x-data="{ open: false }">

  <!-- Primary Navigation Menu -->
  <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
    <div class="flex items-center py-4 sm:px-0 px-4 justify-between">
      <div class="flex">
        <!-- Logo -->
        <div class="flex shrink-0 items-center">
          <a href="{{ route('home.index') }}">
            <x-application-logo class="block h-12 w-auto fill-current text-gray-800 dark:text-gray-200" />
          </a>
        </div>

        <!-- Navigation Links -->
        <div class="hidden space-x-4 sm:ms-10 sm:flex items-center">
          <div>
            <x-unlogged-nav-link class="mr-4" hx-boost="true" :href="route('home.index')" :active="request()->routeIs('home.index')">
              {{ __('Accueil') }}
            </x-unlogged-nav-link>
            <x-unlogged-nav-link class="mr-4" hx-boost="true" :href="route('name.index')" :active="request()->routeIs('name*')">
              {{ __('Tous les prénoms') }}
            </x-unlogged-nav-link>
            <x-unlogged-nav-link class="mr-4" hx-boost="true" :href="route('search.index')" :active="request()->routeIs('search*')">
              {{ __('Recherche') }}
            </x-unlogged-nav-link>

            @auth
            <x-unlogged-nav-link class="mr-4" hx-boost="true" :href="route('favorite.index')" :active="request()->routeIs('favorite*')">
              {{ __('Vos favoris') }}
            </x-unlogged-nav-link>
            <x-unlogged-nav-link class="mr-4" hx-boost="true" :href="route('list.index')" :active="request()->routeIs('list*')">
              {{ __('Vos listes') }}
            </x-unlogged-nav-link>
            <x-unlogged-nav-link class="mr-4" hx-boost="true" :href="route('profile.show')" :active="request()->routeIs('profile*')">
              {{ __('Votre compte') }}
            </x-unlogged-nav-link>
            @endauth
          </div>
        </div>
      </div>

      <!-- Settings Dropdown -->
      <div class="hidden sm:flex sm:items-center">

          @auth
           <form method="POST"
              action="{{ route('logout') }}">
              @csrf
              <span class="text-sm text-blue-700 cursor-pointer underline hover:no-underline dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800" onclick="event.preventDefault(); this.closest('form').submit();">
                Déconnexion
              </span>
            </form>
          @endauth

          @guest

            <a hx-boost="true" href="{{ route('register') }}" class="bg-amber-300 mr-4 px-4 py-2 rounded-lg font-bold shadow flex items-center"><x-heroicon-o-user-circle class="mr-2 w-5 h-5" /> <span>Créer votre compte</span></a>
            <a hx-boost="true" href="{{ route('login') }}" class="inline-flex items-center text-md font-bold text-cyan-950 focus:outline-none focus:border-indigo-700 transition duration-250 ease-in-out"><span>Connexion</span></a>

          @endguest
      </div>

      <div class="-me-2 flex items-center sm:hidden">
        <button class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-gray-500 focus:bg-gray-100 focus:text-gray-500 focus:outline-none dark:text-gray-500 dark:hover:bg-gray-900 dark:hover:text-gray-400 dark:focus:bg-gray-900 dark:focus:text-gray-400"
                @click="open = ! open">
          <svg class="h-6 w-6"
               stroke="currentColor"
               fill="none"
               viewBox="0 0 24 24">
            <path class="inline-flex"
                  :class="{ 'hidden': open, 'inline-flex': !open }"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M4 6h16M4 12h16M4 18h16" />
            <path class="hidden"
                  :class="{ 'hidden': !open, 'inline-flex': open }"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
    </div>
  </div>

  <!-- Responsive Navigation Menu -->
  <div class="hidden sm:hidden"
       :class="{ 'block': open, 'hidden': !open }">
    <div class="space-y-1 pt-2">
      <x-responsive-nav-link :href="route('home.index')"
                             :active="request()->routeIs('home*')">
        {{ __('Accueil') }}
      </x-responsive-nav-link>
    </div>

    <!-- Responsive Settings Options -->
    <div class="border-t border-gray-200 pb-1 dark:border-gray-600">
      <div class="mt-3 space-y-1">
        <x-responsive-nav-link :href="route('name.index')">
          {{ __('Tous les prénoms') }}
        </x-responsive-nav-link>

        <x-responsive-nav-link :href="route('search.index')" :active="request()->routeIs('search*')">
          {{ __('Recherche') }}
        </x-responsive-nav-link>

        @auth
        <x-responsive-nav-link class="mr-4" hx-boost="true" :href="route('favorite.index')" :active="request()->routeIs('favorite*')">
          {{ __('Vos favoris') }}
        </x-responsive-nav-link>
        <x-responsive-nav-link class="mr-4" hx-boost="true" :href="route('list.index')" :active="request()->routeIs('list*')">
          {{ __('Vos listes') }}
        </x-responsive-nav-link>
        <x-responsive-nav-link class="mr-4" hx-boost="true" :href="route('profile.show')" :active="request()->routeIs('profile*')">
          {{ __('Votre compte') }}
        </x-responsive-nav-link>
        @endauth

        <!-- Authentication -->
        @auth
        <form method="POST"
              action="{{ route('logout') }}">
          @csrf

          <x-responsive-nav-link :href="route('logout')"
                                 onclick="event.preventDefault();
                                        this.closest('form').submit();">
            {{ __('Log out') }}
          </x-responsive-nav-link>
        </form>
        @endauth
      </div>
    </div>
  </div>
</nav>
