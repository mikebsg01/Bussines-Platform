<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enterprise_Status extends Model
{
  protected $table = "enterprises_status";

  protected $fillable = [
    'key_name'
  ];

  public function enterprises()
  {
    return $this->hasMany('App\Enterprise');
  }

  public static function getOptions()
  {
    $arrStatus = ['' => 'Status de la empresa...'];
    $objStatus = self::orderBy('id', 'ASC')->where('id', '>', 1)->lists('key_name', 'id');

    foreach ($objStatus as $id => $key_name) {
      $arrStatus[$id] = $key_name;
    }

    return $arrStatus;
  }

}
