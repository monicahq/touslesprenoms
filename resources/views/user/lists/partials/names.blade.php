<div id="names-index">
@foreach ($list['names'] as $name)
  <div
    class="flex items-center justify-between border border-transparent hover:bg-gray-50 hover:border-gray-200 px-2 py-1 rounded-sm"
    hx-target="this"
    hx-swap="delete"
    >
    <div class="flex items-center">
      <div class="rounded-full w-6 mr-4 ring-4 ring-violet-100">{!! \App\Helpers\NameHelper::getAvatar($name['name']) !!}</div>

      <div class="flex-col">
        <a href="{{ $name['url']['show'] }}" class="text-lg hover:underline">{{ $name['name'] }} <span x-text="last_name"></span></a>
        <p class="text-xs text-gray-700">{{ $name['total'] }} utilisations depuis 1900</p>
      </div>
    </div>

    <x-heroicon-o-trash
      hx-delete="{{ $name['url']['destroy'] }}"
      hx-headers='{"X-CSRF-TOKEN": "{{ csrf_token() }}"}'
      class="w-5 h-5 text-gray-400 hover:text-rose-400 transition-all cursor-pointer" />
  </div>
  @endforeach
</div>
