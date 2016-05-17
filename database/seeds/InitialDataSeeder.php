<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Register;
use App\Enterprise;
use App\Commercial;

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
      'name'          => 'Michael Brandon',
      'lastname'      => 'Serrato Guerrero',
      'phone_lada_id' => 138,
      'phone_number'  => '4423813033',
      'agree'         => 1,
      'confirmed'     => 1
    ]);

    $register = Register::create([
      'user_id' => $user->id
    ]);

    $enterprise = Enterprise::create([
      'user_id'               => $user->id,
      'sector_id'             => 22,
      'enterprise_status_id'  => 2,
      'name'                  => 'UrCorp',
      'description'           => 'Empresa con experiencia en el área de desarrollo de software, imagen corporativa y oferta exportable.',
      'fiscal_name'           => 'CREATIVANG S.A de C.V',
      'country_id'            => 146,
      'state'                 => 'Querétaro',
      'city'                  => 'Querétaro',
      'aem_type_id'           => 2,
      'address'               => 'Prol. Tecnológico 950 Piso 4 B',
      'codepostal'            => '76100',
      'phone_lada_id'         => 138,
      'phone_number'          => '4422334455',
      'email'                 => 'contacto@urcorp.mx',
      'url_website'           => 'http://urcorp.mx/',
      'registered_as'         => 'both'
    ]);

    $user->register->updateProgress('enterprise');

    $commercial = Commercial::create([
      'enterprise_id'         => $enterprise->id,
      'enterprise_type_id'    => 3,
      'num_employees'         => '1-10',
      'year_established'      => '2015-10-25',
      'products_and_services' => json_encode(['Páginas web', 'SEO', 'Imagen Corporativa', 'Oferta exportable']),
      'affiliations'          => json_encode(['WTC', 'AEM', 'COPARMEX']),
      'certifications'        => json_encode(['WTC', 'COPARMEX'])
    ]);

    $user->register->updateProgress('commercial');

    $user->register->updateProgress('as');

  }
}
