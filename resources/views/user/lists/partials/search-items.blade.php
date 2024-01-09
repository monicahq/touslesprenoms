<form class="flex w-full">
  <input
    type="text"
    name="term"
    value="{{ $term }}"
    autofocus
    class="rounded-l-lg w-full sm:w-full py-2 px-4 border border-gray-300 bg-white dark:bg-gray-800 dark:border-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:border-gray-400"
    placeholder="Rechercher un prénom pour l'ajouter à la liste"
  />
  <button
    hx-post="{{ $list['url']['search'] }}"
    hx-headers='{"X-CSRF-TOKEN": "{{ csrf_token() }}"}'
    class="border-t border-b border-r border-gray-300 bg-gray-100 dark:bg-gray-700 rounded-r-lg px-4 py-2 text-gray-900 dark:text-gray-100 font-bold">
    Rechercher
  </button>
</form>

@if (! is_null($search_items))
  @if ($search_items['names']->isEmpty())
  <p class="text-center my-5">Aucun résultat 😭</p>
  @else
  <ul class="overflow-auto h-50 bg-white dark:bg-gray-900 rounded-b-lg mt-4" x-data="{ last_name: '{{ auth()->check() ? auth()->user()->last_name : "" }}' }">
    @foreach ($search_items['names'] as $name)
    <li class="sm:flex cursor-pointer items-center justify-between border-b border-gray-200 px-3 py-2 hover:bg-slate-50 dark:border-gray-700 dark:bg-slate-900 hover:dark:bg-slate-800">
      <div class="flex">
        <div class="rounded-full w-6 mr-4 ring-4 ring-violet-100">{!! \App\Helpers\NameHelper::getAvatar($name['name']) !!}</div>
        <span>{{ $name['name'] }} <span x-text="last_name"></span></span>
      </div>

      <span
        hx-post="{{ route('list.name.store', ['liste' => $list['id'], 'id' => $name['id']]) }}"
        hx-headers='{"X-CSRF-TOKEN": "{{ csrf_token() }}"}'
        class="bg-amber-300 px-4 py-1 rounded-lg font-bold shadow">+ Ajouter</span>
    </li>
    @endforeach
  </ul>
  @endif
@endif
