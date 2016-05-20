<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $roles = array_keys(config('variables.roles'));

    $tmp_date = date('Y-m-d H:i:s');

    DB::table('roles')->insert([
      'key_name'    => 'NONE',
      'created_at'  => $tmp_date,
      'updated_at'  => $tmp_date
    ]);

    foreach ($roles as $key_name) {

      $tmp_date = date('Y-m-d H:i:s');

      DB::table('roles')->insert([
        'key_name'    => $key_name,
        'created_at'  => $tmp_date,
        'updated_at'  => $tmp_date
      ]);
    }
  }
}
