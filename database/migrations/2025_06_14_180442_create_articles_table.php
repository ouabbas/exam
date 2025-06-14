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
        Schema::create('articles', function (Blueprint $table) {
            $table->id(); // ID auto-incrémenté
            $table->string('session_id')->nullable(); // Pour sessions anonymes
            $table->string('title'); // Titre de l'article
            $table->text('img'); // Image encodée ou chemin d'image
            $table->text('description'); // Description de l'article
            $table->timestamps(); // created_at & updated_at automatiques
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
