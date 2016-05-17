<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lada extends Model
{
  protected $table = "ladas";

  protected $fillable = [];

  public function users() 
  {
    return $this->hasMany('App\Users');
  }

  public function enterprises()
  {
    return $this->hasMany('App\Enterprise');
  }

  public static function getLadaOptions()
  {
    $arrLadas = ['' => 'Lada'];
    $objLadas = Lada::orderBy('id', 'ASC')->where('id', '>', 1)->lists('value', 'id');

    foreach( $objLadas as $key => $value ) {
      $arrLadas[$key] = $value;
    }

    return $arrLadas;
  }

}
