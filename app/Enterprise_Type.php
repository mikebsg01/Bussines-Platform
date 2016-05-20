<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enterprise_Type extends Model
{
  protected $table = 'enterprises_types';

  protected $fillable = [
    'key_name'
  ];

  public function enterprises()
  {
    return $this->hasMany('App\Enterprise');
  }

  public static function getOptions()
  {
    $arrEnterpriseTypes = ['', 'Selecciona..'];
    $objEnterpriseTypes = self::orderBy('id', 'ASC')->where('id', '>', 1)->lists('key_name', 'id');

    foreach( $objEnterpriseTypes as $key => $value ) 
    {
      $arrEnterpriseTypes[$key] = $value;
    }
    return $arrEnterpriseTypes;
  }
}
