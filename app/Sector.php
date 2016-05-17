<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
  protected $table = "sectors";

  protected $fillable = [
    'name'
  ];

  public function enterprises () 
  {
    return $this->hasMany('App\Enterprise');
  }

  public static function getOptions()
  {
    $arrSectors = ['Selecciona...'];
    $objSectors = Sector::orderBy('id', 'ASC')->where('id', '>', 1)->lists('name', 'id');

    foreach( $objSectors as $key => $value ) {
      $arrSectors[$key] = $value;
    }

    return $arrSectors;
  }
}
