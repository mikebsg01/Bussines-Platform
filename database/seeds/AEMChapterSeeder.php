<?php

use Illuminate\Database\Seeder;

class AEMChapterSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $aem_chapter  = array_keys(config('variables.aem_chapter'));
    $tmp_date     = date('Y-m-d H:i:s'); 

    DB::table('aem_chapter')->insert([
      'key_name'         => 'NONE',
      'created_at'  => $tmp_date,
      'updated_at'  => $tmp_date
    ]); 

    foreach($aem_chapter as $key_name) 
    {
      $tmp_date = date('Y-m-d H:i:s'); 

      DB::table('aem_chapter')->insert([
        'key_name'    => $key_name,
        'created_at'  => $tmp_date,
        'updated_at'  => $tmp_date
      ]); 
    }
  }
}
