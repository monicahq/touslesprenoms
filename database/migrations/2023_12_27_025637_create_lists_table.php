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
        Schema::create('lists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->boolean('is_public')->default(true);
            $table->boolean('can_be_modified')->default(true);
            $table->boolean('is_list_of_favorites')->default(false);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('list_name', function (Blueprint $table) {
            $table->unsignedBigInteger('name_list_id');
            $table->unsignedBigInteger('name_id');
            $table->foreign('name_list_id')->references('id')->on('name_lists')->onDelete('cascade');
            $table->foreign('name_id')->references('id')->on('names')->onDelete('cascade');
        });
    }
};
