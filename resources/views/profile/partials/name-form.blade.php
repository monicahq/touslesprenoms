<section>
  <header class="relative border-b dark:border-gray-600 px-6 py-4 bg-yellow-50">
    <h2 class="text-center font-bold mb-2">Utilisez un nom de famille</h2>
    <p class="mt-1 text-sm text-center text-gray-600">Entrez votre nom de famille pour que vous puissiez voir à quoi les prénoms ressemblent visuellement.</p>
  </header>

  <form class="mt-6 space-y-4" method="POST" x-data="{
    form: $form('put', '{{ route('profile.name') }}', {
      last_name: '{{ old('last_name', $user->last_name) }}',
    }).setErrors({{ Js::from($errors->messages()) }}),
    saved: {{ Js::from(session('status') === 'name-updated') }},
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
      @method('PUT')

      <div class="relative px-6">
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


      <div class="mb-auto px-6 w-50">
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
