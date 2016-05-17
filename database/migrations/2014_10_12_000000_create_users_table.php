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
      $table->increments('id');
      $table->string(   'email')->unique();
      $table->string(   'password',       60);
      $table->string(   'name',           25);
      $table->string(   'lastname',       25);

      $table->integer('phone_lada_id')->unsigned();
      $table->foreign('phone_lada_id')
            ->references('id')->on('ladas');
            // ->onDelete('cascade');
      
      $table->string(   'phone_number',   15);
      $table->boolean(  'agree');

      $table->boolean('confirmed')->defaut(0);
      $table->string('confirmation_code');

      $table->rememberToken();
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
      Schema::drop('users');
  }
}
