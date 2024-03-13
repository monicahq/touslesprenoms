<x-guest-layout class="bg-gray-50">
  <div class="bg-violet-100">
    <div class="border-b border-violet-200">
      @include('layouts.unlogged-navigation')
    </div>

    <div class="border-b border-violet-200">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 py-2">
        <ul class="text-xs">
          <li class="inline after:content-['>'] after:text-gray-500 after:text-xs">
            <a hx-boost="true" href="{{ route('home.index') }}" class="text-violet-900 underline">Accueil</a>
          </li>
          <li class="inline">Tous les prénoms</li>
        </ul>
      </div>
    </div>
  </div>

  <div>
    <div class="mx-auto max-w-3xl sm:px-6 lg:px-8 py-2">
      <h1 class="text-center text-3xl mb-4 mt-10">Votre compte</h1>

      <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
        <div class="bg-white shadow sm:rounded-lg">
          <div class="max-w-3xl">
            @include('profile.partials.name-form')
          </div>
        </div>

        <div class="bg-white shadow sm:rounded-lg">
          <div class="max-w-3xl">
            @include('profile.partials.update-profile-information-form')
          </div>
        </div>

        <div class="bg-white shadow sm:rounded-lg">
          <div class="max-w-3xl">
            @include('profile.partials.update-password-form')
          </div>
        </div>

        <div class="bg-white shadow sm:rounded-lg">
          <div class="max-w-3xl">
            @include('profile.partials.delete-user-form')
          </div>
        </div>
      </div>
    </div>
  </div>
</x-guest-layout>
