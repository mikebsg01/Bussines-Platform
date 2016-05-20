<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAffiliationsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    /**
     * Enterprise - Fields
     * ============================================================= //
     */
    Schema::create('affiliations', function(Blueprint $table) {
      $table->increments('id');
      $table->string('name', 45);
      $table->string('slug')->nullable();
      $table->timestamps();
    });

    Schema::create('enterprise_affiliation', function(Blueprint $table) {
      /**
       * Enterprise/Affiliation - Fields
       * ============================================================= //
       */
      $table->integer('enterprise_id')->unsigned();
      $table->integer('affiliation_id')->unsigned();

      /**
       * Enterprise/Affiliation - Foreign Keys
       * ============================================================= //
       */
      $table->foreign('enterprise_id')
              ->references('id')->on('enterprises')
              ->onDelete('cascade');

      $table->foreign('affiliation_id')
              ->references('id')->on('affiliations')
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
    Schema::drop('enterprise_affiliation');
    Schema::drop('affiliations');
  }
}
