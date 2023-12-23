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
        Schema::create('characteristics', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('characteristic_name', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('characteristic_id');
            $table->unsignedBigInteger('name_id');
            $table->timestamps();
            $table->foreign('characteristic_id')->references('id')->on('characteristics')->onDelete('cascade');
            $table->foreign('name_id')->references('id')->on('names')->onDelete('cascade');
        });
    }
};
