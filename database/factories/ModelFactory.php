<?php

use Faker\Generator;
use App\User;
use App\Enterprise;
use App\Enterprises_Type;
use App\Enterprises_Status;
use App\Product;
use App\Affiliation;
use App\Certification;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(User::class, function (Generator $faker) {
  return [
    'email'           => $faker->email,
    'password'        => bcrypt(str_random(10)),
    'remember_token'  => str_random(10),
    'first_name'      => $faker->firstName,
    'last_name'       => $faker->lastname,
    'phone_lada_id'   => mt_rand(2, count(config('variables.lada')) + 1),
    'phone_number'    => gNumberStringRandom(10),
    'agree'           => 1,
    'confirmed'       => 1
  ];
});
  
$factory->define(Product::class, function (Generator $faker) {
  return [
    'name' => $faker->text(mt_rand(6,25))
  ];
});

$factory->define(Affiliation::class, function (Generator $faker) {
  return [
    'name' => $faker->company
  ];
});

$factory->define(Certification::class, function (Generator $faker) {
  return [
    'name' => $faker->company
  ];
});

$factory->define(Enterprise::class, function (Generator $faker) {

  $tmp_image = [];
  preg_match("/(([\w]{1,}).(jpg|jpeg|png|gif|JPG|JPEG|PNG|GIF))$/", $faker->image(public_path().'/images/enterprises'), $tmp_image);

  return [
    'user_id'                         => factory(User::class)->create()->id,
    'sector_id'                       => mt_rand(2, count(config('variables.sector')) + 1),
    'enterprise_type_id'              => mt_rand(2, count(config('variables.enterprise_type')) + 1),
    'enterprise_status_id'            => mt_rand(2, count(config('variables.enterprise_status')) + 1),
    'country_id'                      => mt_rand(2, count(config('variables.countries')) + 1),
    'aem_chapter_id'                  => mt_rand(2, count(config('variables.aem_chapter')) + 1),
    'name'                            => $faker->company,
    'fiscal_name'                     => $faker->company,
    'description'                     => $faker->text(mt_rand(6,2050)),
    'state'                           => $faker->state,
    'city'                            => $faker->city,
    'address'                         => $faker->address,
    'codepostal'                      => gNumberStringRandom(5),
    'phone_lada_id'                   => mt_rand(2, count(config('variables.lada')) + 1),
    'phone_number'                    => gNumberStringRandom(10),
    'email'                           => $faker->email,
    'enterprise_num_employees_id'     => mt_rand(2, count(config('variables.enterprise_num_employees')) + 1),
    'year_established'                => $faker->date('Y-m-d', 'now'),
    'url_website'                     => $faker->url(),
    'url_logo'                        => current($tmp_image),
  ];
});