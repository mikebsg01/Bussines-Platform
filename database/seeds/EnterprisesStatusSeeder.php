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
    $status = config('variables.enterprise_status');
    
    $tmp_date = date('Y-m-d H:i:s');

    DB::table('enterprises_status')->insert([
      'status'        => 'NONE',
      'created_at'    => $tmp_date,
      'updated_at'    => $tmp_date 
    ]);

    foreach ($status as $s) 
    {
      $tmp_date = date('Y-m-d H:i:s');

      DB::table('enterprises_status')->insert([
        'status'        => $s,
        'created_at'    => $tmp_date,
        'updated_at'    => $tmp_date 
      ]);
    }
  }
}
