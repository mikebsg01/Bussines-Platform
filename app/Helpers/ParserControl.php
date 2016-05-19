<?php
  // Archivo: ParserControl.php
  // Ubicación: App/Helpers/ParserControl.php
  // Descripción: Implementa los helpers necesarios
  // para la conversión de distintos formatos.

  function tagsToArray($str, $delimiter = null) 
  {
    $x = array();

    if ($delimiter !== null)
    {
      $x = explode($delimiter, $str);

      for ($i = 0; $i < count($x); ++$i)
      {
        if ($x[$i] == "")
        {
          unset($x[$i]);  
        }
      }
    } 
    else 
    {
      $x = $str; // or $x = [$str]
    }
    return  json_encode( $x );
  }

  function arrayToTags($str, $delimiter)
  {
    $x    = json_decode($str);
    $str  = ""; 

    if (count($x) > 0)
    {
      $str .= $x[0];
    }

    for ($i = 1; $i < count($x); ++$i)
    {
      $str .= $delimiter . $x[$i];
    }

    return $str;
  }

  function arrayToString($array, $delimiter)
  {
    $x    = $array;
    $str  = ""; 

    if (count($x) > 0)
    {
      $str .= $x[0];
    }

    for ($i = 1; $i < count($x); ++$i)
    {
      $str .= $delimiter . $x[$i];
    }

    return $str;
  }

  function arrayForValidationRule(array $array, $delimiter = null)
  {
    $str    = "";
    $keys   = array_keys($array);
    $n      = count($keys);

    if( $n > 0 )
    {
      $str = $keys[0];
    }
    
    for($i = 1; $i < $n; ++$i)
    {
      $str .= $delimiter . $keys[$i];
    }

    return $str;
  }

  function cstrtolower($str)
  {
    return mb_strtolower($str, 'UTF-8');
  }

  function cstrtoupper($str)
  {
    return mb_strtoupper($str, 'UTF-8');
  }

  function cucfirst($str)
  {
    $fc         = cstrtoupper(mb_substr($str, 0, 1));
    $final_str  = $fc.mb_substr($str, 1);
    return $final_str;
  }

  function cucwords($str)
  {
    $str_lower    = mb_strtolower($str,'UTF-8');
    $str_ucwords  = mb_convert_case($str_lower , MB_CASE_TITLE, "UTF-8");
    return $str_ucwords;
  }