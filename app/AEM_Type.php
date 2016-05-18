<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AEM_Chapter extends Model
{
  protected $table = "aem_types";

  protected $fillable = [
    'key',
    'value'
  ];

  public function enterprises()
  {
    return $this->hasMany('App\Enterprise');
  }

  public static function getOptions()
  {
    $arrAEMTypes = ['' => 'Selecciona...'];
    $objAEMTypes = self::orderBy('id', 'ASC')->where('id', '>', 1)->lists('value', 'id');

    foreach ($objAEMTypes as $key => $value)
    {
      $arrAEMTypes[$key] = $value;
    }
    return $arrAEMTypes;
  }
}