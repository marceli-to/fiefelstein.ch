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
      Schema::create('idea_page', function (Blueprint $table) {
        $table->id();
        $table->text('quote_text');
        $table->string('quote_author');
        $table->text('text');
        $table->json('partner')->nullable();
        $table->timestamps();
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
      Schema::dropIfExists('idea_pages');
    }
};
