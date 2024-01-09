<div hx-target="this" hx-swap="outerHTML" class="border-b last:border-b-0 px-2 py-2 flex items-center hover:bg-gray-50">
    @if ($list['contains_name'])
    <x-heroicon-o-check-badge hx-put="{{ $list['url']['store'] }}" hx-headers='{"X-CSRF-TOKEN": "{{ csrf_token() }}"}' class="w-5 h-5 mr-1 text-lime-600 hover:text-rose-400 hover:w-5 hover:h-5 transition-all cursor-pointer" />
    <a href="{{ $list['url']['show'] }}" class="font-semibold hover:underline">{{ $list['name'] }}</a>
    @else
    <x-heroicon-o-plus-circle hx-put="{{ $list['url']['store'] }}" hx-headers='{"X-CSRF-TOKEN": "{{ csrf_token() }}"}' class="w-5 h-5 mr-1 text-gray-400 hover:text-rose-400 hover:w-5 hover:h-5 transition-all cursor-pointer" />
    <a href="{{ $list['url']['show'] }}" class="hover:underline">{{ $list['name'] }}</a>
    @endif
</div>