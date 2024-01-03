<x-login-layout>
  <div class="border-b px-6 py-4">
    <div class="text-sm text-gray-600 dark:text-gray-400">
      Merci de vous inscrire ! Avant de commencer, pourriez-vous vérifier votre adresse électronique en cliquant sur le lien que nous venons de vous envoyer par courriel ? Si vous n'avez pas reçu le courriel, nous vous en enverrons volontiers un autre.
    </div>
  </div>

  @if (session('status') == 'verification-link-sent')
    <div class="px-6 py-4 text-sm font-medium text-green-600 dark:text-green-400">
      Un nouveau lien de vérification a été envoyé à l'adresse e-mail que vous avez fournie lors de votre inscription.
    </div>
  @endif

  <div class="flex flex-col items-center justify-between px-6 py-4 sm:flex-row">
    <form method="POST"
          action="{{ route('verification.send') }}">
      @csrf

      <div class="mb-4 sm:mb-0">
        <x-primary-button>
          Renvoyer l'email de vérification
        </x-primary-button>
      </div>
    </form>

    <form method="POST"
          action="{{ route('logout') }}">
      @csrf

      <button class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800"
              type="submit">
        {{ __('Déconnexion') }}
      </button>
    </form>
  </div>
</x-login-layout>
