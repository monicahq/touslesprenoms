<x-login-layout>
  <!-- image + title -->
  <div class="border-b px-6 py-4">
    <a href="/" class="mx-auto block w-full">
      <x-application-logo class="mx-auto mb-4 block w-16 text-center" />
    </a>

    <h2 class="mb-2 text-center font-bold">Bienvenue</h2>
    <h3 class="text-center text-sm text-gray-700">Créez un compte pour sauvegarder vos noms préférés, créer des listes et demander le vote de vos bien-aimés.</h3>
  </div>

  <form method="POST" action="{{ route('register') }}">
    @csrf

    <div class="px-6 py-4">
      <!-- Email Address -->
      <div class="mb-4">
        <x-input-label class="mb-1" for="email" :value="'Email'" />
        <x-text-input class="mb-2 block w-full"
                      id="email"
                      name="email"
                      type="email"
                      :value="old('email')"
                      required
                      autocomplete="username" />

        <x-input-help>
          Nous vous enverrons un email de vérification, et ne vous spammerons jamais. On déteste le spam nous aussi.
        </x-input-help>

        <x-input-error class="mt-2" :messages="$errors->get('email')" />
      </div>

      <!-- Password -->
      <div class="mb-4">
        <x-input-label class="mb-1" for="password" :value="'Mot de passe'" />

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
        <x-input-label class="mb-1" for="password_confirmation" :value="'Confirmez le mot de passe'" />

        <x-text-input class="block w-full"
                      id="password_confirmation"
                      name="password_confirmation"
                      type="password"
                      required
                      autocomplete="new-password" />

        <x-input-error class="mt-2" :messages="$errors->get('password_confirmation')" />
      </div>
    </div>

    <div class="flex items-center justify-between border-t px-6 py-4">
      <x-primary-button>
        {{ __('Créez le compte') }}
      </x-primary-button>

      <x-link href="{{ route('login') }}">
        {{ __('Déjà inscrit ?') }}
      </x-link>
    </div>
  </form>
</x-login-layout>
