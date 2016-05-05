<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enterprise_Status extends Model
{
  protected $table = "enterprises_status";

  protected $fillable = [
    'status'
  ];

  public function enterprises()
  {
    return $this->hasMany('App\Enterprise');
  }

  public static function getOptions()
  {
    $arrStatus = ['' => 'Status de la empresa..'];
    $objStatus = Enterprise_Status::orderBy('id', 'ASC')->where('id', '>', 1)->lists('status', 'id');

    foreach( $objStatus as $id => $status ) {
      $arrStatus[$id] = $status;
    }

    return $arrStatus;
  }

}
