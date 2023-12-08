<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Scripts -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
  <div class="flex min-h-screen flex-col items-center bg-gray-100 px-2 py-2 dark:bg-gray-900 sm:justify-center sm:px-0 sm:py-0">
    <div class="mb-6 w-full overflow-hidden rounded bg-white shadow-md dark:bg-gray-800 sm:mt-6 sm:max-w-md sm:rounded-lg">
      {{ $slot }}
    </div>

    <!-- locale -->
    <div class="mb-4">
      <ul class="list">
        <li class="mr-3 inline">
          <x-link :boost="false" href="{{ route('locale.update', ['locale' => 'en']) }}" class="text-sm" dusk="locale-switch-english">{{ __('English') }}</x-link>
        </li>
        <li class="inline">
          <x-link :boost="false" href="{{ route('locale.update', ['locale' => 'fr']) }}" class="text-sm" dusk="locale-switch-french">{{ __('French') }}</x-link>
        </li>
      </ul>
    </div>
  </div>
</body>

</html>
