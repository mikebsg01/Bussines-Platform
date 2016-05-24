<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnterprisesTable extends Migration
{

  public function up()
  {
    Schema::create('enterprises', function (Blueprint $table) {

      /**
       * Enterprise - Fields
       * ============================================================= //
       */
      $table->increments('id');
      $table->integer('user_id')->unsigned();
      $table->integer('sector_id')->unsigned()->nullable()->default(1);
      $table->integer('enterprise_type_id')->unsigned();
      $table->integer('enterprise_status_id')->unsigned();
      $table->integer('country_id')->unsigned();
      $table->integer('aem_chapter_id')->unsigned();
      $table->string('name', 60)->unique();
      $table->string('slug')->nullable();
      $table->text('fiscal_name');
      $table->text('description');
      $table->string('state', 25);
      $table->string('city', 25);
      $table->text('address');
      $table->string('codepostal', 10);
      $table->integer('phone_lada_id')->unsigned();
      $table->string('phone_number', 15);
      $table->string('email');
      $table->integer('enterprise_num_employees_id')->unsigned();
      $table->date('year_established');
      $table->text('schedule');
      $table->string('url_website')->nullable();
      $table->string('url_logo')->nullable();

      /**
       * Enterprise - Extra Fields
       * ============================================================= //
       */
      $table->string('url_fb')->nullable();
      $table->string('url_tw')->nullable();
      $table->string('url_in')->nullable();

      $table->string('url_video')->nullable();
      $table->double('incomes_year_current', 15, 4)->default(0);

      /**
       * Enterprise - Foreign Keys 
       * ============================================================= //
       */
      $table->foreign('user_id')
              ->references('id')->on('users')
              ->onDelete('cascade');

      $table->foreign('sector_id')
              ->references('id')->on('sectors')
              ->onDelete('cascade');

      $table->foreign('enterprise_type_id')
              ->references('id')->on('enterprises_types');
              // ->onDelete('cascade');

      $table->foreign('enterprise_status_id')
              ->references('id')->on('enterprises_status');
              // ->onDelete('cascade');
      
      $table->foreign('country_id')
              ->references('id')->on('countries');
              // ->onDelete('cascade');

      $table->foreign('aem_chapter_id')
              ->references('id')->on('aem_chapters');
              // ->onDelete('cascade');

      $table->foreign('phone_lada_id')
              ->references('id')->on('ladas');
              // ->onDelete('cascade');

      $table->foreign('enterprise_num_employees_id')
              ->references('id')->on('enterprises_num_employees');
              // ->onDelete('cascade');

      $table->timestamps();
    });
  }

  public function down()
  {
    Schema::drop('enterprises');
  }
}
