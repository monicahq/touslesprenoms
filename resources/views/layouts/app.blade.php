<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>⛺</text></svg>">

  <!-- Scripts -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-slate-900 dark:text-gray-100">
  <div class="min-h-screen bg-gray-100 dark:bg-gray-900 relative">
    @include('layouts.navigation')

    <!-- Breadcrumb -->
    @if (isset($breadcrumb))
    <header class="bg-white shadow dark:bg-gray-800">
      <div class="mx-auto max-w-8xl px-4 py-2 sm:px-6 lg:px-8">
        {{ $breadcrumb }}
      </div>
    </header>
    @endif

    <!-- Page Content -->
    <main>
      {{ $slot }}
    </main>

    @if (session('status'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" class="absolute right-10 top-12 pt-6 mx-auto max-w-xl px-2 sm:px-6 lg:px-8">
      <div class="flex items-center overflow-hidden border border-red-200 bg-white shadow-sm dark:bg-gray-800 rounded sm:rounded-lg pr-2">
        <div class="px-2 py-2 bg-orange-100 mr-2">
          <x-heroicon-o-light-bulb class="h-5 w-5 text-red-500" />
        </div>

        <p>{{ session('status') }}</p>
      </div>
    </div>
    @endif
  </div>
</body>

</html>
