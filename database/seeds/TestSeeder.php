<?php

use Illuminate\Database\Seeder;
use App\Enterprise;
use App\Product;
use App\Affiliation;
use App\Certification;

class TestSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    /**
     * Factory:   Enterprises, Products, Affiliations, 
     *            Certifications.
     * ===================================================== //
     */
    factory(Enterprise::class, 50)->create();
    factory(Product::class, 50)->create();
    factory(Affiliation::class, 50)->create();
    factory(Certification::class, 50)->create();

    /**
     * Relationship:  Enterprises/Products
     * Type:          Many To Many
     * ===================================================== //
     */
    $m = Enterprise::count();
    $attached = 0;
    $index = 0;

    while ($attached != $m) {

      $register = Enterprise::find($index++);

      if (!empty($register)) {

        $elements   = 0;
        $n          = mt_rand(1, Product::count()-1);
        $last       = Product::all()->last()->id;
        $arr        = [];

        while ($elements != $n) {

          $x = mt_rand(2, $last);
          $tmp_register = Product::find($x);

          if (!empty($tmp_register)) {
            if (!in_array($x, $arr)) {
              array_push($arr, $x);
              ++$elements;
            }
          }
        }
        
        $register->products()->attach($arr);
        ++$attached;
      }
    }
    /**
     * Relationship:  Enterprises/Affiliations
     * Type:          Many To Many
     * ===================================================== //
     */
    $m = Enterprise::count();
    $attached = 0;
    $index = 0;

    while ($attached != $m) {

      $register = Enterprise::find($index++);

      if (!empty($register)) {

        $elements   = 0;
        $n          = mt_rand(0, Affiliation::count()-1);
        $last       = Affiliation::all()->last()->id;
        $arr        = [];

        while ($elements != $n) {

          $x = mt_rand(2, $last);
          $tmp_register = Affiliation::find($x);

          if (!empty($tmp_register)) {
            if (!in_array($x, $arr)) {
              array_push($arr, $x);
              ++$elements;
            }
          }
        }
        
        $register->affiliations()->attach($arr);
        ++$attached;
      }
    }
    /**
     * Relationship:  Enterprises/Certifications
     * Type:          Many To Many
     * ===================================================== //
     */
    $m = Enterprise::count();
    $attached = 0;
    $index = 0;

    while ($attached != $m) {

      $register = Enterprise::find($index++);

      if (!empty($register)) {

        $elements   = 0;
        $n          = mt_rand(0, Certification::count()-1);
        $last       = Certification::all()->last()->id;
        $arr        = [];

        while ($elements != $n) {

          $x = mt_rand(2, $last);
          $tmp_register = Certification::find($x);

          if (!empty($tmp_register)) {
            if (!in_array($x, $arr)) {
              array_push($arr, $x);
              ++$elements;
            }
          }
        }
        
        $register->affiliations()->attach($arr);
        ++$attached;
      }
    }
  }
}
