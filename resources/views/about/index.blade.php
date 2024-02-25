<x-guest-layout>
  <div class="bg-violet-100">
    <div class="border-b border-violet-200">
      @include('layouts.unlogged-navigation')
    </div>
  </div>

  <div class="py-20 mx-auto max-w-5xl px-2 sm:px-6 lg:px-8">
    <h1 class="text-3xl mb-2 mx-auto text-center">Un prénom se choisit pour la vie.</h1>
    <h2 class="text-gray-400 text-center">Nous sommes là pour vous aider.</h2>
  </div>

  <div class="bg-yellow-100">
    <div class="py-20 mx-auto max-w-5xl px-2 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-20">
        <div>
          <h2 class="text-2xl mb-10">Nous créeons la plus grande base de données de prénoms francophones.</h2>

          <img src="/img/mockup.png" srcset="/img/mockup.png, /img/mockup-2x.png 2x" loading="lazy" alt="image du produit pour le prénom jean">
        </div>
        <div>
          <p class="mb-3 prose">Touslesprenoms.org est une plateforme qui aide les futurs parents à choisir un prénom pour leur progéniture. Nous avons recueilli plus de 39 000 prénoms de l'Institut National de la Statistique et des Études Économiques (INSEE) et avons rassemblé de nombreuses informations pour permettre aux parents de prendre une décision éclairée.</p>

          <p class="mb-3 prose">Nous avons pour ambition de devenir le site de prénoms francophones le plus populaire. Nous sommes fiers de nous distinguer par notre absence de publicité et la grande qualité de contenu que nous mettons à disposition des utilisateurs. Nous sommes également le seul acteur francophone à rendre notre code disponible sur Github avec une license libre de droit. La communauté peut ainsi nous aider à rendre le site meilleur et bâtir une plateforme utile à tous dans l'intérêt commun.</p>

          <p class="mb-3 prose">Pourquoi un autre site de prénoms ? Nous en avions ras le bol de tous ces sites remplis de publicité, lents, sans fonctionnalités réellement utiles pour faire son choix. En tant que geeks, nous avons décidé de changer le <italic>game</italic>.</p>
        </div>
      </div>
    </div>
  </div>

  <div class="py-20 mx-auto max-w-5xl px-2 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-20">
      <div>
        <h2 class="text-2xl mb-8">Nous sommes des artisans qui nous soucions profondément de la qualité de notre travail.</h2>

        <p class="mb-3 prose">Avant de créer touslesprenoms.org, nous avons crée <a href="https://monicahq.com" class="underline">Monica</a>, un autre produit open source, qui permet de documenter votre vie et celle de vos proches. Ce produit est utilisé par des dizaines de milliers de personnes, et est extrêmement populaire dans la <a href="https://github.com/monicahq/monica" class="underline">communauté open source</a>.</p>

        <p class="mb-3 prose">Notre toute petite équipe s'étend sur deux continents (France et Canada) et nous travaillons en remote depuis le début sur nos projets. Ce qui nous unit est notre focus sans faille, notre capacité à exécuter très rapidement, et notre passion du travail bien fait.</p>
      </div>

      <div class="mt-10">
        <div class="text-center mb-10">
          <img src="/img/founders.png" srcset="/img/founders.png, /img/founders-2x.png 2x" loading="lazy" alt="image des deux fondateurs" data-nosnippet>
        </div>

        <div class="text-center text-sm text-gray-600">
          Les fondateurs, Régis et Alexis.
        </div>
      </div>
    <div>
  </div>
</x-guest-layout>
