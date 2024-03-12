<section>
  <header>
    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
      {{ __('Update Password') }}
    </h2>

    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
      {{ __('Ensure your account is using a long, random password to stay secure.') }}
    </p>
  </header>

  <form class="mt-6 space-y-6" method="POST" x-data="{
    form: $form('put', '{{ route('password.update') }}', {
      current_password: '',
      password: '',
      password_confirmation: '',
    }).setErrors({{ Js::from($errors->messages()) }}),
  }">
    @csrf
    @method('put')

    <div>
      <x-input-label for="current_password"
                     :value="__('Current Password')" />
      <x-text-input class="mt-1 block w-full"
                    id="current_password"
                    name="current_password"
                    x-model="form.current_password"
                    type="password"
                    @change="form.forgetError('current_password'); form.validate('current_password')"
                    autocomplete="current-password" />
      <x-input-validation class="mt-2" :form="'current_password'"
    </div>

    <div>
      <x-input-label for="password"
                     :value="__('New Password')" />
      <x-text-input class="mt-1 block w-full"
                    id="password"
                    name="password"
                    x-model="form.password"
                    type="password"
                    @change="form.forgetError('password'); form.validate('password')"
                    autocomplete="new-password" />

      <x-input-validation class="mt-2" :form="'password'" />
    </div>

    <div>
      <x-input-label for="password_confirmation"
                     :value="__('Confirm Password')" />
      <x-text-input class="mt-1 block w-full"
                    id="password_confirmation"
                    name="password_confirmation"
                    x-model="form.password_confirmation"
                    type="password"
                    @change="form.forgetError('password_confirmation'); form.validate('password_confirmation')"
                    autocomplete="new-password" />
      <x-input-validation class="mt-2" :form="'password_confirmation'" />
    </div>

    <div class="flex items-center gap-4">
      <x-primary-button disabled="form.processing || form.hasErrors">
        {{ __('Save') }}
      </x-primary-button>

      @if (session('status') === 'password-updated')
        <p class="text-sm text-gray-600 dark:text-gray-400"
           x-data="{ show: true }"
           x-show="show"
           x-transition
           x-init="setTimeout(() => show = false, 2000)">{{ __('Saved.') }}</p>
      @endif
    </div>
  </form>
</section>
