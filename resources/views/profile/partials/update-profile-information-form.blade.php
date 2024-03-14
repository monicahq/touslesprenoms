<section>
  <header class="relative border-b dark:border-gray-600 px-6 py-4 bg-yellow-50">
    <h2 class="text-center font-bold mb-2">
      {{ __('Profile Information') }}
    </h2>
    <p class="mt-1 text-sm text-center text-gray-600">
      Modifier le profil associé à votre compte
    </p>
  </header>

  <form id="send-verification"
        method="post"
        action="{{ route('verification.send') }}">
    @csrf
  </form>

  <form class="mt-6 space-y-4" method="POST" x-data="{
    form: $form('put', '{{ route('profile.update') }}', {
      email: '{{ old('email', $user->email) }}',
    }).setErrors({{ Js::from($errors->messages()) }}),
    saved: {{ Js::from(session('status') === 'profile-updated') }},
    show_saved() {
      this.saved = true;
      setTimeout(() => {
        this.saved = false;
      }, 6000);
    },
    submit() {
      this.form.submit()
        .then(() => {
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

    <div class="mb-auto px-6">
      <x-input-label for="email"
                     :value="__('Email')" />
      <x-text-input class="mt-1 block w-full"
                    id="email"
                    name="email"
                    type="email"
                    x-model="form.email"
                    required
                    @change="form.forgetError('email'); form.validate('email')"
                    autocomplete="username" />
      <x-input-validation class="mt-2" :form="'email'" />

      @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
        <div>
          <p class="mt-2 text-sm text-gray-800">
            {{ __('Your email address is unverified.') }}

            <button class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    form="send-verification">
              {{ __('Click here to re-send the verification email.') }}
            </button>
          </p>

          @if (session('status') === 'verification-link-sent')
            <p class="mt-2 text-sm font-medium text-green-600">
              {{ __('A new verification link has been sent to your email address.') }}
            </p>
          @endif
        </div>
      @endif
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
