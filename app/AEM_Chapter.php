<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AEM_Chapter extends Model
{
  protected $table = 'aem_chapter';

  protected $fillable = [
    'key_name'
  ];

  public function enterprises()
  {
    return $this->hasMany('App\Enterprise');
  }

  public static function getOptions()
  {
    $arrAEMChapter = ['' => 'Selecciona...'];
    $objAEMChapter = self::orderBy('id', 'ASC')->where('id', '>', 1)->lists('key_name', 'id');

    foreach ($objAEMChapter as $key => $value)
    {
      $arrAEMChapter[$key] = $value;
    }
    return $arrAEMChapter;
  }
}