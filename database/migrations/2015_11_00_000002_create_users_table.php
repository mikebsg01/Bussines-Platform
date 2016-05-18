<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('users', function (Blueprint $table) {

      /**
       * User - Fields
       * ============================================================= //
       */
      $table->increments('id');
      $table->string('email')->unique();
      $table->string('password', 60);
      $table->string('first_name', 25);
      $table->string('last_name', 25);
      $table->integer('phone_lada_id')->unsigned();
      $table->string('phone_number', 15);
      $table->boolean('agree');
      $table->string('confirmation_code');
      $table->boolean('confirmed')->defaut(0);
      $table->rememberToken();
      $table->timestamps();

      /**
       * User - Foreign Keys
       * ============================================================= //
       */
      $table->foreign('phone_lada_id')
            ->references('id')->on('ladas');
            // ->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
      Schema::drop('users');
  }
}
