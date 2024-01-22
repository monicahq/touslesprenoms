<form class="w-full" hx-target="this" hx-swap="outerHTML">
  <div class="relative mb-3">
    <x-textarea class="mt-1 block w-full"
      id="note"
      name="note"
      type="text">{{ old('note', $note) }}</x-textarea>

    <x-input-error class="mt-2" :messages="$errors->get('note')" />
  </div>

  <div class="flex items-center">
    <button
      hx-put="{{ $url['update'] }}"
      hx-headers='{"X-CSRF-TOKEN": "{{ csrf_token() }}"}'
      class="px-2 py-1 inline-flex items-center justify-center whitespace-nowrap rounded-md font-medium focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 border border-gray-300 bg-transparent shadow-sm hover:bg-accent hover:text-accent-foreground transition ease-in-out duration-150 hover:bg-gray-100 dark:bg-gray-700 dark:text-white dark:hover:text-gray-800 mr-4">
      Sauvegarder
    </button>

    <span hx-get="{{ $url['show'] }}" class="cursor-pointer underline hover:no-underline">Annuler</span>
  </div>
</form>
