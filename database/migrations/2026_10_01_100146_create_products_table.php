<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {

      Schema::create('products', function (Blueprint $table) {
         $table->bigIncrements('id');

         $table->string('title')->nullable();
         $table->string('photo')->nullable();
         $table->longtext('content')->nullable();

         $table->foreignId('department_id')->nullable()->constrained('departments')->cascadeOnDelete();
         $table->foreignId('trade_id')->nullable()->constrained('trade_marks')->cascadeOnDelete();
         $table->foreignId('manu_id')->nullable()->constrained('manufacturers')->cascadeOnDelete();
         $table->foreignId('color_id')->nullable()->constrained('colors')->cascadeOnDelete();
         $table->foreignId('size_id')->nullable()->constrained('sizes')->cascadeOnDelete();
         $table->foreignId('currency_id')->nullable()->constrained('countries')->cascadeOnDelete();
         $table->foreignId('weight_id')->nullable()->constrained('weights')->cascadeOnDelete();




/*
$table->integer('mall_id')->unsigned()->nullable();
$table->foreign('mall_id')->references('id')->on('malls')->onDelete('cascade');
 */

        $table->string('size')->nullable();
        $table->decimal('price', 5, 2)->default(0);
        $table->integer('stock')->default(0);
        $table->date('start_at')->nullable();
        $table->date('end_at')->nullable();
        $table->date('start_offer_at')->nullable();
        $table->date('end_offer_at')->nullable();
        $table->decimal('price_offer', 5, 2)->default(0);
        $table->longtext('other_data')->nullable();
        $table->string('weight')->nullable();
        $table->enum('status', ['pending', 'refused', 'active'])->default('pending');
        $table->longtext('reason')->nullable();
        $table->timestamps();
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down()
   {
      Schema::dropIfExists('products');
   }
}
