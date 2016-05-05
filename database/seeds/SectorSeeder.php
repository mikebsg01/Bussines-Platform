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
    $sectors = config('variables.sector');

    DB::table('sectors')->insert([ 
      'name'          => 'NONE',
      'created_at'    => date('Y-m-d H:i:s'),
      'updated_at'    => date('Y-m-d H:i:s')
    ]);

    foreach( $sectors as $sector => $value ) {
      DB::table('sectors')->insert([ 
        'name'          => $value,
        'created_at'    => date('Y-m-d H:i:s'),
        'updated_at'    => date('Y-m-d H:i:s')
      ]);
    }
  }
}
