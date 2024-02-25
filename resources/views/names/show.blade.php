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
          "name": "touslesprenoms.org"
        },
        "publisher": {
          "@type": "Organization",
          "name": "touslesprenoms.org",
          "logo": {
            "@type": "ImageObject",
            "url": "{{ $jsonLdSchema['image'] }}"
          }
        },
        "headline": "{{ $jsonLdSchema['headline'] }}",
        "image": {{ $jsonLdSchema['image'] }},
        "datePublished": "{{ $jsonLdSchema['created_at'] }}",
        "dateModified": "{{ $jsonLdSchema['updated_at'] }}",
      }
  </script>
  </x-slot>

  <div class="bg-violet-100 mb-8">
    <div class="border-b border-violet-200">
      @include('layouts.unlogged-navigation')
    </div>

    <div class="border-b border-violet-200">
      <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8 py-2">
        <ul class="text-xs">
          <li class="inline after:content-['>'] after:text-gray-500 after:text-xs">
            <a hx-boost="true" href="{{ route('home.index') }}" class="text-violet-900 underline">Accueil</a>
          </li>
          <li class="inline after:content-['>'] after:text-gray-500 after:text-xs">
            <a hx-boost="true" href="{{ route('name.index') }}" class="text-violet-900 underline">Tous les prénoms</a>
          </li>
          <li class="inline">Tous les détails du prénom {{ $name['name'] }}</li>
        </ul>
      </div>
    </div>
  </div>

  <div>
    <div class="mx-auto max-w-5xl sm:px-6 px-2 lg:px-8 py-2">
      <div class="grid name-show-grid sm:gap-5">

        <!-- left -->
        <div>
          <!-- nom + avatar -->
          <div class="flex items-center mb-5">
            <div class="rounded-full w-14 mr-4 ring-4 ring-violet-100">{!! \App\Helpers\NameHelper::getAvatar($name['name']) !!}</div>

            <h1 class="text-xl font-bold">{{ $name['name'] }}</h1>
          </div>

          <!-- sommaire -->
          <div class="mb-6 p-2 border border-gray-200 rounded-lg">
            <ul class="grid grid-cols-2 text-sm">
              <li>
                <a href="#origine" class="underline hover:no-underline">Origine</a>
              </li>
              <li>
                <a href="#personnalite" class="underline hover:no-underline">Personnalité</a>
              </li>
              <li>
                <a href="#celebrites" class="underline hover:no-underline">Célébrités portant ce prénom</a>
              </li>
              <li>
                <a href="#references" class="underline hover:no-underline">Références artistiques</a>
              </li>
              <li>
                <a href="#similaires" class="underline hover:no-underline">Prénoms similaires</a>
              </li>
              <li>
                <a href="#elfiques" class="underline hover:no-underline">Traits elfiques</a>
              </li>
            </ul>
          </div>

          <!-- syllabes -->
          <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mb-10">
            <div class="bg-violet-100 rounded-lg p-2">
              <h3 class="text-xs text-gray-700">Nombre de syllabes</h3>
              <div class="text-xl">{!! $name['syllabes'] !!}</div>
            </div>

            <div class="bg-violet-100 rounded-lg p-2">
              <h3 class="text-xs text-gray-700">Numérologie</h3>
              <div class="text-xl">{{ $numerology }}</div>
            </div>

            <div class="bg-violet-100 rounded-lg p-2">
              <h3 class="text-xs text-gray-700">Genre</h3>
              <div class="text-xl">{!! $name['gender'] !!}</div>
            </div>

            <div class="bg-violet-100 rounded-lg p-2">
              <h3 class="text-xs text-gray-700">Mixte</h3>
              <div class="text-xl">{!! $name['mixte'] !!}</div>
            </div>
          </div>

          <!-- user note, if it exists -->
          <div class="mb-10 p-4 border rounded-lg border-gray-200 bg-gray-100">
            <x-note-show :note="$note" :url="$url['edit']" :delete-url="$url['delete']" />
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
            <h2 class="mb-2 flex items-center" id="personnalite">
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
          <div class="mb-8 border-b pb-6">
            <h2 class="mb-2 flex items-center" id="elfiques">
              <span class="bg-amber-300 p-1 mr-2 rounded-full">
                <x-heroicon-o-chevron-right class="w-4 h-4 text-white" />
              </span>
              <span class="font-semibold text-lg">Traits elfiques du prénom {{ $name['name'] }}</span>
            </h2>
            <div class="prose">{!! $name['elfic_traits'] !!}</div>
          </div>

          <!-- last updated -->
          <div class="mb-8">
            <p class="text-sm">Cet article a été mis à jour le {{ $name['updated_at'] }}.</p>
          </div>
        </div>

        <!-- right -->
        <div>

          <!-- favorites -->
          <x-favorite :name="$name" favorited="{{ $favorites->contains($name['id']) }}" />

          <!-- list -->
          @if (count($lists) !== 0)
          <div class="mb-10">
            <p class="mb-2 text-sm">Vous pouvez aussi l'ajouter à une ou plusieurs listes en cliquant sur le petit plus :</p>
            <div class="border border-gray-200 rounded-lg">
              @forelse ($lists['lists'] as $list)
                <!-- loop -->
                @include('names.partials.lists')
              @empty
                <p class="p-2">Vous n'avez pas encore de liste.</p>
              @endforelse
            </div>
          </div>
          @else
          <div class="border rounded-lg p-2 mb-8 text-sm">
            <p>Connectez-vous pour ajouter ce prénom à une liste, la partager et permettre à vos proches de voter.</p>
          </div>
          @endif

          <div class="mb-8">
            <h2 class="font-semibold text-lg mb-4">Popularités par décennies</h2>
            <!-- popularity -->
            <table class="charts-css bar show-labels show-4-secondary-axes">
              <tbody>
                @foreach ($popularity['decades'] as $popularityItem)
                  <tr>
                    <th scope="row">
                      <span class="data text-xs mr-2">{{ $popularityItem['decade'] }}</span>
                    </th>
                    <td style="--size: calc( {{ $popularityItem['percentage'] }} / 100 )">
                      <span class="tooltip text-xs font-normal">{{ $popularityItem['popularity'] }}</span>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            <p class="mt-4 text-xs text-center">Utilisé {{ $popularity['total'] }} fois depuis 1900.</p>
          </div>

          <!-- random names -->
          <div>
            <h2 class="font-semibold text-lg mb-4">D'autres idées de prénoms</h2>
            <ul class="space-y-1">
              @foreach ($relatedNames as $name)
              <li>
                <x-name-items :name="$name" favorited="{{ $favorites->contains($name['id']) }}" />
              </li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-guest-layout>
