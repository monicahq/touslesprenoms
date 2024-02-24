<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="description" content="Trouvez le prénom idéal pour votre enfant. Découvrez l'origine, la signification, les célébrités et la popularité de milliers de prénoms.">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Scripts -->
  @vite('resources/js/app.js')

  {{ $jsonLdSchema ?? '' }}

  <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🌞</text></svg>">
</head>

<body class="font-sans text-gray-900 antialiased">
  @fragment('page')
  <div class="flex min-h-screen flex-col" id="page">
    {{ $slot }}
  </div>
  @endfragment

  <div class="bg-violet-100 border-t border-violet-200">
    @include('layouts.footer')
  </div>
</body>

</html>
