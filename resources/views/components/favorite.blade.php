@props(['name', 'favorited' => false])

<div class="mb-8" hx-target="this" hx-swap="outerHTML">
  @if ($favorited)
    <div
        hx-put="{{ $name['url']['favorite'] }}"
        hx-headers='{"X-CSRF-TOKEN": "{{ csrf_token() }}"}'
        class="bg-amber-300 px-4 py-2 rounded-lg font-bold shadow text-center flex items-center justify-center cursor-pointer"> Enlever des favoris</div>
  @else
    <!-- if unlogged, favorite button should redirect to login -->
    @auth
      <div
        hx-put="{{ $name['url']['favorite'] }}"
        hx-headers='{"X-CSRF-TOKEN": "{{ csrf_token() }}"}'
        class="bg-gray-100 px-4 py-2 rounded-lg font-bold shadow text-center flex items-center justify-center cursor-pointer"> <x-heroicon-o-heart class="w-5 h-5 mr-2 text-gray-400 hover:text-rose-400 hover:w-5 hover:h-5 transition-all" /> Ajouter aux favoris</div>
    @else
      <a href="{{ route('login') }}" class="bg-gray-100 px-4 py-2 rounded-lg font-bold shadow text-center flex items-center justify-center"> <x-heroicon-o-heart class="w-5 h-5 mr-2 text-gray-400 hover:text-rose-400 hover:w-5 hover:h-5 transition-all cursor-pointer" /> Ajouter aux favoris</a>
    @endauth
  @endif
</div>
