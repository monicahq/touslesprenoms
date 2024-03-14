<x-guest-layout class="bg-gray-50">
  <div class="bg-violet-100">
    <div class="border-b border-violet-200">
      @include('layouts.unlogged-navigation')
    </div>

    <div class="border-b border-violet-200">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 py-2">
        <ul class="text-xs">
          <li class="inline after:content-['>'] after:text-gray-500 after:text-xs">
            <a hx-boost="true" href="{{ route('home.index') }}" class="text-violet-900 underline">Accueil</a>
          </li>
          <li class="inline">Tous les prénoms</li>
        </ul>
      </div>
    </div>
  </div>

  <div>
    <div class="mx-auto max-w-3xl sm:px-6 lg:px-8 py-2">
      <h3 class="text-center text-3xl mb-4 mt-10">Votre compte</h3>

      <form method="POST" x-data="{
        form: $form('put', '{{ route('profile.name') }}', {
          last_name: '{{ old('last_name', $user->last_name) }}',
        }).setErrors({{ Js::from($errors->messages()) }}),
      }" class="mb-8 shadow sm:rounded-lg">
          @csrf
          @method('PUT')

          <div class="relative border-b dark:border-gray-600 px-6 py-4 bg-yellow-50">
            <h1 class="text-center font-bold mb-2">Utilisez un nom de famille</h1>
            <p class="text-center">Entrez votre nom de famille pour que vous puissiez voir à quoi les prénoms ressemblent visuellement.</p>
          </div>

          <div class="relative px-6 pt-4 pb-2">
            <x-input-label for="last_name"
                          :optional="true"
                          :value="'Indiquez un nom de famille'" />

            <x-text-input class="mt-1 block w-full"
                          id="last_name"
                          name="last_name"
                          x-model="form.last_name"
                          @change="form.forgetError('last_name'); form.validate('last_name')"
                          type="text" />

            <x-input-validation class="mt-2" :form="'last_name'" />
          </div>


          <div class="mb-auto px-6 pt-4 pb-2 w-50">
            <p class="mb-2">Exemple ci-dessous:</p>

            <div class="flex items-center justify-between border border-transparent hover:bg-gray-50 hover:border-gray-200 px-2 py-1 rounded-sm">
              <div class="flex items-center">
                <div class="rounded-full w-6 mr-4 ring-4 ring-violet-100">{!! \App\Helpers\NameHelper::getAvatar('Jean') !!}</div>
                <div class="text-lg hover:underline">Jean <span x-text="form.last_name"></span></div>
              </div>

            <svg class="w-5 h-5 ml-2 text-gray-400 hover:text-rose-400 hover:w-5 hover:h-5 transition-all cursor-pointer"
                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#009926" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bookmark-check"><path d="m19 21-7-4-7 4V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2Z"/><path d="m9 10 2 2 4-4"/></svg>
            </div>
          </div>

          <!-- actions -->
          <div class="flex items-center justify-between border-t dark:border-gray-600 bg-white dark:bg-gray-800 px-6 py-4">
            <div>
              <x-primary-button class="w-full text-center">
                Sauvegarder
              </x-primary-button>
            </div>
          </div>
        </form>

      <form method="POST" x-data="{
        form: $form('put', '{{ route('profile.update') }}', {
          email: '{{ old('email') }}',
          password: '',
          password_confirmation: '',
        }).setErrors({{ Js::from($errors->messages()) }}),
      }" class="mb-6 shadow sm:rounded-lg">
        @csrf
        @method('PUT')

        <div class="relative border-b dark:border-gray-600 px-6 py-4 bg-yellow-50">
          <h1 class="text-center font-bold">Changer votre mot de passe</h1>
        </div>

        <div class="relative px-6 pt-4 pb-2">
          <x-input-label for="current_password"
                        :value="'Mot de passe actuel'" />

          <x-text-input class="mt-1 block w-full"
                        id="current_password"
                        name="current_password"
                        x-model="form.current_password"
                        type="password"
                        required />

          <x-input-validation class="mt-2" :form="'current_password'" />
        </div>

        <div class="relative px-6 py-2">
          <x-input-label for="password"
                        :value="'Nouveau mot de passe'" />

          <x-text-input class="mt-1 block w-full"
                        id="password"
                        name="password"
                        x-model="form.password"
                        type="password"
                        @change="if (form.password && form.password_confirmation) { form.validate('password') }"
                        required />

        <x-input-validation class="mt-2" :form="'password'" />
        </div>

        <div class="relative px-6 pt-2 pb-4">
          <x-input-label for="password_confirmation"
                        :value="'Confirmer le nouveau mot de passe'" />

          <x-text-input class="mt-1 block w-full"
                        id="password_confirmation"
                        name="password_confirmation"
                        x-model="form.password_confirmation"
                        type="password"
                        @change="if (form.password && form.password_confirmation) { form.validate('password') }"
                        required />

          <x-input-validation class="mt-2" :form="'password_confirmation'" />
        </div>

        <!-- actions -->
        <div class="flex items-center justify-between border-t dark:border-gray-600 bg-white dark:bg-gray-800 px-6 py-4">
          <div>
            <x-primary-button class="w-full text-center" disabled="form.processing || form.hasErrors">
              Sauvegarder
            </x-primary-button>
          </div>
        </div>
      </form>

      <!-- delete account -->
      <div class="mb-6 shadow sm:rounded-lg">
        <div class="relative border-b dark:border-gray-600 px-6 py-4 bg-yellow-50">
          <h1 class="text-center font-bold">Détruire votre compte</h1>
        </div>

        <!-- actions -->
        <div class="flex items-center justify-between dark:border-gray-600 bg-white dark:bg-gray-800 px-6 py-4">
          <x-danger-button
              x-data=""
              x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
          >{{ __('Delete Account') }}</x-danger-button>

          <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
            <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
              @csrf
              @method('delete')

              <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Are you sure you want to delete your account?') }}
              </h2>

              <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
              </p>

              <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Password') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
              </div>

              <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('Delete Account') }}
                </x-danger-button>
              </div>
            </form>
          </x-modal>
        </div>
      </div>
    </div>
  </div>
</x-guest-layout>
