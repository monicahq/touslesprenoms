@props(['boost' => true])

<a {{ $attributes->merge(['class' => 'text-blue-700 underline hover:no-underline dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800']) }}>{{ $slot }}</a>
