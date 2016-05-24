<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use \Auth;
use \Validator;
use \Session;

use App\Http\Requests;
use App\Http\Requests\RegisterAsRequest;
use App\Http\Requests\RegisterDatesRequest;
use App\Http\Controllers\Controller;
use App\Enterprise;
use App\Register;
use App\Role;
use App\Sector;
use App\Enterprise_Num_Employees;
use App\Enterprise_Type;
use App\Product;
use App\Affiliation;
use App\Certification;

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

  public function commercial()
  {
    Carbon::setLocale('es');

    $prefix                     = $this->getRouter()->getCurrentRoute()->getPrefix();
    $sectors                    = Sector::getOptions();
    $enterprises_num_employees  = Enterprise_Num_Employees::getOptions();
    $enterprises_types          = Enterprise_Type::getOptions();

    return view('register.commercial')->with([
      'prefix'                    =>  $prefix,
      'register_progress'         =>  isset($this->register->progressWithCurrentStep) ? 
                              $this->register->progressWithCurrentStep : null,
      'date'                      =>  getDateFormat(Carbon::now(), 'd/m/Y'), // crear helper para fechas
      'sectors'                   =>  $sectors,
      'enterprises_num_employees' =>  $enterprises_num_employees,
      'enterprises_types'         =>  $enterprises_types,
      'enterprise'                =>  $this->register->enterprise ?
                              $this->user->enterprises->first() : ( new Enterprise() )
    ]);
  }

  public function commercial_store(Request $request)
  {
    Carbon::setLocale('es');

    $is_new_commercial = ! ((bool) $this->register->commercial);

    if ($this->user->enterprises->count() > 0)
    {
      $enterprise = $this->user->enterprises->first();
    } 
    else 
    {
      return abort(403, 'Unauthorized action.');
    }

    $validator = Validator::make($request->all(), [
      'sector_id'                     => 'required|exists:sectors,key_name',
      'enterprise_type_id'            => 'required|exists:enterprises_types,key_name',
      'enterprise_num_employees_id'  => 'required|exists:enterprises_num_employees,key_name',
      'year_established'              => 'required|date_format:d/m/Y|before:tomorrow',
      'products'                      => 'required'
    ]);

    if ($validator->fails())
    {
      return redirect()->route('register.commercial.index')
              ->withErrors($validator)
              ->withInput();
    }
    else 
    {
      $enterprise->fill($request->all());

      $enterprise->sector_id = Sector::whereKeyName(
        $request->input('sector_id')
      )->first()->id;

      $enterprise->enterprise_type_id = Enterprise_Type::whereKeyName(
        $request->input('enterprise_type_id')
      )->first()->id;

      $enterprise->enterprise_num_employees_id = Enterprise_Num_Employees::whereKeyName(
          $request->input('enterprise_num_employees_id')
      )->first()->id;

      /**
       * Relationship:  Enterprises/Products
       * Type:          Many To Many
       * ===================================================== //
       */
      $tmp_arr_elements = [];
      $tmp_arr          = tagsToArray($request->input('products'), ",,;");
      $tmp_n            = count($tmp_arr);

      for ($i = 0; $i <$tmp_n; ++$i) {
        $tmp_object = new Product(['name' => $tmp_arr[$i]]);

        $tmp_found = Product::whereName($tmp_object->name)->first();

        if (!is_null($tmp_found)) {

          array_push($tmp_arr_elements, $tmp_found->id);
        } else {

          $tmp_object->save();
          array_push($tmp_arr_elements, $tmp_object->id);
        }
      }

      $enterprise->products()->sync($tmp_arr_elements);

      /**
       * Relationship:  Enterprises/Affiliations
       * Type:          Many To Many
       * ===================================================== //
       */
      $tmp_arr_elements = [];
      $tmp_arr          = tagsToArray($request->input('affiliations'), ",,;");
      $tmp_n            = count($tmp_arr);

      for ($i = 0; $i <$tmp_n; ++$i) {
        $tmp_object = new Affiliation(['name' => $tmp_arr[$i]]);

        $tmp_found = Affiliation::whereName($tmp_object->name)->first();

        if (!is_null($tmp_found)) {

          array_push($tmp_arr_elements, $tmp_found->id);
        } else {

          $tmp_object->save();
          array_push($tmp_arr_elements, $tmp_object->id);
        }
      }

      $enterprise->affiliations()->sync($tmp_arr_elements);

      /**
       * Relationship:  Enterprises/Certifications
       * Type:          Many To Many
       * ===================================================== //
       */
      $tmp_arr_elements = [];
      $tmp_arr          = tagsToArray($request->input('certifications'), ",,;");
      $tmp_n            = count($tmp_arr);

      for ($i = 0; $i <$tmp_n; ++$i) {
        $tmp_object = new Certification(['name' => $tmp_arr[$i]]);

        $tmp_found = Certification::whereName($tmp_object->name)->first();

        if (!is_null($tmp_found)) {

          array_push($tmp_arr_elements, $tmp_found->id);
        } else {

          $tmp_object->save();
          array_push($tmp_arr_elements, $tmp_object->id);
        }
      }

      $enterprise->certifications()->sync($tmp_arr_elements);

    /*
     * Enterprise Year Established - Date with Carbon
     * ===================================================== //
     */
      $enterprise->year_established = createDateFromFormat($enterprise->year_established, 'd/m/Y')->toDateString();

      if ($enterprise->update())
      {
        if ($is_new_commercial) 
        {
          $this->register->updateProgress('commercial');
        } 
      }

    }

    return redirect()->route('register.as.index');
  }

  public function register_as()
  {
    $prefix = $this->getRouter()->getCurrentRoute()->getPrefix();

    $is_new_register = ! ((bool) $this->register->as);

    $roles = Role::getOptions();

    $enterprise_role = null;

    if ($this->user->enterprises->count() > 0 && !$is_new_register)
    {
      $enterprise_role = $this->user->enterprises->first()->role()->key_name;
    }

    return view('register.as')
      ->with([
        'prefix'            =>  $prefix,
        'register_progress' =>  isset($this->register->progressWithCurrentStep) ?
                                $this->register->progressWithCurrentStep : null,
        'roles'             =>  $roles,
        'enterprise_role'   =>  $enterprise_role
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
      'role_id'   => 'required|exists:roles,key_name'
    ]);

    if ($validator->fails())
    {
      return redirect()->route('register.as.index')
              ->withErrors($validator)
              ->withInput();
    }
    else
    {
      $arr_roles = [Role::whereKeyName($request->input('role_id'))->first()->id];
      $enterprise->roles()->sync($arr_roles);
      
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
