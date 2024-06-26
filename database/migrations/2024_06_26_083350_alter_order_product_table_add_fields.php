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
        Schema::table('order_product', function (Blueprint $table) {
          $table->string('title')->after('product_variation_id');
          $table->text('description')->nullable()->after('title');
          $table->string('image')->nullable()->after('description');
          $table->decimal('total_shipping', 10, 2)->default(0)->after('total');
          $table->decimal('grand_total', 10, 2)->default(0)->after('total_shipping');
          $table->boolean('is_variation')->default(0)->after('grand_total');
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
