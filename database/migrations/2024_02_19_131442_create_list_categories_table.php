<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('list_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->boolean('is_serious')->default(true);
            $table->timestamps();
        });

        Schema::table('lists', function (Blueprint $table) {
            $table->unsignedBigInteger('list_category_id')->after('user_id')->nullable();
            $table->foreign('list_category_id')->references('id')->on('list_categories')->onDelete('cascade');
        });

        DB::table('list_categories')->insert([
            'name' => 'Prénoms d\'origine religieuse',
            'description' => 'En quête d\'un prénom empreint de spiritualité et d\'histoire ? Laissez-vous guider par notre sélection de prénoms d\'origine religieuse ! Des prénoms bibliques aux noms inspirés des grandes figures spirituelles, découvrez une source d\'inspiration infinie pour trouver le prénom parfait pour votre petit trésor.',
            'is_serious' => true,
        ]);
        DB::table('list_categories')->insert([
            'name' => 'Prénoms d\'origine géographique',
            'description' => 'Partez à l\'aventure avec notre sélection de prénoms d\'origine géographique ! Des noms évoquant des paysages grandioses aux prénoms inspirés des plus belles villes du monde, découvrez une source d\'inspiration inédite pour trouver le prénom parfait pour votre petit explorateur.',
            'is_serious' => true,
        ]);
        DB::table('list_categories')->insert([
            'name' => 'Prénoms d\'origine historique',
            'description' => 'Donnez à votre enfant un prénom qui traverse les siècles avec notre sélection de prénoms d\'origine historique ! Des figures légendaires aux personnages illustres, découvrez une source d\'inspiration unique pour trouver le prénom parfait pour votre petit prince ou votre petite princesse.',
            'is_serious' => true,
        ]);
        DB::table('list_categories')->insert([
            'name' => 'Prénoms inspirés de la nature',
            'description' => 'Célébrez la beauté et la puissance de la nature en choisissant un prénom inspiré de ses éléments pour votre enfant ! Des fleurs délicates aux arbres majestueux, en passant par les animaux fascinants et les forces élémentaires, découvrez une source d\'inspiration infinie pour trouver le prénom parfait pour votre petit être.',
            'is_serious' => true,
        ]);
        DB::table('list_categories')->insert([
            'name' => 'Prénoms inspirés de la littérature et du cinéma',
            'description' => 'Donnez vie à vos personnages préférés en choisissant un prénom inspiré de la littérature et du cinéma pour votre enfant ! Des héros inoubliables aux héroïnes courageuses, en passant par les créatures fantastiques et les personnages attachants, découvrez une source d\'inspiration inédite pour trouver le prénom parfait pour votre petit bout de chou.',
            'is_serious' => true,
        ]);

        DB::table('list_categories')->insert([
            'name' => 'Prénoms inventés',
            'description' => 'Laissez libre cours à votre imagination et explorez le monde infini des prénoms inventés pour trouver le nom parfait pour votre enfant ! Des jeux vidéo aux univers fictifs, en passant par les gourmandises et les jeux de mots, découvrez une source d\'inspiration inédite pour créer un prénom unique et original qui correspond à votre personnalité et à vos rêves.',
            'is_serious' => false,
        ]);
        DB::table('list_categories')->insert([
            'name' => 'Prénoms à double sens',
            'description' => 'Ajoutez une touche d\'originalité et de mystère au prénom de votre enfant en choisissant un nom à double sens ! Des prénoms qui changent de genre aux noms qui cachent des messages cachés, découvrez une source d\'inspiration inédite pour trouver le prénom parfait pour votre petit être.',
            'is_serious' => false,
        ]);
        DB::table('list_categories')->insert([
            'name' => 'Prénoms de célébrités',
            'description' => 'Donnez à votre enfant le prénom d\'une célébrité que vous admirez pour lui transmettre votre passion et lui inspirer des valeurs de réussite, de talent et de persévérance ! Des acteurs légendaires aux chanteurs talentueux, en passant par les sportifs de haut niveau, découvrez une source d\'inspiration infinie pour trouver le prénom parfait pour votre petit bout de chou.',
            'is_serious' => false,
        ]);
    }
};
