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
    Schema::create('product_variations', function (Blueprint $table) {
      $table->id();
      $table->string('title');
      $table->text('description')->nullable();
      $table->decimal('price', 10, 2)->nullable();
      $table->integer('stock');
      $table->json('attributes')->nullable();
      $table->json('cards')->nullable();
      $table->string('image');
      $table->tinyInteger('publish')->default(0);
      $table->foreignId('product_id')->constrained()->onDelete('cascade');
      $table->foreignId('user_id')->nullable()->constrained();
      $table->softDeletes();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('product_variations');
  }
};
