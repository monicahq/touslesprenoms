@if ($note != '')

<div x-show="! edit" class="flex justify-between">
  <span class="text-sm mb-2 text-gray-500 flex items-center"><x-heroicon-o-eye-slash class="w-4 h-4 mr-2" />Note privée</span>

  <ul class="text-sm">
    <li class="inline mr-2"><span @click="edit = true" class="underline cursor-pointer hover:underline">Editer</span></li>
    <li class="inline"><span class="underline cursor-pointer hover:underline">Supprimer</span></li>
  </ul>
</div>
<div x-show='! edit'>
  {!! $note !!}
</div>

@else

<div x-show="! edit" class="flex items-center justify-between">
  <p class="text-sm">Ajoutez une note privée à ce prénom.</p>
  @auth
  <span @click="edit = true" class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 cursor-pointer flex items-center">
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

<form x-show="edit">
  <div class="relative mb-3">
    <x-textarea class="mt-1 block w-full"
      id="note"
      name="note"
      type="text">{{ old('note', $note) }}</x-textarea>

    <x-input-error class="mt-2" :messages="$errors->get('note')" />
  </div>

  <div class="flex items-center">
    <button
      hx-put="{{ $name['url']['note_edit'] }}"
      hx-headers='{"X-CSRF-TOKEN": "{{ csrf_token() }}"}'
      class="px-2 py-1 inline-flex items-center justify-center whitespace-nowrap rounded-md font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 border border-gray-300 bg-transparent shadow-sm hover:bg-accent hover:text-accent-foreground transition ease-in-out duration-150 hover:bg-gray-100 dark:bg-gray-700 dark:text-white dark:hover:text-gray-800 mr-4">
      Sauvegarder
    </button>

    <span @click="edit = false" class="cursor-pointer underline hover:no-underline">Annuler</span>
  </div>
</form>
