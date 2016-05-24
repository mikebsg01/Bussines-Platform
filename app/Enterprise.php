<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Carbon\Carbon;

class Enterprise extends Model implements SluggableInterface
{
  use SluggableTrait;

  protected $sluggable = [
    'build_from'  => 'name',
    'save_to'     => 'slug',
    'on_update'   => true
  ];

  protected $table = "enterprises";

  protected $fillable = [
    'user_id',
    'sector_id',
    'enterprise_type_id',
    'enterprise_status_id',
    'country_id',
    'aem_chapter_id',
    'name',
    'slug',
    'fiscal_name',
    'description',
    'state',
    'city',
    'address',
    'codepostal',
    'phone_lada_id',
    'phone_number',
    'email',
    'enterprise_num_employees_id',
    'year_established',
    'schedule',
    'url_website',
    'url_logo',
    'url_video',
    'incomes_year_current'
  ];

  public function user() 
  {
    return $this->belongsTo('App\User');
  }

  public function sector()
  {
    return $this->belongsTo('App\Sector');
  }

  public function country() 
  {
    return $this->belongsTo('App\Country');
  }

  public function aem_chapter()
  {
    return $this->belongsTo('App\AEM_Chapter');
  }

  public function status()
  {
    return $this->belongsTo('App\Enterprise_Status', 'enterprise_status_id');
  }

  public function type()
  {
    return $this->belongsTo('App\Enterprise_Type', 'enterprise_type_id');
  }

  public function num_employees()
  {
    return $this->belongsTo('App\Enterprise_Num_Employees', 'enterprise_num_employees_id');
  }

  public function roles()
  {
    return $this->belongsToMany('App\Role', 'enterprise_role')->withTimestamps();
  }

  public function role()
  {
    return $this->roles->first();
  }

  public function lada()
  {
    return $this->belongsTo('App\Lada', 'phone_lada_id');
  }

  public function products()
  {
    return $this->belongsToMany('App\Product', 'enterprise_product')->withTimestamps();
  }

  public function products_to_array() 
  {
    return $this->products()->lists('name')->toArray();
  } 

  public function affiliations()
  {
    return $this->belongsToMany('App\Affiliation', 'enterprise_affiliation')->withTimestamps();
  }

  public function affiliations_to_array() 
  {
    return $this->affiliations()->lists('name')->toArray();
  }

  public function certifications()
  {
    return $this->belongsToMany('App\Certification', 'enterprise_certification')->withTimestamps();
  }

  public function certifications_to_array() 
  {
    return $this->certifications()->lists('name')->toArray();
  }

  public function getFoundedAttribute()
  {
    return Carbon::createFromFormat('Y-m-d', $this->year_established)->year; 
  }

  public function getPhoneLadaOnlyDigitsAttribute()
  {
    $digits = null;
    $str    = txti18n('ladas', $this->lada->key_name);
    preg_match("/(\(+.+\))/", $str, $digits);

    if (is_array($digits) && count($digits) > 0)
    {
      $digits = $digits[0];
    }

    return $digits;
  }

  public function short_description($length = 0, $end = null)
  {
    $str = $this->description;

    return str_limit($str, $length, $end);
  }

  public function scopeSearch($query, $q, $filters)
  {
    $finalQuery = $query 
    ->join('enterprise_product', 'enterprise_product.enterprise_id', '=', 'enterprises.id')
    ->join('products as product', 'product.id', '=', 'enterprise_product.product_id')
    ->join('sectors as sector', 'sector.id', '=', 'enterprises.sector_id')
    ->join('countries as country', 'country.id', '=', 'enterprises.country_id')
    ->join('aem_chapters as aem_chapter', 'aem_chapter.id', '=', 'enterprises.aem_chapter_id')
    ->join('enterprises_status as enterprise_status', 'enterprise_status.id', '=', 'enterprises.enterprise_status_id')
    ->where(function ($query) use ($q) {
      $query
        ->where('enterprises.name', 'LIKE', "%".$q."%")
        ->orWhere('enterprises.description', 'LIKE', "%".$q."%")
        ->orWhere('product.name', 'LIKE', "%".$q."%");
    });

    foreach ($filters as $filter => $attr) {                                                                    
      if (!is_null($attr->values)) {
        switch ($filter) {
          case 'sector':
            $finalQuery->where(function ($query) use ($attr) {
              $n = count($attr->values);
              if ($n > 0) {
                $query->where('sector.key_name', '=', $attr->values[0]);
              }
              for ($i = 1; $i < $n; ++$i) {
                $query->orWhere('sector.key_name', '=', $attr->values[$i]);
              }  
            });
          break;

          case 'country':
            $finalQuery->where(function ($query) use ($attr) {
              $n = count($attr->values);
              if ($n > 0) {
                $query->where('country.key_name', '=', $attr->values[0]);
              }
              for ($i = 1; $i < $n; ++$i) {
                $query->orWhere('country.key_name', '=', $attr->values[$i]);
              }
            });
          break;

          case 'aem_chapter':
            $finalQuery->where(function ($query) use ($attr) {
              $n = count($attr->values);
              if ($n > 0) {
                $query->where('aem_chapter.key_name', '=', $attr->values[0]);
              }
              for ($i = 1; $i < $n; ++$i) {
                $query->orWhere('aem_chapter.key_name', '=', $attr->values[$i]);
              }  
            });
          break;

          case 'enterprise_status':
            $finalQuery->where(function ($query) use ($attr) {
              $n = count($attr->values);
              if ($n > 0) {
                $query->where('enterprise_status.key_name', '=', $attr->values[0]);
              }
            });
          break;
        }
      }
    }

    $finalQuery
      ->select('enterprises.*')
      ->groupBy('enterprises.id')
      ->orderBy('enterprises.name', 'ASC');
      
    return $finalQuery;
  }
  
}
