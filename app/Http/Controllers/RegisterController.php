<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Auth;
use \Validator;
use \Session;

use App\Http\Requests;
use App\Http\Requests\RegisterAsRequest;
use App\Http\Requests\RegisterDatesRequest;
use App\Http\Controllers\Controller;
use App\Enterprise;
use App\Register;

class RegisterController extends Controller
{

  private $user;
  private $register;

  public function __construct()
  {
    if (! Auth::guest())
    {
      $this->user       = Auth::user();
      $this->register   = $this->user->register;
    }
  }

  public function register_as()
  {
    $prefix = $this->getRouter()->getCurrentRoute()->getPrefix();

    $is_new_register = ! ((bool) $this->register->as);

    $registered_as = null;

    if ($this->user->enterprises->count() > 0 && !$is_new_register)
    {
      $registered_as = $this->user->enterprises->first()->registered_as;
    }

    return view('register.as')
      ->with([
        'prefix'            =>  $prefix,
        'register_progress' =>  isset($this->register->progressWithCurrentStep) ? 
                                $this->register->progressWithCurrentStep : null,
        'registered_as'     =>  $registered_as
      ]);
  }

  public function register_as_store(Request $request)
  {
    $is_new_register = ! ((bool) $this->register->as);

    if ($this->user->enterprises->count() > 0)
    {
      $enterprise = $this->user->enterprises->first();
    }
    else
    {
      return abort(403, 'Unauthorized action.');
    }

    $validator = Validator::make($request->all(), [
      'registered_as'   => 'required|in:' . arrayForValidationRule(getRegisterAsOptions(), ",")
    ]);

    if ($validator->fails())
    {
      return redirect()->route('register.as.index')
              ->withErrors($validator)
              ->withInput();
    }
    else
    {
      $enterprise->registered_as = $request->registered_as;
      
      if ($enterprise->update())
      {
        if ($is_new_register)
        {
          $this->register->updateProgress('as');
        }
      }
    }

    return redirect()->route('register.dates.index');
  }

  public function register_dates()
  {
    $is_new_register =  ! ((bool) $this->register->cites);

    $schedule = null;
    if ($this->user->enterprises->count() > 0)
    {
      $enterprise = $this->user->enterprises->first();
      
      if (!$is_new_register) 
      {
        $schedule = json_decode($enterprise->schedule, true);
      }
    }

    $prefix = $this->getRouter()->getCurrentRoute()->getPrefix();
    return view('register.dates')
      ->with([
        'prefix'            => $prefix,
        'register_progress' => isset($this->register->progressWithCurrentStep) ? 
                               $this->register->progressWithCurrentStep : null,
        'fields'            => Session::has('fields') ? Session::get('fields') : null,
        'schedule'          => $schedule ?: null
      ]);
  }

  public function register_dates_store(Request $request)
  {
    $is_new_register =  ! ((bool) $this->register->cites);

    if ($this->user->enterprises->count() > 0)
    {
      $enterprise = $this->user->enterprises->first();
    }
    else 
    {
      return abort(403, 'Unauthorized action.');
    }

    $validator = Validator::make($request->all(), [
      'day.*.*.from'    => 'required|custom_hour|arr_hour_lt',
      'day.*.*.to'      => 'required|custom_hour'
    ]);

    $empty_schedule = is_null($request->input('day'));

    if ($validator->fails() or $empty_schedule)
    {
      if ($empty_schedule) 
      {
        $validator->getMessageBag()->add('empty_schedule', trans('validation.custom.schedule.empty')); 
      }

      return redirect()->route('register.dates.index')
              ->withErrors($validator)
              ->withInput()
              ->with([
                'fields' => $request->input('day')
              ]);
    }
    else 
    {
      $schedule = $request->input('day');
      $enterprise->schedule = json_encode($schedule);
    }

    if( $enterprise->update() )
    {
      if ($is_new_register)
      {
        $this->register->updateProgress('cites');
      }
    }

    return redirect()->route('register.finished');
  }

  public function register_finished()
  {
    $prefix     = $this->getRouter()->getCurrentRoute()->getPrefix();
    $enterprise = $this->user->enterprises->first();

    return view('register.finished')
      ->with([
        'prefix'      =>  $prefix,
        'enterprise'  =>  $enterprise,
        'register_progress' =>  isset($this->register->progressWithCurrentStep) ? 
                                $this->register->progressWithCurrentStep : null
      ]);
  }

}
