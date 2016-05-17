<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Commercial extends Model
{
  protected $table = "commercial";

  protected $fillable = [
    'year_established',
    'num_employees',
    'enterprise_type_id',
    'incomes_year_current',
    'products_and_services',
    'affiliations',
    'certifications',
    'enterprise_id'
  ];

  public function enterprise()
  {
    return $this->belongsTo('App\Enterprise');
  }

  // <!-- Mutators -->
  public function getFoundedAttribute()
  {
    return Carbon::createFromFormat('Y-m-d', $this->year_established)->year; 
  }
  
  /*
  public function getYearEstablishedAttribute($value)
  {
    Carbon::setLocale('es');

    if (preg_match("/^(([\d]{4})+\-+([\d]{2})+\-+([\d]{2}))$/", $value))
    {
      $date = Carbon::createFromFormat('Y-m-d', $value);
      return $date->format("d/m/Y");
    }
    else if (preg_match("/^(([\d]{2})+\/+([\d]{2})+\/+([\d]{4}))$/", $value))
    {
      return Carbon::createFromFormat('d/m/Y', $value)->toDateString();
    }

    return null;
  }

  public function getProductsAndServicesAttribute($value)
  {
    return tagsToArray($value, ',,;');
  }

  public function getAffiliationsAttribute($value)
  {
    return tagsToArray($value, ',,;');
  }

  public function getCertificationsAttribute($value)
  {
    return tagsToArray($value, ',,;');
  }

  public function getProductsAndServicesToStringAttribute()
  {
    $arr  = json_decode($this->products_and_services);
    $str  = "";

    if( count($arr) > 0 ) 
    {
      $arr  = json_decode( $arr[0] );

      if( count($arr) > 0 )
      {
        $str .= $arr[0];
      }

      for ( $i = 1; $i < count($arr); ++$i )
      {
        $str .= ', ' . $arr[$i];
      }
    }
    return $str != "" ? $str : "(vacío)";
  }

  public function getAffiliationsToStringAttribute()
  {
    $arr  = json_decode($this->affiliations);
    $str  = "";

    if( count($arr) > 0 ) 
    {
      $arr  = json_decode( $arr[0] );

      if( count($arr) > 0 )
      {
        $str .= $arr[0];
      }

      for ( $i = 1; $i < count($arr); ++$i )
      {
        $str .= ', ' . $arr[$i];
      }
    }
    return $str != "" ? $str : "(vacío)";
  }

  public function getCertificationsToStringAttribute()
  {
    $arr  = json_decode($this->certifications);
    $str  = "";

    if( count($arr) > 0 ) 
    {
      $arr  = json_decode( $arr[0] );

      if( count($arr) > 0 )
      {
        $str .= $arr[0];
      }

      for ( $i = 1; $i < count($arr); ++$i )
      {
        $str .= ', ' . $arr[$i];
      }
    }
    return $str != "" ? $str : "(vacío)";
  }
  */

}
