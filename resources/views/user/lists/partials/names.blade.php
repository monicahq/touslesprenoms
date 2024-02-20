<div id="names-index">
@foreach ($list['names'] as $name)
  <div
    class="flex items-center justify-between border hover:bg-gray-50 hover:border-gray-200 px-2 py-1 mb-2 rounded-md"
    hx-target="this"
    hx-swap="delete"
    >
    <div class="flex items-center relative">
      <div class="top-0 relative rounded-full w-4 mr-4 ring-4 ring-violet-100">{!! \App\Helpers\NameHelper::getAvatar($name['name']) !!}</div>

      <div class="flex-col">
        <a href="{{ $name['url']['show'] }}" class="text-lg hover:underline">{{ $name['name'] }} <span x-text="last_name"></span></a>

        @if ($name['public_note'] != '')
        <p>{{ $name['public_note'] }}</p>
        @endif

        @if (auth()->user()->is_administrator)
        <p class="mb-1 italic flex items-center">
          <x-heroicon-c-plus class="w-3 h-3 mr-1 text-gray-500" />
          <a href="{{ $name['url']['note'] }}" class="text-xs hover:underline">ajouter une note</a>
        </p>
        @endif
        <p class="text-xs text-gray-700 flex">
          <x-heroicon-c-arrow-trending-up class="w-4 h-4 mr-1 text-gray-500" />
        {{ $name['total'] }} utilisations depuis 1900</p>
      </div>
    </div>

    <x-heroicon-o-trash
      hx-delete="{{ $name['url']['destroy'] }}"
      hx-headers='{"X-CSRF-TOKEN": "{{ csrf_token() }}"}'
      class="w-5 h-5 text-gray-400 hover:text-rose-400 transition-all cursor-pointer" />
  </div>
  @endforeach
</div>
