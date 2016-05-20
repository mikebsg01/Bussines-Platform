<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCertificationsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('certifications', function(Blueprint $table) {
      $table->increments('id');
      $table->string('name', 45);
      $table->string('slug')->nullable();
      $table->timestamps();
    });

    Schema::create('enterprise_certification', function(Blueprint $table) {
      /**
       * Enterprise/Certification - Fields
       * ============================================================= //
       */
      $table->integer('enterprise_id')->unsigned();
      $table->integer('certification_id')->unsigned();

      /**
       * Enterprise/Certification - Foreign Keys
       * ============================================================= //
       */
      $table->foreign('enterprise_id')
              ->references('id')->on('enterprises')
              ->onDelete('cascade');

      $table->foreign('certification_id')
              ->references('id')->on('certifications')
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
    Schema::drop('enterprise_certification'); 
    Schema::drop('certifications'); 
  }
}
