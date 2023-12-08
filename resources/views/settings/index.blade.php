<x-app-layout>
  <div class="py-4 sm:py-12">
    <div class="mx-auto max-w-2xl px-2 sm:px-6 lg:px-8">
      <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 rounded sm:rounded-lg p-6">
        <div class="p-6 text-gray-900 dark:text-gray-100">
          <h1>{{ __('As a user, you can...') }}</h1>
          <ul class="mb-6">
            <li>
              <x-link href="{{ route('settings.profile.index') }}">{{ __('Manage your profile') }}</x-link>
            </li>
          </ul>

          <h1>{{ __('As an administrator, you can...') }}</h1>
          <ul>
            <li class="mb-2">
              <x-link href="{{ route('settings.role.index') }}" dusk="manage-role-link">{{ __('Manage roles') }}</x-link>
            </li>
            <li>
              <x-link href="{{ route('settings.level.index') }}" dusk="manage-level-link">{{ __('Manage levels') }}</x-link>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
