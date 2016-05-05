<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model 
{

  protected $table = "countries";

  protected $fillable = [
    'key',
    'value'
  ];

  public function enterprise()
  {
    return $this->hasMany('App\Enterprise');
  }

  public static function getOptions()
  {
    $arrCountries = ['' => 'Selecciona...'];
    $objCountries = Country::orderBy('id', 'ASC')->where('id', '>', 1)->lists('value', 'id');
    
    foreach ($objCountries as $key => $value) {
      $arrCountries[$key] = $value;
    }

    return $arrCountries;
  }

}