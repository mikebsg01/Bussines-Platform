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
    $sectors    = config('variables.sectors');
    $arrSectors = ['' => 'Selecciona...'];
    $objSectors = self::orderBy('id', 'ASC')->where('id', '>', 1)->lists('key_name', 'id');

    foreach( $objSectors as $id => $key_name ) {
      $arrSectors[$key_name] = $sectors[$key_name];
    }

    return $arrSectors;
  }
}
