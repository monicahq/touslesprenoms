<x-app-layout>
  <x-slot name="breadcrumb">
    <ul class="text-sm">
      <li class="inline after:content-['>'] after:text-gray-500 after:text-xs">
        <x-link href="{{ route('settings.index') }}">{{ __('Settings') }}</x-link>
      </li>
      <li class="inline">
        {{ __('All the levels') }}
      </li>
    </ul>
  </x-slot>

  <div class="py-4 sm:py-12">
    <div class="mx-auto max-w-2xl px-2 sm:px-6 lg:px-8">
      <div hx-target="#levels-index" hx-swap="innerHTML" hx-get="{{ route('settings.level.index') }}" hx-trigger="loadLevels from:body" class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 rounded sm:rounded-lg p-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-4 border-b pb-2">
            <h1 class="font-semibold mb-2 sm:mb-0">{{ __('All the levels in your organization') }}</h1>

            <x-primary-link href="{{ route('settings.level.new') }}" dusk="add-level-cta" class="text-sm">
                {{ __('Add a level') }}
              </x-primary-link>
          </div>

          <x-help class="mb-4">
            {{ __('A level refers to a specific position or rank that represents the seniority or authority of someone within the organization.') }}
          </x-help>

          @include('settings.level.partials.index')
      </div>
    </div>
  </div>
</x-app-layout>
