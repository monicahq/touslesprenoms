@props(['form'])

<template x-if="form.invalid('{{ $form }}')">
  <ul {{ $attributes->merge(['class' => 'text-sm text-red-600 dark:text-red-400 space-y-1']) }}>
    <li x-text="form.errors.{{ $form }}"></li>
  </ul>
</template>
