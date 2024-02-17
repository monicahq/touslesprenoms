@forelse ($names['names'] as $name)
<li class="flex items-center border border-transparent hover:bg-gray-50 hover:border-gray-200 px-2 py-1 rounded-sm">
  <div class="rounded-full w-6 mr-4 ring-4 ring-violet-100">{!! $name['avatar'] !!}</div>
  <a  href="{{ $name['url'] }}" class="text-lg">{{ $name['name'] }}</a>
</li>
@empty
fuck
@endforelse
