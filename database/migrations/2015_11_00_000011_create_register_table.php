<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Register;

class CreateRegisterTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('registers', function (Blueprint $table) {
      $table->increments('id');
      
      $table->integer('user_id')->unsigned();
      $table->foreign('user_id')
              ->references('id')->on('users')
              ->onDelete('cascade');

      foreach (Register::getSteps() as $step)
      {
        $table->boolean($step);
      }

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
    Schema::drop('registers');
  }
}
