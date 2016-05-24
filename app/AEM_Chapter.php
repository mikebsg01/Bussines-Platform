<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AEM_Chapter extends Model
{
  protected $table = 'aem_chapters';

  protected $fillable = [
    'key_name'
  ];

  public function enterprises()
  {
    return $this->hasMany('App\Enterprise');
  }

  public static function getOptions()
  {
    $aem_chapters   = config('variables.aem_chapters');
    $arrAEMChapter = ['' => 'Selecciona...'];
    $objAEMChapter = self::orderBy('id', 'ASC')->where('id', '>', 1)->lists('key_name', 'id');

    foreach ($objAEMChapter as $id => $key_name)
    {
      $arrAEMChapter[$key_name] = $aem_chapters[$key_name];
    }
    return $arrAEMChapter;
  }
}