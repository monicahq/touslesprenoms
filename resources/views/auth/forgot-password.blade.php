<x-guest-layout>

  <div class="border-b px-6 py-4 text-sm text-gray-600 dark:text-gray-400">
    {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
  </div>

  <!-- Session Status -->
  <x-session-status class="mb-4" :status="session('status')" />

  <form method="POST"
        action="{{ route('password.email') }}">
    @csrf

    <!-- Email Address -->
    <div class="border-b px-6 py-4">
      <x-input-label class="mb-1"
                     for="email"
                     :value="__('Email')" />
      <x-text-input class="block w-full"
                    id="email"
                    name="email"
                    type="email"
                    :value="old('email')"
                    required
                    autofocus />
      <x-input-error class="mt-2"
                     :messages="$errors->get('email')" />
    </div>

    <div class="flex items-center px-6 py-4">
      <x-primary-button>
        {{ __('Email password reset link') }}
      </x-primary-button>
    </div>
  </form>
</x-guest-layout>
