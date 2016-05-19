<?php

use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $countries = array_keys(config('variables.countries'));

    $tmp_date = date('Y-m-d H:i:s');

    DB::table('countries')->insert([
      'key_name'    => 'NONE',
      'created_at'  => $tmp_date,
      'updated_at'  => $tmp_date
    ]);

    foreach ($countries as $key_name) {

      $tmp_date = date('Y-m-d H:i:s');

      DB::table('countries')->insert([
        'key_name'    => $key_name,
        'created_at'  => $tmp_date,
        'updated_at'  => $tmp_date
      ]);
    }
  }
}
