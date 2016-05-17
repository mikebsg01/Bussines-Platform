<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Auth;

class Register extends Model
{
  protected $table    = "registers";

  protected $fillable = [
    'user_id'
  ];

  public function __construct($attributes = array())
  {
    foreach(Register::getSteps() as $steps)
    {
      array_push($this->fillable, $steps);
    }

    parent::__construct($attributes); 
  }

  public function user()
  {
    return $this->belongsTo('App\User');
  }

  public static function getRoutes()
  {
    $routes = config('variables.register');

    return $routes;
  }

  public static function getSteps()
  {
    $steps = array_keys(Register::getRoutes());

    return $steps;
  }

  public static function stepName($route_name)
  {
    $routes     = Register::getRoutes();
    $step_name  = arrayGetParentName($route_name, $routes);

    return $step_name;
  }

  public static function isStep($step_name)
  {
    return $step_name !== null;
  }

  public static function getIndexStep($step_name)
  {
    $steps  = Register::getSteps();

    return array_search($step_name, $steps);
  }

  public static function getIndexFinalStep()
  {
    $steps  = Register::getSteps();

    return count($steps);
  }

  public static function getStepByIndex($idx)
  {
    if (isset($idx) && is_int($idx))
    {
      if ($idx >= 0 && $idx < Register::getIndexFinalStep()) 
      {
        $all_steps = Register::getSteps();

        return $all_steps[$idx];
      }
    }

    return null;
  }

  public static function getStepRouteByIndex($idx)
  {
    if (isset($idx) && is_int($idx))
    {
      if ($idx >= 0 && $idx < Register::getIndexFinalStep()) 
      {
        $all_routes         = Register::getRoutes();
        $all_steps          = array_keys($all_routes);
        $step_name          = $all_steps[$idx];
        $route              = $all_routes[$step_name];
        return $route[0];
      }
    }

    return null;
  }

  public function getNextStepAttribute()
  {
    $register   = $this;
    $steps      = Register::getSteps();

    foreach($steps as $step)
    {
      if(! $register->{$step})
      {
        return $step;
      }
    }
    return null;
  }

  public function getNextStepRouteAttribute()
  {
    $routes = Register::getRoutes();

    return route( $routes[ $this->nextStep ][0] );
  }

  public function getIsFinishedAttribute()
  {
    return $this->nextStep === null;
  }

  public function updateProgress($step)
  {
    $register = $this;
    $steps    = Register::getSteps();

    if (in_array($step, $steps))
    {
      $register->{$step} = true;

      return $register->update();
    }
    return false;
  }

  public function getProgressWithCurrentStepAttribute()
  {
    $register   = $this;
    $steps      = Register::getSteps(); // Dimensional array
    $progress   = [];

    foreach($steps as $step)
    {
      array_push($progress, $step);

      if(! $register->{$step})
      {
        break;  
      }
    }

    return $progress;
  }
}
