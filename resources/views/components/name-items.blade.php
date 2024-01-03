@props(['name', 'avatar', 'url', 'favorited' => false])

<div class="flex items-center justify-between border border-transparent hover:bg-gray-50 hover:border-gray-200 px-2 py-1 rounded-sm">
  <div class="flex items-center">
    <div class="rounded-full w-6 mr-4 ring-4 ring-violet-100">{!! $avatar !!}</div>
    <a hx-boost="true" href="{{ $url }}" class="text-lg">{{ $name }}</a>
  </div>

  @auth
    @if ($favorited)
      <x-heroicon-o-heart
        hx-put="{{ route('favorite.update') }}"
        hx-headers='{"X-CSRF-TOKEN": "{{ csrf_token() }}"}'
        class="w-4 h-4 ml-2 text-gray-400 hover:text-rose-400 hover:w-5 hover:h-5 transition-all cursor-pointer" />
    @else
      <x-heroicon-o-heart
        hx-put="{{ route('favorite.update') }}"
        hx-headers='{"X-CSRF-TOKEN": "{{ csrf_token() }}"}'
        class="w-4 h-4 ml-2 text-rose-400 hover:text-rose-400 hover:w-5 hover:h-5 transition-all cursor-pointer" />
    @endif
  @endauth
</div>
