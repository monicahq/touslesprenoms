@props(['placeholder' => '', 'height' => 'h-auto min-h-[80px]'])

<div class="w-full">
  <textarea type="text"
            x-data="{
                resize() {
                    $el.style.height = '0px';
                    $el.style.height = $el.scrollHeight + 'px'
                }
            }"
            x-init="resize()"
            @input="resize()"
            placeholder="{{ $placeholder }}"
            {!! $attributes->merge([
                'class' =>
                    'h-auto px-3 py-2 border-gray-300 focus:border-indigo-500 placeholder:text-neutral-400 focus:ring-1 rounded-md shadow-sm ' . $height,
            ]) !!}>{{ $slot }}</textarea>
</div>
