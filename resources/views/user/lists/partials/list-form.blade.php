@props([
  'list' => [],
  'listCategories' => [],
])

<div class="mx-auto max-w-2xl sm:px-6 lg:px-8 py-2">
  <form method="POST" x-data="{
      form: $form('{{ $list ? 'put' : 'post' }}', '{{ Arr::get($list, 'url.update', route('list.store')) }}', {
        listname: '{{ old('listname', Arr::get($list, 'name', '')) }}',
        description: '{{ old('description', Arr::get($list, 'description', '')) }}',
        gender: '{{ old('gender', Arr::get($list, 'gender', 'male')) }}',
        category: '{{ old('category', Arr::get($list, 'list_category_id')) }}',
      }).setErrors({{ Js::from($errors->messages()) }}),
    }" class="mb-8 shadow sm:rounded-lg">
    @csrf
    @if ($list)
      @method('PUT')
    @endif

    <div class="relative border-b dark:border-gray-600 px-6 py-4 bg-yellow-50">
      <h1 class="text-center font-bold">
        @if ($list)
          Éditez la liste de prénoms
        @else
          Créez une liste de prénoms
        @endif
      </h1>
    </div>

    <!-- name -->
    <div class="relative px-6 pt-4 pb-2">
      <x-input-label for="listname"
                    :value="__('Quel est nom de votre liste ?')" />

      <x-text-input class="mt-1 block w-full"
                    id="listname"
                    name="listname"
                    x-model="form.listname"
                    @change="form.forgetError('listname'); form.validate('listname')"
                    type="text"
                    required
                    autofocus />

      <x-input-validation class="mt-2" :form="'listname'" />
    </div>

    <!-- description -->
    <div class="relative px-6 pt-4 pb-2">
      <x-input-label for="description"
                    :optional="true"
                    :value="'Description'" />

      <x-textarea class="mt-1 block w-full"
                id="description"
                name="description"
                x-model="form.description"
                @change="form.forgetError('description'); form.validate('description')"
                type="text"></x-textarea>

      <x-input-validation class="mt-2" :form="'description'" />
    </div>

    <!-- gender -->
    <div class="relative px-6 pt-4 pb-2">
      <p class="block font-medium text-sm text-gray-700 dark:text-gray-300">{{ __('Genre de la liste') }}</p>
      <div class="grid grid-flow-row sm:grid-flow-col sm:grid-cols-3 gap-4 pt-2 pb-4">
        <div class="flex p-3 ps-4 border border-gray-200 rounded dark:border-gray-700" @click="form.gender = 'male'">
          <div class="flex items-center h-5">
            <input id="gender-male" name="gender" x-model="form.gender" type="radio" value="male" @change="form.forgetError('gender'); form.validate('gender')"
              class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
          </div>
          <div class="ms-2 text-sm">
            <label for="gender-male" class="font-medium text-gray-900 dark:text-gray-300">{{ __('Garçons') }}</label>
            <p class="text-xs font-normal text-gray-500 dark:text-gray-300">{{ __('La liste contient des prénoms de garçons.') }}</p>
          </div>
        </div>
        <div class="flex p-3 ps-4 border border-gray-200 rounded dark:border-gray-700" @click="form.gender = 'female'">
          <div class="flex items-center h-5">
            <input id="gender-female" name="gender" x-model="form.gender" type="radio" value="female" @change="form.forgetError('gender'); form.validate('gender')"
              class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
          </div>
          <div class="ms-2 text-sm">
            <label for="gender-female" class="font-medium text-gray-900 dark:text-gray-300">{{ __('Filles') }}</label>
            <p class="text-xs font-normal text-gray-500 dark:text-gray-300">{{ __('La liste contient des prénoms de filles.') }}</p>
          </div>
        </div>
        <div class="flex p-3 ps-4 border border-gray-200 rounded dark:border-gray-700" @click="form.gender = 'unisex'">
          <div class="flex items-center h-5">
            <input id="gender-unisex" name="gender" x-model="form.gender" type="radio" value="unisex" @change="form.forgetError('gender'); form.validate('gender')"
              class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
          </div>
          <div class="ms-2 text-sm">
            <label for="gender-unisex" class="font-medium text-gray-900 dark:text-gray-300">{{ __('Mixtes') }}</label>
            <p class="text-xs font-normal text-gray-500 dark:text-gray-300">{{ __('La liste contient des prénoms mixtes.') }}</p>
          </div>
        </div>
      </div>
      <x-input-validation class="mt-2" :form="'gender'" />
    </div>

    @if (auth()->user()->is_administrator)
    <div class="relative px-6 pt-4 pb-4">
    <label for="category" class="block text-sm font-medium leading-6 text-gray-900">Catégories (pour administrateur seulement)</label>
      <div class="mt-2">
        <select id="category"
                name="category"
                x-model="form.category"
                @change="form.forgetError('category'); form.validate('category')"
                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
          <option value="">(vide)</option>
          @foreach ($listCategories as $category)
            <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
          @endforeach
        </select>
      </div>
      <x-input-validation class="mt-2" :form="'category'" />
    </div>
    @endif

    <!-- actions -->
    <div class="flex items-center justify-between border-t dark:border-gray-600 bg-white dark:bg-gray-800 px-6 py-4">
        <x-link href="{{ $list ? route('list.show', $list['id']) : route('list.index') }}">{{ __('Back') }}</x-link>

        <div>
          <x-primary-button class="w-full text-center" dusk="submit-form-button" disabled="form.processing">
            Sauvegarder
          </x-primary-button>
        </div>
      </div>
    </div>
  </form>
</div>
