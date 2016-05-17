<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommercialTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('commercial', function (Blueprint $table) {
      $table->increments('id');

      $table->integer('enterprise_id')->unsigned();
      $table->foreign('enterprise_id')
              ->references('id')->on('enterprises')
              ->onDelete('cascade');

      $table->integer('enterprise_type_id')->unsigned();
      $table->foreign('enterprise_type_id')
              ->references('id')->on('enterprise_types');

      $table->date('year_established');
      $table->string('num_employees', 15);
      $table->double('incomes_year_current', 15, 4)->default(0);
      $table->text('products_and_services');
      $table->text('affiliations');
      $table->text('certifications');

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
    Schema::drop('commercial');
  }
}
