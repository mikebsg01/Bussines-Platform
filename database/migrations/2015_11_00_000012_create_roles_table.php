<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    /**
       * Role - Fields
       * ============================================================= //
       */
    Schema::create('roles', function(Blueprint $table) {
      $table->increments('id');
      $table->string('key_name', 45);
    });

    Schema::create('enterprise_role', function(Blueprint $table) {
      /**
       * Enterprise/Role - Fields
       * ============================================================= //
       */
      $table->integer('enterprise_id')->unsigned();
      $table->integer('role_id')->unsigned();

      /**
       * Enterprise/Role - Foreign Keys
       * ============================================================= //
       */      
      $table->foreign('enterprise_id')
              ->references('id')->on('enterprises')
              ->onDelete('cascade');

      $table->foreign('role_id')
              ->references('id')->on('roles')
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
    Schema::drop('enterprise_role');
    Schema::drop('roles');
  }
}
