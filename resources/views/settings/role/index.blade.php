<x-app-layout>
  <x-slot name="breadcrumb">
    <ul class="text-sm">
      <li class="inline after:content-['>'] after:text-gray-500 after:text-xs">
        <x-link href="{{ route('settings.index') }}">{{ __('Settings') }}</x-link>
      </li>
      <li class="inline">
        {{ __('Roles') }}
      </li>
    </ul>
  </x-slot>

  <div class="py-4 sm:py-12">
    <div class="mx-auto max-w-2xl px-2 sm:px-6 lg:px-8">
      <div hx-target="#roles-index" hx-swap="innerHTML" hx-get="{{ route('settings.role.index') }}" hx-trigger="loadRoles from:body" class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 rounded sm:rounded-lg p-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-4 border-b dark:border-gray-600 pb-2">
          <h1 class="font-semibold mb-2 sm:mb-0">{{ __('All the roles in your organization') }}</h1>

          <x-primary-link href="{{ route('settings.role.new') }}" dusk="add-role-cta" class="text-sm">
            {{ __('Add a role') }}
          </x-primary-link>
        </div>

        <x-help class="mb-4">
          {{ __('A role refers to a specific job or position that an individual performs within your organization.') }}
        </x-help>

        @include('settings.role.partials.index')
      </div>
    </div>
  </div>
</x-app-layout>
