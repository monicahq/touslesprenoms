<x-guest-layout>
  <x-slot:jsonLdSchema>
    <script type="application/ld+json">
      {
        "@context": "http://schema.org/",
        "@type": "Article",
        "mainEntityOfPage": {
          "@type": "WebPage",
          "@id": "{{ $jsonLdSchema['url'] }}"
        },
        "author": {
          "@type": "Organization",
          "name": "choisisunprenom.com"
        },
        "publisher": {
          "@type": "Organization",
          "name": "choisisunprenom.com",
          "logo": {
            "@type": "ImageObject",
            "url": "{{ $jsonLdSchema['image'] }}}"
          }
        },
        "headline": "{{ $jsonLdSchema['headline'] }}",
        "image": {{ $jsonLdSchema['image'] }},
        "datePublished": "{{ $jsonLdSchema['date'] }}",
        "dateModified": "{{ $jsonLdSchema['date'] }}",
      }
  </script>
  </x-slot>

  <div class="bg-violet-100 mb-8">
    <div class="border-b border-violet-200">
      @include('layouts.unlogged-navigation')
    </div>

    <div class="border-b border-violet-200">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 py-2">
        <ul class="text-xs">
          <li class="inline after:content-['>'] after:text-gray-500 after:text-xs">
            <a href="{{ route('home.index') }}" class="text-violet-900 underline">Accueil</a>
          </li>
          <li class="inline after:content-['>'] after:text-gray-500 after:text-xs">
            <a href="{{ route('name.index') }}" class="text-violet-900 underline">Tous les prénoms</a>
          </li>
          <li class="inline">Tous les détails du prénom {{ $name['name'] }}</li>
        </ul>
      </div>
    </div>
  </div>

  <div>
    <div class="mx-auto max-w-5xl sm:px-6 lg:px-8 py-2">
      <div class="grid name-show-grid">

        <!-- left -->
        <div>
          <!-- nom + avatar -->
          <div class="flex items-center mb-5">
            <div class="rounded-full w-14 mr-4 ring-4 ring-violet-100">{!! $name['avatar'] !!}</div>

            <h1 class="text-xl font-bold">{{ $name['name'] }}</h1>
          </div>

          <!-- sommaire -->
          <div class="mb-6">
            <ul class="grid grid-cols-2">
              <li>
                <a href="#origine" class="underline">Origine</a>
              </li>
              <li>
                <a href="#personnalite" class="underline">Personnalité</a>
              </li>
              <li>
                <a href="#celebrites" class="underline">Célébrités portant ce prénom</a>
              </li>
              <li>
                <a href="#references" class="underline">Références artistiques</a>
              </li>
              <li>
                <a href="#similaires" class="underline">Prénoms similaires</a>
              </li>
              <li>
                <a href="#elfiques" class="underline">Traits elfiques</a>
              </li>
            </ul>
          </div>

          <!-- country of origin -->
          <div class="grid grid-cols-3 gap-3 mb-5">
            <div class="bg-white rounded-lg p-2">
              <h3 class="text-xs">Pays d'origine</h3>
              <div>{!! $name['country_of_origin'] !!}</div>
            </div>

            <div class="bg-white rounded-lg p-2">
              <h3 class="text-xs">Numérologie</h3>
              <div>{!! $name['country_of_origin'] !!}</div>
            </div>

            <div class="bg-white rounded-lg p-2">
              <h3 class="text-xs"></h3>
              <div>{!! $name['country_of_origin'] !!}</div>
            </div>
          </div>

          <!-- origin -->
          <div class="mb-8">
            <h2 class="mb-2 flex items-center" id="origine">
              <span class="bg-amber-300 p-1 mr-2 rounded-full">
                <x-heroicon-o-chevron-right class="w-4 h-4 text-white" />
              </span>
              <span class="font-semibold text-lg">Origine du prénom {{ $name['name'] }}</span>
            </h2>
            <div class="prose">{!! $name['origins'] !!}</div>
          </div>

          <!-- personnality -->
          <div class="mb-8">
            <h2 class="mb-2 flex items-center" id="personalite">
              <span class="bg-amber-300 p-1 mr-2 rounded-full">
                <x-heroicon-o-chevron-right class="w-4 h-4 text-white" />
              </span>
              <span class="font-semibold text-lg">Personnalité du prénom {{ $name['name'] }}</span>
            </h2>
            <div class="prose">{!! $name['personality'] !!}</div>
          </div>

          <!-- celebrities -->
          <div class="mb-8">
            <h2 class="mb-2 flex items-center" id="celebrites">
              <span class="bg-amber-300 p-1 mr-2 rounded-full">
                <x-heroicon-o-chevron-right class="w-4 h-4 text-white" />
              </span>
              <span class="font-semibold text-lg">Célébrités portant le prénom {{ $name['name'] }}</span>
            </h2>
            <div class="prose">{!! $name['celebrities'] !!}</div>
          </div>

          <!-- references -->
          <div class="mb-8">
            <h2 class="mb-2 flex items-center" id="references">
              <span class="bg-amber-300 p-1 mr-2 rounded-full">
                <x-heroicon-o-chevron-right class="w-4 h-4 text-white" />
              </span>
              <span class="font-semibold text-lg">Références du prénom {{ $name['name'] }}</span>
            </h2>
            <div class="prose">{!! $name['litterature_artistics_references'] !!}</div>
          </div>

          <!-- similar names -->
          <div class="mb-8">
            <h2 class="mb-2 flex items-center" id="similaires">
              <span class="bg-amber-300 p-1 mr-2 rounded-full">
                <x-heroicon-o-chevron-right class="w-4 h-4 text-white" />
              </span>
              <span class="font-semibold text-lg">Prénoms similaires au prénom {{ $name['name'] }}</span>
            </h2>
            <div class="prose">{!! $name['similar_names_in_other_languages'] !!}</div>
          </div>

          <!-- elfic traits -->
          <div class="mb-8">
            <h2 class="mb-2 flex items-center" id="elfiques">
              <span class="bg-amber-300 p-1 mr-2 rounded-full">
                <x-heroicon-o-chevron-right class="w-4 h-4 text-white" />
              </span>
              <span class="font-semibold text-lg">Traits elfiques du prénom {{ $name['name'] }}</span>
            </h2>
            <div class="prose">{!! $name['elfic_traits'] !!}</div>
          </div>
        </div>

        <!-- right -->
        <div>

          <!-- random names -->
          <div>
            <h2 class="font-semibold text-xl mb-4">D'autres idées de prénoms</h2>
            <ul class="space-y-1">
              @foreach ($relatedNames as $name)
                <li class="flex items-center border border-transparent hover:bg-gray-50 hover:border-gray-200 px-2 py-1 rounded-sm">
                  <div class="rounded-full w-6 mr-4 ring-4 ring-violet-100">{!! $name['avatar'] !!}</div>
                  <a href="{{ $name['url'] }}" class="text-lg">{{ $name['name'] }}</a>
                </li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-guest-layout>
