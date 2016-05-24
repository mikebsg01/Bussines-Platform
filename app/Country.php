<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model 
{

  protected $table = 'countries';

  protected $fillable = [
    'key_name',
  ];

  public function enterprise()
  {
    return $this->hasMany('App\Enterprise');
  }

  public static function getOptions()
  {
    $countries    = config('variables.countries');
    $arrCountries = ['' => 'Selecciona...'];
    $objCountries = self::orderBy('id', 'ASC')->where('id', '>', 1)->lists('key_name', 'id');
    
    foreach ($objCountries as $id => $key_name) {
      $arrCountries[$key_name] = $countries[$key_name];
    }

    return $arrCountries;
  }

}