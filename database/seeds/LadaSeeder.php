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
    $ladas = config('variables.lada');

    DB::table('ladas')->insert([ 
      'key'           => 'NONE',
      'value'         => '',
      'created_at'    => date('Y-m-d H:i:s'),
      'updated_at'    => date('Y-m-d H:i:s')
    ]);

    foreach( $ladas as $key => $value ) {
      DB::table('ladas')->insert([ 
        'key'           => $key,
        'value'         => $value,
        'created_at'    => date('Y-m-d H:i:s'),
        'updated_at'    => date('Y-m-d H:i:s')
      ]);
    }
  }
}
