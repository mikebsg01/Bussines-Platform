<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use \Auth;
use \Validator;

use App\Http\Requests;
use App\Http\Requests\CommercialRequest;
use App\Http\Controllers\Controller;
use App\Sector;
use App\Commercial;
use App\Enterprise;
use App\Enterprise_Type;
use App\Register;

class CommercialController extends Controller
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

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    Carbon::setLocale('es');

    $prefix             = $this->getRouter()->getCurrentRoute()->getPrefix();
    $sectors            = Sector::getOptions();
    $enterprise_types   = Enterprise_Type::getOptions();

    return view('register.commercial')->with([
      'prefix'            =>  $prefix,
      'register_progress' =>  isset($this->register->progressWithCurrentStep) ? 
                              $this->register->progressWithCurrentStep : null,
      'date'              =>  getDateFormat(Carbon::now(), 'd/m/Y'), // crear helper para fechas
      'sectors'           =>  $sectors,
      'enterprise_types'  =>  $enterprise_types,
      'enterprise'        =>  $this->register->enterprise ?
                              $this->user->enterprises->first() : ( new Enterprise() ),
      'commercial'        =>  $this->register->commercial ?
                              $this->user->enterprises->first()->commercial :
                              ( new Commercial() )
    ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    Carbon::setLocale('es');

    $is_new_commercial = ! ((bool) $this->register->commercial);

    if ($this->user->enterprises->count() > 0)
    {
      $enterprise = $this->user->enterprises->first();

      if (is_null($enterprise->commercial))
      {
        $commercial                 = new Commercial(); 
        $commercial->enterprise_id  = $enterprise->id;
      }
      else if ($enterprise->commercial)
      {
        $commercial = $enterprise->commercial;
      } 
    } 
    else 
    {
      return abort(403, 'Unauthorized action.');
    }

    $validator = Validator::make($request->all(), [
      'sector_id'             => 'required|integer|min:2|exists:sectors,id',
      'enterprise_type_id'    => 'required|integer|min:2|exists:enterprise_types,id',
      'num_employees'         => 'required|num_employees',
      'year_established'      => 'required|date_format:d/m/Y|before:tomorrow',
      'products_and_services' => 'required'
    ]);

    if ($validator->fails())
    {
      return redirect()->route('register.commercial.index')
              ->withErrors($validator)
              ->withInput();
    }
    else 
    {
      $enterprise->sector_id = (int) $request->sector_id;
      $enterprise->update(); 

      $commercial->fill($request->all());

      $commercial->products_and_services  = tagsToArray($commercial->products_and_services, ",,;");
      $commercial->affiliations           = tagsToArray($commercial->affiliations, ",,;");
      $commercial->certifications         = tagsToArray($commercial->certifications, ",,;");
      $commercial->year_established       = createDateFromFormat($commercial->year_established, 'd/m/Y')->toDateString();

      if ($is_new_commercial)
      {
        if ($commercial->save())
        {
          $this->register->updateProgress('commercial');
        }
      }
      else
      {
        $commercial->update();
      }
    }
    
    return redirect()->route('register.as.index');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
      //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
      //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
      //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
      //
  }
}
