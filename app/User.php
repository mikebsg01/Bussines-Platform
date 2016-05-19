<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

  protected $table = "users";

  protected $fillable = [
    'email', 
    'password',
    'first_name',
    'last_name',
    'phone_lada_id',
    'phone_number',
    'agree',
    'confirmation_code',
    'confirmed'
  ];

  protected $hidden = [
    'password', 
    'remember_token',
    'agree',
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

  public function getFirstNameAttribute($value)
  {
    return cucwords($value);
  }

  public function getLastnameAttribute($value)
  {
    return cucwords($value);
  }

  public function getShortNameAttribute()
  {
    $first_name = current(explode(' ', $this->first_name));
    $last_name  = current(explode(' ', $this->last_name)); 
    return $first_name . ' ' . $last_name;
  }

  public function getFullNameAttribute()
  { 
    return $this->first_name . ' ' . $this->last_name;
  }

}
