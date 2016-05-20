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
}