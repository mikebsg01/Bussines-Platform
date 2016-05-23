<?php

use Illuminate\Database\Seeder;

class SectorSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $sectors = array_keys(config('variables.sectors'));

    $tmp_date = date('Y-m-d H:i:s');

    DB::table('sectors')->insert([ 
      'key_name'    => 'NONE',
      'created_at'  => $tmp_date,
      'updated_at'  => $tmp_date
    ]);

    foreach ($sectors as $key_name) {

      $tmp_date = date('Y-m-d H:i:s');

      DB::table('sectors')->insert([ 
        'key_name'    => $key_name,
        'created_at'  => $tmp_date,
        'updated_at'  => $tmp_date
      ]);
    }
  }
}
