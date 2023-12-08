<nav class="border-b border-gray-100 bg-white dark:border-gray-700 dark:bg-gray-800"
     x-data="{ open: false }">

  <!-- Primary Navigation Menu -->
  <div class="mx-auto max-w-8xl px-4 sm:px-6 lg:px-8">
    <div class="flex items-center py-2 justify-between">
      <div class="flex">
        <!-- Logo -->
        <div class="flex shrink-0 items-center">
          <a href="{{ route('dashboard') }}">
            <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
          </a>
        </div>

        <!-- Navigation Links -->
        <div class="hidden space-x-4 sm:ms-10 sm:flex">
          <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('Dashboard') }}
          </x-nav-link>
          <x-nav-link :href="route('dashboard')">
            {{ __('Messages') }}
          </x-nav-link>
          <x-nav-link :href="route('dashboard')">
            {{ __('Projects') }}
          </x-nav-link>
          <x-nav-link :href="route('dashboard')">
            {{ __('Company') }}
          </x-nav-link>
          <x-nav-link dusk="nav-settings-link" :href="route('settings.index')" :active="request()->is('settings*')">
            {{ __('Settings') }}
          </x-nav-link>
        </div>
      </div>

      <!-- Settings Dropdown -->
      <div class="hidden sm:flex sm:items-center">
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <span class="text-sm text-blue-700 cursor-pointer underline hover:no-underline dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800" onclick="event.preventDefault(); this.closest('form').submit();">
            {{ __('Log out') }}
          </span>
        </form>
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
    <div class="space-y-1 pb-3 pt-2">
      <x-responsive-nav-link :href="route('dashboard')"
                             :active="request()->routeIs('dashboard')">
        {{ __('Dashboard') }}
      </x-responsive-nav-link>
    </div>

    <!-- Responsive Settings Options -->
    <div class="border-t border-gray-200 pb-1 pt-4 dark:border-gray-600">
      <div class="px-4">
        <div class="text-base font-medium text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
        <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
      </div>

      <div class="mt-3 space-y-1">
        <x-responsive-nav-link :href="route('profile.edit')">
          {{ __('Profile') }}
        </x-responsive-nav-link>

        <!-- Authentication -->
        <form method="POST"
              action="{{ route('logout') }}">
          @csrf

          <x-responsive-nav-link :href="route('logout')"
                                 onclick="event.preventDefault();
                                        this.closest('form').submit();">
            {{ __('Log out') }}
          </x-responsive-nav-link>
        </form>
      </div>
    </div>
  </div>
</nav>
