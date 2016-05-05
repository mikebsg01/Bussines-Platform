<?php

use Illuminate\Database\Seeder;

class AEMTypesSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $aem_types  = config('variables.aem_type');
    $tmp_date   = date('Y-m-d H:i:s'); 

    DB::table('aem_types')->insert([
      'key'         => 'NONE',
      'value'       => '',
      'created_at'  => $tmp_date,
      'updated_at'  => $tmp_date
    ]); 

    foreach($aem_types as $key => $value) 
    {
      $tmp_date = date('Y-m-d H:i:s'); 

      DB::table('aem_types')->insert([
        'key'         => $key,
        'value'       => $value,
        'created_at'  => $tmp_date,
        'updated_at'  => $tmp_date
      ]); 
    }
  }
}
