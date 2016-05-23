<?php

use Illuminate\Database\Seeder;

class LadaSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $ladas = array_keys(config('variables.ladas'));

    $tmp_date = date('Y-m-d H:i:s');

    DB::table('ladas')->insert([ 
      'key_name'      => 'NONE',
      'created_at'    => $tmp_date,
      'updated_at'    => $tmp_date
    ]);

    foreach( $ladas as $key_name ) {

      $tmp_date = date('Y-m-d H:i:s');

      DB::table('ladas')->insert([ 
        'key_name'      => $key_name,
        'created_at'    => $tmp_date,
        'updated_at'    => $tmp_date
      ]);
    }
  }
}
