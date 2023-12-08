<x-app-layout>
  <x-slot name="breadcrumb">
    <ul class="text-sm">
      <li class="inline after:content-['>'] after:text-gray-500 after:text-xs">
        <x-link href="{{ route('settings.index') }}">{{ __('Settings') }}</x-link>
      </li>
      <li class="inline">
        {{ __('Profile') }}
      </li>
    </ul>
  </x-slot>

  <div class="py-4 sm:py-12">
    <div class="mx-auto max-w-2xl px-2 sm:px-6 lg:px-8">
      <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 rounded sm:rounded-lg">
        <form method="POST" action="{{ route('settings.role.store') }}">
          @csrf

          <div class="relative border-b dark:border-gray-600 px-6 py-4">
            <h1 class="text-center text-lg font-bold">{{ __('Update your profile') }}</h1>
          </div>

          <div class="mb-4 grid grid-flow-col grid-cols-2 gap-4 px-6 py-4">
            <div class="mr-0">
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

          <div class="relative px-6 py-4">
            <x-input-label for="name"
                          :value="__('What is the name of this new role?')" />

            <x-text-input class="mt-1 block w-full"
                          id="label"
                          name="label"
                          type="text"
                          required
                          autofocus />

            <x-input-error class="mt-2" :messages="$errors->get('label')" />
          </div>

          <!-- actions -->
          <div class="flex items-center justify-between border-t dark:border-gray-600 bg-gray-50 dark:bg-gray-800 px-6 py-4">
            <x-link href="{{ route('settings.role.index') }}">{{ __('Back') }}</x-link>

            <div>
              <x-primary-button class="w-full text-center">
                {{ __('Add') }}
              </x-primary-button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</x-app-layout>
