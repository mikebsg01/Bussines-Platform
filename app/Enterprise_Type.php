<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enterprise_Type extends Model
{
  protected $table = "enterprise_types";

  protected $fillable = [
    'key',
    'value'
  ];

  public static function getOptions()
  {
    $arrEnterpriseTypes = ['', 'Selecciona..'];
    $objEnterpriseTypes = Enterprise_Type::orderBy('id', 'ASC')->where('id', '>', 1)->lists('value', 'id');

    foreach( $objEnterpriseTypes as $key => $value ) 
    {
      $arrEnterpriseTypes[$key] = $value;
    }
    return $arrEnterpriseTypes;
  }
}
