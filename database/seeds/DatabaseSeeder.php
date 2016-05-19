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
        // $this->call(EnterpriseTypesSeeder::class);
        // $this->call(InitialDataSeeder::class);
        // factory(App\User::class, 10)->create();
        // factory(App\Commercial::class, 10)->create();
        // $this->call(UserTableSeeder::class);
    }
}
