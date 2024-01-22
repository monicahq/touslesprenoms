@props(['note', 'url', 'deleteUrl'])

@if ($note != '')

<div hx-target="this" hx-swap="outerHTML">
  <div class="flex justify-between">
    <span class="text-sm mb-2 text-gray-500 flex items-center"><x-heroicon-o-eye-slash class="w-4 h-4 mr-2" />Note privée</span>

    <ul class="text-sm">
      <li class="inline mr-2"><span hx-get="{{ $url }}" class="underline cursor-pointer hover:underline">Editer</span></li>
      <li class="inline"><span
        hx-delete="{{ $deleteUrl }}"
        hx-headers='{"X-CSRF-TOKEN": "{{ csrf_token() }}"}'
        class="underline cursor-pointer hover:underline">Supprimer</span></li>
    </ul>
  </div>
  <div>
    {!! $note !!}
  </div>
</div>

@else

<div class="flex items-center justify-between" hx-get="{{ $url }}" hx-swap="outerHTML">
  <p class="text-sm">Ajoutez une note privée à ce prénom.</p>
  @auth
  <span class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 cursor-pointer flex items-center">
    <x-heroicon-o-pencil-square class="w-4 h-4 mr-2 text-gray-500" />
    <span>Ajouter</span>
  </span>
  @else
  <a href="{{ route('login') }}" class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 cursor-pointer flex items-center">
    <x-heroicon-o-pencil-square class="w-4 h-4 mr-2 text-gray-500" />
    <span>Ajouter</span>
  </a>
  @endauth
</div>

@endif
