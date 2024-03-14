<section>
  <header class="relative border-b dark:border-gray-600 px-6 py-4 bg-yellow-50">
    <h1 class="text-center font-bold">Changer votre mot de passe</h1>
    <p class="mt-1 text-sm text-center text-gray-600">
      {{ __('Ensure your account is using a long, random password to stay secure.') }}
    </p>
  </header>

  <form class="mt-6 space-y-4" method="POST" x-data="{
    form: $form('put', '{{ route('password.update') }}', {
      current_password: '',
      password: '',
      password_confirmation: '',
    }).setErrors({{ Js::from($errors->messages()) }}),
    saved: {{ Js::from(session('status') === 'password-updated') }},
    show_saved() {
      this.saved = true;
      setTimeout(() => {
        this.saved = false;
      }, 6000);
    },
    submit() {
      this.form.submit()
        .then(() => {
          this.form.reset();
          this.show_saved();
        })
        .catch((e) => {
          if (e.response.data) {
            this.form.setErrors(e.response.data.errors);
          }
        });
    },
  }" @submit.prevent="submit">
    @csrf
    @method('put')

    <div class="relative px-6">
      <x-input-label for="current_password"
                     :value="__('Current Password')" />
      <x-text-input class="mt-1 block w-full"
                    id="current_password"
                    name="current_password"
                    x-model="form.current_password"
                    type="password"
                    @change="form.forgetError('current_password'); form.validate('current_password')"
                    autocomplete="current-password" />
      <x-input-validation class="mt-2" :form="'current_password'" />
    </div>

    <div class="mb-auto px-6">
      <x-input-label for="password"
                     :value="__('New Password')" />
      <x-text-input class="mt-1 block w-full"
                    id="password"
                    name="password"
                    x-model="form.password"
                    type="password"
                    @change="form.forgetError('password'); if (form.password && form.password_confirmation) { form.validate('password'); }"
                    autocomplete="new-password" />

      <x-input-validation class="mt-2" :form="'password'" />
    </div>

    <div class="mb-auto px-6">
      <x-input-label for="password_confirmation"
                     :value="__('Confirm Password')" />
      <x-text-input class="mt-1 block w-full"
                    id="password_confirmation"
                    name="password_confirmation"
                    x-model="form.password_confirmation"
                    type="password"
                    @change="form.forgetError('password'); if (form.password && form.password_confirmation) { form.validate('password'); }"
                    autocomplete="new-password" />
      <x-input-validation class="mt-2" :form="'password_confirmation'" />
    </div>

    <div class="flex items-center justify-between border-t bg-white px-6 py-4">
      <x-primary-button disabled="form.processing || form.hasErrors">
        {{ __('Save') }}
      </x-primary-button>

      <p class="text-sm text-gray-600"
        x-show="saved"
        x-transition
        x-init="if (saved) { show_saved; }">{{ __('Saved.') }}</p>
    </div>
  </form>
</section>
