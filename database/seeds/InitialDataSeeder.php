<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Register;
use App\Enterprise;
use App\Enterprise_Num_Employees;
use App\Role;
use App\Product;
use App\Affiliation;
use App\Certification; 

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
      'enterprise_type_id'            => 3,
      'enterprise_status_id'          => 2,
      'country_id'                    => 146,
      'aem_chapter_id'                => 2,
      'name'                          => 'UrCorp',
      'fiscal_name'                   => 'CREATIVANG S.A de C.V',
      'description'                   => 'Empresa con experiencia en el área de desarrollo de software, imagen corporativa y oferta exportable.',
      'state'                         => 'Querétaro',
      'city'                          => 'Querétaro',
      'address'                       => 'Prol. Tecnológico 950 Piso 4 B',
      'codepostal'                    => '76100',
      'phone_lada_id'                 => 138,
      'phone_number'                  => '4422334455',
      'email'                         => 'contacto@urcorp.mx',
      'enterprise_num_employees_id'   => 2,
      'year_established'              => '2015-10-25',
      'url_website'                   => 'http://urcorp.mx/',
    ]);
  
    $enterprise->roles()->attach([2, 3]);

    /**
     * Relationship:  Enterprises/Products
     * Type:          Many To Many
     * ===================================================== //
     */
    $arr_products = [
      'Páginas web',
      'Imagen corporativa',
      'SEO',
      'Oferta exportable'
    ];

    $n = count($arr_products);

    $arr_products_id = [];
    
    for ($i = 0; $i < $n; ++$i) {

      $product = Product::create([
        'name' => $arr_products[$i]
      ]);

      array_push($arr_products_id, $product->id);
    }

    $enterprise->products()->attach($arr_products_id);

    /**
     * Relationship:  Enterprises/Affiliations
     * Type:          Many To Many
     * ===================================================== //
     */
    $arr_affiliations = [
      'AEM',
      'WTC',
      'Coparmex'
    ];

    $n = count($arr_affiliations);

    $arr_affiliations_id = [];

    for ($i = 0; $i < $n; ++$i) {

      $affiliation = Affiliation::create([
        'name'  => $arr_affiliations[$i]
      ]);

      array_push($arr_affiliations_id, $affiliation->id);
    }

    $enterprise->affiliations()->attach($arr_affiliations_id);

    /**
     * Relationship:  Enterprises/Certifications
     * Type:          Many To Many
     * ===================================================== //
     */
    $arr_certifications = [
      'WTC',
      'Coparmex'
    ];

    $n = count($arr_certifications);

    $arr_certifications_id = [];

    for ($i = 0; $i < $n; ++$i) {

      $certification = Certification::create([
        'name' => $arr_certifications[$i]
      ]);

      array_push($arr_certifications_id, $certification->id);
    }

    $enterprise->certifications()->attach($arr_certifications_id);

    $user->register->updateProgress('enterprise');
    $user->register->updateProgress('commercial');
    $user->register->updateProgress('as');
  }
}
