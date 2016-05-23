<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $this->call(AEMChapterSeeder::class);
    $this->call(SectorSeeder::class);
    $this->call(LadaSeeder::class);
    $this->call(CountrySeeder::class);
    $this->call(EnterprisesStatusSeeder::class);
    $this->call(EnterprisesTypesSeeder::class);
    $this->call(EnterprisesNumEmployeesSeeder::class);
    $this->call(RoleSeeder::class);
    $this->call(InitialDataSeeder::class);
    $this->call(TestSeeder::class);
  }
}
