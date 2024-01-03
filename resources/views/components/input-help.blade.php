@props(['value'])

<label {{ $attributes->merge(['class' => 'text-xs text-gray-500 dark:text-gray-300']) }}>
  {{ $value ?? $slot }}
</label>
