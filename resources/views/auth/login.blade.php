<x-guest-layout>
  <!-- image + title -->
  <div class="border-b px-6 py-4">
    <a href="/">
      <x-application-logo class="mx-auto mb-4 block w-28 text-center" />
    </a>

    <h2 class="mb-2 text-center font-bold">{{ __('Welcome back to Shelter') }}</h2>
    <h3 class="text-center text-sm text-gray-700">{{ __('It\'s great to have you back!') }}</h3>
  </div>

  <!-- Session Status -->
  <x-session-status class="mb-4" :status="session('status')" />

  <form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="px-6 py-4">
      <!-- Email Address -->
      <div class="mb-4">
        <x-input-label class="mb-1" for="email" :value="__('Email')" />
        <x-text-input class="block w-full"
                      id="email"
                      name="email"
                      type="email"
                      :value="old('email')"
                      required
                      autofocus
                      autocomplete="username" />
        <x-input-error class="mt-2" :messages="$errors->get('email')" />
      </div>

      <!-- Password -->
      <div class="mb-4">
        <x-input-label class="mb-1" for="password" :value="__('Password')" />

        <x-text-input class="block w-full"
                      id="password"
                      name="password"
                      type="password"
                      required
                      autocomplete="current-password" />

        <x-input-error class="mt-2" :messages="$errors->get('password')" />
      </div>

      <!-- Remember Me -->
      <div class="block">
        <label class="inline-flex items-center" for="remember_me">
          <input class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                 id="remember_me"
                 name="remember"
                 type="checkbox">
          <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
        </label>
      </div>
    </div>

    <div class="flex items-center justify-between border-t px-6 py-4">
      <x-primary-button>
        {{ __('Log in') }}
      </x-primary-button>

      <x-link href="{{ route('password.request') }}">
        {{ __('Forgot your password?') }}
      </x-link>
    </div>
  </form>
</x-guest-layout>
