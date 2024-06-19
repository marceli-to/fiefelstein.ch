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
      Schema::table('products', function (Blueprint $table) {
        $table->text('description')->nullable()->after('title');
        $table->decimal('price', 10, 2)->nullable()->after('description');
        $table->integer('stock')->nullable()->after('price');
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
