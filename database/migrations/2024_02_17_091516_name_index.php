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
        Schema::table('names', function (Blueprint $table) {
            $table->index(['gender', 'name', 'unisex']);
            $table->index(['total']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('names', function (Blueprint $table) {
            $table->dropIndex('names_gender_name_index');
        });
    }
};
