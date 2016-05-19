<?php

use Illuminate\Database\Seeder;

class EnterprisesStatusSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $status = array_keys(config('variables.enterprise_status'));
    
    $tmp_date = date('Y-m-d H:i:s');

    DB::table('enterprise_status')->insert([
      'key_name'        => 'NONE',
      'created_at'    => $tmp_date,
      'updated_at'    => $tmp_date 
    ]);

    foreach ($status as $key_name) 
    {
      $tmp_date = date('Y-m-d H:i:s');

      DB::table('enterprise_status')->insert([
        'key_name'    => $key_name,
        'created_at'  => $tmp_date,
        'updated_at'  => $tmp_date 
      ]);
    }
  }
}
