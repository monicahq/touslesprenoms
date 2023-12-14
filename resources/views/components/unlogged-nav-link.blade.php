@props(['active' => false])

@php
  $classes = $active ? 'inline-flex items-center px-2 pb-2 rounded-b border-b-4 border-amber-300 text-md font-bold leading-5 text-cyan-950 focus:outline-none focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 dark:focus:border-gray-700 transition duration-250 ease-in-out' : 'inline-flex items-center px-2 text-md font-bold rounded-b border-b-4 border-transparent hover:border-b-4 hover:border-amber-300 leading-5 text-cyan-950 focus:outline-none focus:border-indigo-700 transition duration-250 ease-in-out pb-2';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
  {{ $slot }}
</a>
