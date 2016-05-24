<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Register;

class RegisterMiddleware
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle($request, Closure $next)
  {
    $user             = Auth::user(); // Integer
    $register         = $user->register; // Object
    $route_name       = $request->route()->getName(); // String
    $steps            = Register::getSteps();
    $register_routes  = Register::getRoutes(); // Array
    $step_name        = Register::stepName($route_name);
    

    if (Register::isStep($step_name)) // Si forma parte del registro
    {
      if ($register->isFinished) // Y ya terminó
      {
        // Redirecciona a la ruta por default.
        return redirect()->route('enterprise.profile', ['slug' => $user->enterprises->first()->slug]);
      }
      else // Si no ha terminado
      {
        // Y es un paso al que no se ha llegado
        if (Register::getIndexStep($step_name) > Register::getIndexStep($register->nextStep))
        {
          // Redirecciona al paso actual.
          return redirect()->route($register_routes[ $register->nextStep ][0]);
        }
        else // Si es el paso actual o uno previo.
        {
          return $next($request);
        }
      }
    }
    else // Si no forma parte del registro
    {
      if (! $register->isFinished) // Y no ha terminado
      {
        // Si el registro esta por finalizar
        // Y la ruta es "register.complete" entonces
        // permite el acceso para darlo por terminado.
        if ($register->nextStep == Register::getStepByIndex(count($steps) - 1) && $route_name == 'register.complete')
        {
          return $next($request);
        }

        return redirect()->route($register_routes[ $register->nextStep ][0]);
      }
    }
    
    return $next($request);
  }
}
