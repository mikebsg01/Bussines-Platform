<?php

use Illuminate\Database\Seeder;

class EnterprisesTypesSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $enterprise_types = array_keys(config('variables.enterprise_types'));

    $tmp_date = date('Y-m-d H:i:s');

    DB::table('enterprises_types')->insert([
      'key_name'      => 'NONE',
      'created_at'    => $tmp_date,
      'updated_at'    => $tmp_date 
    ]);

    foreach ($enterprise_types as $key_name) {
      DB::table('enterprises_types')->insert([
        'key_name'    => $key_name,
        'created_at'  => $tmp_date,
        'updated_at'  => $tmp_date 
      ]);
    }
  }
}
