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
        factory(App\Enterprise::class, 10)->create();
        factory(App\Product::class, 10)->create();
        factory(App\Affiliation::class, 10)->create();
        factory(App\Certification::class, 10)->create();
    }
}
