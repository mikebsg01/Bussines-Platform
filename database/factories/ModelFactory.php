<?php

use Faker\Generator;
use App\User;
use App\Enterprise;
use App\Enterprise_Type;
use App\Commercial;

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
    'name'            => $faker->firstName,
    'lastname'        => $faker->lastname,
    'phone_lada_id'   => mt_rand(2, count(config('variables.lada')) + 1),
    'phone_number'    => gNumberStringRandom(10),
    'agree'           => 1,
    'confirmed'       => 1
  ];
});

$factory->define(Enterprise::class, function (Generator $faker) use ($factory) {
  $users  = User::all()->lists('id');
  $tmp = [];
  preg_match("/(([\w]{1,}).(jpg|jpeg|png|gif|JPG|JPEG|PNG|GIF))$/", $faker->image(public_path().'/images/enterprises'), $tmp);
  return [
    'name'            => $faker->company,
    'url_logo'        => current($tmp),
    'description'     => $faker->text(mt_rand(1,2050)),
    'fiscal_name'     => $faker->company,
    'country_id'      => mt_rand(2, count(config('variables.countries')) + 1),
    'state'           => $faker->state,
    'city'            => $faker->city,
    'aem_type_id'     => mt_rand(2, count(config('variables.aem_type')) + 1),
    'address'         => $faker->address,
    'codepostal'      => gNumberStringRandom(5),
    'phone_lada_id'   => mt_rand(2, count(config('variables.lada')) + 1),
    'phone_number'    => gNumberStringRandom(10),
    'email'           => $faker->email,
    'url_website'     => $faker->url(),
    'user_id'         => $users[mt_rand(0, count($users) - 1)],
    'sector_id'       => mt_rand(2, count(config('variables.sector')) + 1),
    'enterprise_status_id'       => mt_rand(2, count(config('variables.enterprise_status')) + 1)
  ];
});


$factory->define(Commercial::class, function (Generator $faker) {
  $num_employees  = array_keys(config('variables.num_employees'));
  return [
    'year_established'      => $faker->date('Y-m-d', 'now'),
    'num_employees'         => $num_employees[mt_rand(0, count($num_employees) - 1)],
    'products_and_services' => function () use ($faker) {
      $arr = [];
      for ($i = 0; $i < mt_rand(0, 150); ++$i)
      {
        array_push($arr, $faker->userName());
      }
      $str = json_encode($arr);
      return $str;
    },
    'affiliations' => function () use ($faker) {
      $arr = [];
      for ($i = 0; $i < mt_rand(0, 150); ++$i)
      {
        array_push($arr, $faker->userName());
      }
      $str = json_encode($arr);
      return $str;
    },
    'certifications' => function () use ($faker) {
      $arr = [];
      for ($i = 0; $i < mt_rand(0, 150); ++$i)
      {
        array_push($arr, $faker->userName());
      }
      $str = json_encode($arr);
      return $str;
    },
    'enterprise_type_id'    => mt_rand(2, count(config('variables.enterprise_type'))),
    'enterprise_id'         => factory(Enterprise::class)->create()->id
  ];
});
