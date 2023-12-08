<div id="roles-index">
  @forelse ($data['roles'] as $role)
  <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between hover:bg-blue-50 dark:hover:bg-gray-600 hover:border-l-blue-300 hover:border-l-2 border border-l-2 border-transparent border-b-gray-200 sm:border-b-0 sm:px-2 py-2">
    <div class="mb-2 sm:mb-0">{{ $role['label'] }}</div>

    <!-- actions -->
    <div class="text-sm">
      <x-link :boost="false"
        dusk="edit-role-{{ $role['id'] }}"
        href="{{ route('settings.role.edit', $role['id']) }}"
        class="mr-2">{{ __('Edit') }}</x-link>
      <x-htmx-link
        dusk="delete-role-{{ $role['id'] }}"
        hx-delete="{{ route('settings.role.destroy', $role['id']) }}"
        hx-confirm="{{ __('Are you sure you want to proceed? This can not be undone.') }}"
        >{{ __('Delete') }}</x-htmx-link>
    </div>
  </div>
  @empty
  <div class="text-gray-500 text-center py-4">
    {{ __('No roles have been defined yet') }}
  </div>
  @endforelse
</div>
