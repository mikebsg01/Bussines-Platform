<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
  protected $table = 'sectors';

  protected $fillable = [
    'key_name'
  ];

  public function enterprises() 
  {
    return $this->hasMany('App\Enterprise');
  }

  public static function getOptions()
  {
    $arrSectors = ['Selecciona...'];
    $objSectors = self::orderBy('id', 'ASC')->where('id', '>', 1)->lists('key_name', 'id');

    foreach( $objSectors as $key => $value ) {
      $arrSectors[$key] = $value;
    }

    return $arrSectors;
  }
}
