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
        if (!Schema::hasTable('books')) {
            Schema::create('books', function (Blueprint $table) {
                $table->id();
                $table->string('title', 200);
                $table->year('publication_year');
                $table->string('genre', 100);
                $table->unsignedBigInteger('total_copies');
                $table->unsignedBigInteger('available_copies');
                $table->unsignedBigInteger('author_id');
                $table->timestamps();

                $table->foreign('author_id')->references('id')->on('authors')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
