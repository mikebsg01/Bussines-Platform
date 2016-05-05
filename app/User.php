<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

  protected $table = "users";

  protected $fillable = [
    'email', 
    'password',
    'name',
    'lastname',
    'phone_lada_id',
    'phone_number',
    'agree',
    'confirmed',
    'confirmation_code'
  ];

  protected $hidden = [
    'password', 
    'remember_token',
    'agree',
    'confirmed',
    'confirmation_code'
  ];

  public function lada()
  {
    return $this->belongsTo('App\Lada');
  }

  public function register()
  {
      return $this->hasOne('App\Register');
  }

  public function enterprises() 
  {
      return $this->hasMany('App\Enterprise');
  }

  public function getNameAttribute($value)
  {
    $str_lower = mb_strtolower($value,'UTF-8');
    $str_ucwords = mb_convert_case($str_lower , MB_CASE_TITLE, "UTF-8");
    return $value = $str_ucwords;
  }

  public function getLastnameAttribute($value)
  {
    $str_lower = mb_strtolower($value,'UTF-8');
    $str_ucwords = mb_convert_case($str_lower , MB_CASE_TITLE, "UTF-8");
    return $value = $str_ucwords;
  }

  public function getShortNameAttribute()
  {
    $name       = current( explode(' ', $this->name) );
    $lastname   = current( explode(' ', $this->lastname) ); 
    return $name . ' ' . $lastname;
  }

  public function getFullNameAttribute()
  { 
    return $this->name . ' ' . $this->lastname;
  }

}
