<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('names', function (Blueprint $table) {
            $table->id();
            $table->string('gender');
            $table->string('name');
            $table->text('origins')->nullable();
            $table->text('personality')->nullable();
            $table->text('country_of_origin')->nullable();
            $table->text('celebrities')->nullable();
            $table->text('elfic_traits')->nullable();
            $table->text('name_day')->nullable();
            $table->text('litterature_artistics_references')->nullable();
            $table->text('similar_names_in_other_languages')->nullable();
            $table->text('klingon_translation')->nullable();
            $table->boolean('unisex')->default(false);
            $table->integer('total')->default(0);
            $table->integer('page_views')->default(0);
            $table->timestamps();
            $table->index(['name']);
        });

        Schema::create('name_statistics', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('name_id');
            $table->integer('year')->default(0);
            $table->integer('count')->default(0);
            $table->timestamps();
            $table->foreign('name_id')->references('id')->on('names')->onDelete('cascade');
        });
    }
};
