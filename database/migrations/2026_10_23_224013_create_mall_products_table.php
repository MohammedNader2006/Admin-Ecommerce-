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
        Schema::create('mall_products', function (Blueprint $table) {
            $table->bigIncrements('id');
           $table->foreignId('product_id')->nullable()->constrained('products')->cascadeOnDelete();
           $table->foreignId('mall_id')->nullable()->constrained('malls')->cascadeOnDelete();
				$table->string('data_key')->nullable();
				$table->string('data_value')->nullable();
				$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mall_products');
    }
};
