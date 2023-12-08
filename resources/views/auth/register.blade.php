<x-guest-layout>
  <!-- image + title -->
  <div class="border-b px-6 py-4">
    <a href="/">
      <x-application-logo class="mx-auto mb-4 block w-28 text-center" />
    </a>

    <h2 class="mb-2 text-center font-bold">{{ __('Welcome to Shelter') }}</h2>
    <h3 class="text-center text-sm text-gray-700">{{ __('Be part of something unique.') }}</h3>
  </div>

  <form method="POST" action="{{ route('register') }}">
    @csrf

    <div class="px-6 py-4">
      <!-- first name and last name -->
      <div class="mb-4 flex justify-between">
        <div class="mr-4">
          <x-input-label for="first_name" :value="__('First name')" />
          <x-text-input class="mt-1 block w-full"
                        id="first_name"
                        name="first_name"
                        type="text"
                        :value="old('first_name')"
                        required
                        autofocus
                        autocomplete="first_name" />
          <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
        </div>

        <div>
          <x-input-label for="last_name" :value="__('Last name')" />
          <x-text-input class="mt-1 block w-full"
                        id="last_name"
                        name="last_name"
                        type="text"
                        :value="old('last_name')"
                        required
                        autocomplete="last_name" />
          <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
        </div>
      </div>

      <!-- Email Address -->
      <div class="mb-4">
        <x-input-label class="mb-1" for="email" :value="__('Email')" />
        <x-text-input class="mb-2 block w-full"
                      id="email"
                      name="email"
                      type="email"
                      :value="old('email')"
                      required
                      autocomplete="username" />

        <x-input-help>
          {{ __('We will send you a verification email, and won\'t spam you.') }}
        </x-input-help>

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
                      autocomplete="new-password" />

        <x-input-error class="mt-2" :messages="$errors->get('password')" />
      </div>

      <!-- Confirm Password -->
      <div class="mb-2">
        <x-input-label class="mb-1" for="password_confirmation" :value="__('Confirm Password')" />

        <x-text-input class="block w-full"
                      id="password_confirmation"
                      name="password_confirmation"
                      type="password"
                      required
                      autocomplete="new-password" />

        <x-input-error class="mt-2" :messages="$errors->get('password_confirmation')" />
      </div>
    </div>

    <div class="border-t px-6 py-4">
      <!-- organization -->
      <x-input-label for="organization_name" :value="__('Name of your organization')" />
      <x-text-input class="mt-1 block w-full"
                    id="organization_name"
                    name="organization_name"
                    type="text"
                    :value="old('organization_name')"
                    required
                    autocomplete="organization_name" />

      <x-input-error class="mt-2" :messages="$errors->get('organization_name')" />
    </div>

    <div class="flex items-center justify-between border-t px-6 py-4">
      <x-primary-button>
        {{ __('Register') }}
      </x-primary-button>

      <x-link href="{{ route('login') }}">
        {{ __('Already registered?') }}
      </x-link>
    </div>
  </form>
</x-guest-layout>
