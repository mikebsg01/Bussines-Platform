<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('products', function(Blueprint $table) {
      $table->increments('id');
      $table->string('name', 25);
      $table->string('slug')->nullable();
      $table->timestamps();
    });

    Schema::create('enterprise_product', function(Blueprint $table) {
      /**
       * Enterprise/Product - Fields
       * ============================================================= //
       */
      $table->integer('enterprise_id')->unsigned();
      $table->integer('product_id')->unsigned();
      $table->timestamps();

      /**
       * Enterprise/Product - Foreign Keys
       * ============================================================= //
       */
      $table->foreign('enterprise_id')
              ->references('id')->on('enterprises')
              ->onDelete('cascade');

      $table->foreign('product_id')
              ->references('id')->on('products')
              ->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::drop('enterprise_product');
    Schema::drop('products'); 
  }
}
