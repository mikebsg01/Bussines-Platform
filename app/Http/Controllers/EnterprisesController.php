<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Auth;
use \Validator;
use \File;
use App\Libraries\EngineSearch;
use App\Http\Requests;
use App\Http\Requests\EnterpriseRequest;
use App\Http\Controllers\Controller;
use App\Enterprise;
use App\Country;
use App\Lada;
use App\Register;


class EnterprisesController extends Controller
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
  public function index(Request $request)
  {
    if( (bool) $request->input('loggued') )
    {
      return redirect($this->register->nextStepRoute);
    }

    $prefix       = $this->getRouter()->getCurrentRoute()->getPrefix();
    $countries    = Country::getOptions();
    $ladas        = Lada::getLadaOptions();

    return view('register.enterprise')
      ->with([
        'prefix'            =>  $prefix,
        'register_progress' =>  isset($this->register->progressWithCurrentStep) ? 
                                $this->register->progressWithCurrentStep : null,
        'countries'         =>  $countries,
        'ladas'             =>  $ladas,
        'enterprise'        =>  $this->register->enterprise ?
                                $this->user->enterprises->first() : ( new Enterprise() )
      ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {

  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $is_new_enteprise = ! ((bool) $this->register->enterprise);

    if ($this->user->enterprises->count() > 0)
    {
      $enterprise           = $this->user->enterprises->first();
    } 
    else 
    {
      $enterprise           = new Enterprise();
      $enterprise->user_id  = $this->user->id;
    }

    $validator = Validator::make($request->all(), [
      'name'          => 'required|max:45|unique:enterprises,name'
                          . ( $is_new_enteprise ? null : (',' . $enterprise->id) ),
      'url_logo'      => 'mimes:jpeg,png,bmp,gif,svg',
      'description'   => 'required|min:10|max:250', 
      'fiscal_name'   => 'required|max:250',
      'country_id'    => 'required|integer|min:2|exists:countries,id',
      'state'         => 'required|max:25',
      'aem_type_id'   => 'required|integer|min:2|exists:aem_types,id',
      'address'       => 'required|max:250',
      'codepostal'    => 'required|size:5',
      'phone_lada_id' => 'required|integer|min:2|exists:ladas,id',
      'phone_number'  => 'required|regex:/^[0-9]{10,15}$/',
      'email'         => 'required|email|max:255',
      'url_website'   => 'url'
    ]);

    if ($validator->fails())
    {
      return redirect()->route('register.enterprise.index')
              ->withErrors($validator)
              ->withInput();
    } 
    else 
    {
      $enterprise->fill($request->except('url_logo'));

      $logo = [
        'file' => null, 
        'filename' => null
      ];

      if ($logo['file'] = $request->file('url_logo'))
      {
        $path               = public_path().'/images/enterprises';
        $logo['filename']   = 'img_' . md5( $enterprise->name . time() ) . '.' . $logo['file']->getClientOriginalExtension();
        $logo['file']->move($path, $logo['filename']);
      }

      if ($is_new_enteprise)
      {

        $arr_status = config('variables.enterprise_status');
        $status_id = ((int) array_search('not_verified', $arr_status)) + 2;

        $enterprise->enterprise_status_id = $status_id;

        if (! is_null($logo['file']))
        {
          $enterprise->url_logo = $logo['filename'];
        }

        if ($enterprise->save())
        {
          $this->register->updateProgress('enterprise');
        }
      }
      else
      {
        if (! is_null($logo['file']))
        {
          if (! is_null($enterprise->url_logo))
          {
            $path = public_path().'/images/enterprises/';

            if (File::exists($path . $enterprise->url_logo))
            {
              File::delete($path . $enterprise->url_logo);
            }
          }
          $enterprise->url_logo = $logo['filename'];
        }

        $enterprise->update();
      }
    }

    return redirect()->route('register.commercial.index');
  }

  /**
   * Display the specified resource.
   *
   * @param  string $slug
   * @return \Illuminate\Http\Response
   */
  public function profile($slug)
  {
    $enterprise = Enterprise::where('slug', '=', $slug)->first();

    return view('enterprise.profile.index')
      ->with([
        'enterprise' => $enterprise
      ]);
  }

  public function search(Request $request)
  {
    $q = $request->input('q');

    $engineSearch = new EngineSearch([
      'model'   => \App\Enterprise::class,
      'paginate' => 5,
      'request' => $request,
      'query'   => $q,
      'filters' => [
        'sector' => [
          'alias' => 's',
          'class' => \App\Sector::class
        ],
        'country' => [
          'alias' => 'c',
          'class' => \App\Country::class
        ],
        'aem_type' => [
          'alias' => 'a',
          'class' => \App\AEM_Type::class
        ],
        'enterprise_status' => [
          'alias' => 'status',
          'class' => \App\Enterprise_Status::class
        ]
      ]
    ]);

    return view('enterprise.search.index')
      ->with([
        'q'             => $q,
        'enterprises'   => $engineSearch->getResults(),
        'engineSearch'  => $engineSearch 
      ]);
  }

  public function edit_profile($slug)
  {
    $enterprise = Enterprise::where('slug', '=', $slug)->first();

    return view('enterprise.profile.edit')
      ->with([
        'enterprise' => $enterprise
      ]);
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
