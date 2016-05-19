<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lada extends Model
{
  protected $table = 'ladas';

  protected $fillable = [
    'key_name'
  ];

  public function users() 
  {
    return $this->hasMany('App\User');
  }

  public function enterprises()
  {
    return $this->hasMany('App\Enterprise');
  }

  public static function getOptions()
  {
    $arrLadas = ['' => 'Lada'];
    $objLadas = self::orderBy('id', 'ASC')->where('id', '>', 1)->lists('key_name', 'id');

    foreach( $objLadas as $key => $value ) {
      $arrLadas[$key] = $value;
    }

    return $arrLadas;
  }

}
