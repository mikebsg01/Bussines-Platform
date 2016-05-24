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
    $enterprises_types  = config('variables.enterprise_types');
    $arrEnterpriseTypes = ['' => 'Selecciona...'];
    $objEnterpriseTypes = self::orderBy('id', 'ASC')->where('id', '>', 1)->lists('key_name', 'id');

    foreach( $objEnterpriseTypes as $id => $key_name ) 
    {
      $arrEnterpriseTypes[$key_name] = $enterprises_types[$key_name];
    }
    return $arrEnterpriseTypes;
  }
}
