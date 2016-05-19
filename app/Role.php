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
    return $this->belongsToMany('App\Enterprise', 'enterprise_role');
  }
}
