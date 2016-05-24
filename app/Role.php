<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
  protected $tbale = 'roles';

  protected $fillable = [
    'key_name'
  ];

  public function enterprises()
  {
    return $this->belongsToMany('App\Enterprise', 'enterprise_role')->withTimestamps();
  }

  public static function getOptions()
  {
    $roles = config('variables.roles');
    $objRoles = self::orderBy('id', 'ASC')->where('id', '>', 1)->lists('key_name', 'id');

    foreach ($objRoles as $id => $key_name) {
      $arrRoles[$key_name] = $roles[$key_name];
    }

    return $arrRoles;
  }
}
