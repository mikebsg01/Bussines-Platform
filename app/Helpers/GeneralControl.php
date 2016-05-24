<?php
  // Archivo: GeneralControl.php
  // Ubicación: App/Helpers/GeneralControl.php
  // Descripción: Implementa una gran variedad de
  // funciones útiles para el desarrollo de
  // la aplicación.
  
  function app_js_file($path, $action_name)
  {
    $js_files   = config('variables.js_files');

    if (in_array($action_name, array_keys($js_files)))
    {
      $script   = '<script type="text/javascript" src="';
      $script  .= asset($path . $js_files[$action_name]);
      $script  .= '"></script>';

      return $script;
    }
    return null;
  }

  function content_exists($class, $property)
  {
    return isset($class->$property) && !empty($class->$property);
  }

  function random_string($length = null)
  {
    if (is_null($length))
    {
      $length = 64;
    }
    return bin2hex(openssl_random_pseudo_bytes($length));
  }

  function g_confirmation_code()
  {
    do 
    { 
      $str = random_string(64);
    } 
    while($str == null || is_numeric($str[0]));

    return $str;
  }

  function empty_filter($values)
  {
    return (isset($values) && count($values) == 1 && $values[0] == "");
  }

  function txti18n($type, $key_name)
  {
    $path = 'general.text';

    return trans($path . '.' . $type . '.' . $key_name);
  }