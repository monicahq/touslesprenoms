@props(['name', 'favorited' => false, 'showOrigins' => false])

<div
  {{ $attributes->merge(['class' => 'flex items-center justify-between border border-transparent hover:bg-gray-50 hover:border-gray-200 px-2 py-1 rounded-sm']) }}
  hx-target="this"
  hx-swap="outerHTML"
  >
  <div class="flex items-center">
    <div class="rounded-full w-6 mr-4 ring-4 ring-violet-100">{!! \App\Helpers\NameHelper::getAvatar($name['name']) !!}</div>
    <div class="flex-col w-full">
      <a href="{{ $name['url']['show'] }}" class="text-lg hover:underline">{{ $name['name'] }} <span x-text="last_name"></span></a>
      @if ($showOrigins)
        <div class="text-sm">{{ $name['origins'] }}</div>
      @endif
    </div>
  </div>

  <div class="flex items-center">
  @auth
    @if ($favorited)
    <svg
      hx-put="{{ $name['url']['favorite'] }}"
      hx-headers='{"X-CSRF-TOKEN": "{{ csrf_token() }}"}'
      class="w-5 h-5 ml-2 text-gray-400 hover:text-rose-400 hover:w-5 hover:h-5 transition-all cursor-pointer"
      xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#009926" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bookmark-check"><path d="m19 21-7-4-7 4V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2Z"/><path d="m9 10 2 2 4-4"/></svg>
    @else
    <x-heroicon-o-heart
      hx-put="{{ $name['url']['favorite'] }}"
      hx-headers='{"X-CSRF-TOKEN": "{{ csrf_token() }}"}'
      class="w-4 h-4 ml-2 text-gray-400 hover:text-rose-400 hover:w-5 hover:h-5 transition-all cursor-pointer" />
    @endif

  @else
    <a href="{{ route('register') }}">
      <svg
        class="w-5 h-5 ml-2 text-gray-400 hover:text-rose-400 hover:w-5 hover:h-5 transition-all cursor-pointer"
        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#9a9a9a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bookmark"><path d="m19 21-7-4-7 4V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16z"/>
    </a>
  @endauth
  </div>

</div>
