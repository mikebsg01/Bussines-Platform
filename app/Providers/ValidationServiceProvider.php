<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;

class ValidationServiceProvider extends ServiceProvider
{
  /**
   * Bootstrap the application services.
   *
   * @return void
   */
  public function boot()
  {
    // Custom Validation Rules ...
    Validator::extend('num_employees', function ($attribute, $value, $parameters, $validator) {
      return in_array($value, config('variables.num_employees'));
    });

    Validator::extend('custom_hour', function ($attribute, $value, $parameters, $validator) {
      return preg_match("/^[0-9]{1,2}\:[0-9]{2}\s(AM|PM)$/", $value);
    });

    Validator::extend('arr_hour_lt', function ($attribute, $value, $parameters, $validator) {
      $from = $value;
      $to   = null;

      $tmp = explode('.', $attribute);
      $tmp[count($tmp) - 1] = 'to';
      $attr_to = arrayToString($tmp, '.');

      $to = array_get($validator->getData(), $attr_to);

      $time_from = strtotime($from);
      $time_to   = strtotime($to);

      if (! ($time_from < $time_to)) 
      {
        return false;
      }
      return true;
    });
  }

  /**
   * Register the application services.
   *
   * @return void
   */
  public function register()
  {
    //
  }
}
