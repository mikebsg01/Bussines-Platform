<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Register;
use App\Enterprise;
use App\Enterprise_Num_Employees;

class InitialDataSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $user = User::create([
      'email'         => 'mserrato@urcorp.mx',
      'password'      => bcrypt('hello123'),
      'first_name'    => 'Michael Brandon',
      'last_name'     => 'Serrato Guerrero',
      'phone_lada_id' => 138,
      'phone_number'  => '4423813033',
      'agree'         => 1,
      'confirmed'     => 1
    ]);

    $register = Register::create([
      'user_id' => $user->id
    ]);

    $enterprise = Enterprise::create([
      'user_id'                       => $user->id,
      'sector_id'                     => 22,
      'enterprise_status_id'          => 2,
      'name'                          => 'UrCorp',
      'description'                   => 'Empresa con experiencia en el área de desarrollo de software, imagen corporativa y oferta exportable.',
      'fiscal_name'                   => 'CREATIVANG S.A de C.V',
      'country_id'                    => 146,
      'state'                         => 'Querétaro',
      'city'                          => 'Querétaro',
      'aem_chapter_id'                => 2,
      'address'                       => 'Prol. Tecnológico 950 Piso 4 B',
      'codepostal'                    => '76100',
      'phone_lada_id'                 => 138,
      'phone_number'                  => '4422334455',
      'email'                         => 'contacto@urcorp.mx',
      'url_website'                   => 'http://urcorp.mx/',
      'enterprise_type_id'            => 3,
      'enterprise_num_employees_id'   => 2,
      'year_established'              => '2015-10-25'
    ]);

    $user->register->updateProgress('enterprise');

    $user->register->updateProgress('commercial');

    $user->register->updateProgress('as');

  }
}
