<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Certification extends Model implements SluggableInterface
{
  use SluggableTrait;

  protected $table = 'certifications';

  protected $sluggable = [
    'build_from'  => 'name',
    'save_to'     => 'slug',
    'on_update'   => true
  ];

  protected $fillable = [
    'name',
    'slug'
  ];

  public function enterprises()
  {
    return $this->belongsToMany('App\Enterprise', 'enterprise_certification');
  }
}
