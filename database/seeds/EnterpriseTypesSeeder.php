<?php

use Illuminate\Database\Seeder;

class EnterpriseTypesSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $enterprise_types = config('variables.enterprise_type');

    DB::table('enterprise_types')->insert([
      'key'           => 'NONE',
      'value'         => '',
      'created_at'    => date('Y-m-d H:i:s'),
      'updated_at'    => date('Y-m-d H:i:s') 
    ]);

    foreach( $enterprise_types as $key => $value ) {
      DB::table('enterprise_types')->insert([
        'key'           => $key,
        'value'         => $value,
        'created_at'    => date('Y-m-d H:i:s'),
        'updated_at'    => date('Y-m-d H:i:s') 
      ]);
    }
  }
}
