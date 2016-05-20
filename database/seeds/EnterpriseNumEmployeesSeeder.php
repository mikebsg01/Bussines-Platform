<?php

use Illuminate\Database\Seeder;

class EnterpriseNumEmployeesSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $enterprise_num_employees = array_keys(config('variables.enterprise_num_employees'));

    $tmp_date = date('Y-m-d H:i:s');

    DB::table('enterprise_num_employees')->insert([
      'key_name'    => 'NONE',
      'created_at'  => $tmp_date,
      'updated_at'  => $tmp_date
    ]);

    foreach ($enterprise_num_employees as $key_name) {

      $tmp_date = date('Y-m-d H:i:s');

      DB::table('enterprise_num_employees')->insert([
        'key_name'    => $key_name,
        'created_at'  => $tmp_date,
        'updated_at'  => $tmp_date
      ]);
    }
  }
}
