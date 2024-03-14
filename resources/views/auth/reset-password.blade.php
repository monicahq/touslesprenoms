<x-login-layout>

  <div class="border-b px-6 py-4 text-sm text-gray-600 dark:text-gray-400">
    Réinitialisez votre mot de passe
  </div>

  <form method="POST" x-data="{
    form: $form('post', '{{ route('password.store') }}', {
      token: '{{ $request->route('token') }}',
      email: '{{ old('email', $request->email) }}',
      password: '',
      password_confirmation: '',
    }).setErrors({{ Js::from($errors->messages()) }}),
  }">
    @csrf

    <div class="px-6 py-4">
      <!-- Password Reset Token -->
      <input name="token"
            type="hidden"
            x-model="form.token">

      <!-- Email Address -->
      <div>
        <x-input-label for="email"
                      :value="__('Email')" />
        <x-text-input class="mt-1 block w-full"
                      id="email"
                      name="email"
                      type="email"
                      x-model="form.email"
                      required
                      autofocus
                      @change="form.forgetError('email'); form.validate('email')"
                      autocomplete="username" />
        <x-input-validation class="mt-2" :form="'email'" />
      </div>

      <!-- Password -->
      <div class="mt-4">
        <x-input-label for="password"
                      :value="__('Password')" />
        <x-text-input class="mt-1 block w-full"
                      id="password"
                      name="password"
                      x-model="form.password"
                      type="password"
                      @change="if (form.password && form.password_confirmation) { form.validate('password') }"
                      required
                      autocomplete="new-password" />

        <x-input-validation class="mt-2" :form="'password'" />
      </div>

      <!-- Confirm Password -->
      <div class="mt-4">
        <x-input-label for="password_confirmation"
                      :value="__('Confirm Password')" />

        <x-text-input class="mt-1 block w-full"
                      id="password_confirmation"
                      name="password_confirmation"
                      x-model="form.password_confirmation"
                      type="password"
                      required
                      @change="form.forgetError('password_confirmation'); form.validate('password_confirmation')"
                      autocomplete="new-password" />

        <x-input-validation class="mt-2" :form="'password_confirmation'" />
      </div>
    </div>

    <div class="flex items-center justify-between border-t px-6 py-4">
      <x-primary-button disabled="form.processing || form.hasErrors">
        {{ __('Reset Password') }}
      </x-primary-button>
    </div>
  </form>
</x-login-layout>
