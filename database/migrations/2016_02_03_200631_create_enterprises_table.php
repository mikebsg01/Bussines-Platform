<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnterprisesTable extends Migration
{

  public function up()
  {
    Schema::create('enterprises', function (Blueprint $table) {
      $table->increments('id');

      $table->integer('user_id')->unsigned();
      $table->foreign('user_id')
              ->references('id')->on('users')
              ->onDelete('cascade');

      $table->integer('sector_id')->unsigned()->nullable()->default(1);
      $table->foreign('sector_id')
              ->references('id')->on('sectors')
              ->onDelete('cascade');

      $table->string('name', 60)->unique();
      $table->text('description');
      $table->text('fiscal_name');

      $table->integer('country_id')->unsigned();
      $table->foreign('country_id')
              ->references('id')->on('countries');
              // ->onDelete('cascade');

      $table->string('state', 15);
      $table->string('city', 15);

      $table->integer('aem_type_id')->unsigned();
      $table->foreign('aem_type_id')
              ->references('id')->on('aem_types');
              // ->onDelete('cascade');

      $table->text('address');
      $table->string('codepostal', 10);

      $table->integer('phone_lada_id')->unsigned();
      $table->foreign('phone_lada_id')
              ->references('id')->on('ladas');
              // ->onDelete('cascade');

      $table->string('phone_number',  15);
      $table->string('email');
      $table->string('work_position', 25);
      $table->string('url_website');
      $table->string('url_logo')->nullable();
      $table->string('url_video')->nullable();
      $table->enum('registered_as', array_keys(config('variables.register_as')))->default('both');
      $table->text('schedule');
      $table->integer('enterprise_status_id')->unsigned();
      $table->foreign('enterprise_status_id')
              ->references('id')->on('enterprises_status');

      $table->timestamps();
    });
  }

  public function down()
  {
    Schema::drop('enterprises');
  }
}
