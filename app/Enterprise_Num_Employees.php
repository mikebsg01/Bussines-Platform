<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enterprise_Num_Employees extends Model
{
  protected $table = 'enterprises_num_employees';

  protected $fillable = [
    'key_name'
  ];

  public function enterprises()
  {
    return $this->hasMany('App\Enterprise');
  }

  public static function getOptions()
  {
    $enterprises_num_employees = config('variables.enterprise_num_employees');
    $arrNumEmployees = ['' => 'Selecciona...'];
    $objNumEmployees = self::orderBy('id', 'ASC')->where('id', '>', 1)->lists('key_name', 'id');

    foreach ($objNumEmployees as $id => $key_name) {
      $arrNumEmployees[$key_name] = $enterprises_num_employees[$key_name];
    }

    return $arrNumEmployees;
  }
}