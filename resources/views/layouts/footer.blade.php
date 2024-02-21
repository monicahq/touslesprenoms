<div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
  <div class="flex items-center py-4 text-xs">
    <div class="mr-10">
      © 2023-{{ now()->year }}
    </div>
    <div class="flex">
      <a href="{{ route('about.index') }}" class="underline mr-4">A propos</a>
      <a href="{{ route('terms.index') }}" class="underline">Conditions d'utilisation</a>
    </div>
  </div>
</div>
