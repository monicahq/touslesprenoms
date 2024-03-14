@props(['value' => null, 'optional' => false])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700']) }}>
  {{ $value ?? $slot }}
  @if (!$optional)
    <span class="text-xs text-red-500" title="Champ obligatoire">*</span>
  @else
    <span class="text-xs text-gray-500" title="Champ optionnel">(optionnel)</span>
  @endif
</label>
