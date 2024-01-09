<ul class="space-y-1">
  <li class="p-2 border {{ request()->routeIs('name.index') ? 'bg-yellow-100 border-yellow-200' : 'border-transparent' }} hover:bg-yellow-100 hover:border-yellow-200 rounded-md">
    <a hx-boost="true" href="{{ route('name.index') }}">Tous les prénoms</a>
  </li>
  <li class="p-2 border {{ request()->routeIs('name.garcon.index') ? 'bg-yellow-100 border-yellow-200' : 'border-transparent' }} hover:bg-yellow-100 hover:border-yellow-200 rounded-md">
    <a hx-boost="true" href="{{ route('name.garcon.index') }}">Prénoms masculins</a>
  </li>
  <li class="p-2 border {{ request()->routeIs('name.fille.index') ? 'bg-yellow-100 border-yellow-200' : 'border-transparent' }} hover:bg-yellow-100 hover:border-yellow-200 rounded-md">
    <a hx-boost="true" href="{{ route('name.fille.index') }}">Prénoms féminins</a>
  </li>
  <li class="p-2 border {{ request()->routeIs('name.mixte.index') ? 'bg-yellow-100 border-yellow-200' : 'border-transparent' }} hover:bg-yellow-100 hover:border-yellow-200 rounded-md">
    <a hx-boost="true" href="{{ route('name.mixte.index') }}">Prénoms mixtes</a>
  </li>
</ul>
