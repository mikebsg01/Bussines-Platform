<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Auth;
use App\User;
use App\Register;
use Validator;
use Log;

class AuthController extends Controller
{
  /*
  |--------------------------------------------------------------------------
  | Registration & Login Controller
  |--------------------------------------------------------------------------
  |
  | This controller handles the registration of new users, as well as the
  | authentication of existing users. By default, this controller uses
  | a simple trait to add these behaviors. Why don't you explore it?
  |
  */

  use AuthenticatesAndRegistersUsers, ThrottlesLogins;

  /**
   * Where to redirect users after login / registration.
   *
   * @var string
   */
  protected $redirectTo = '/register/enterprise?loggued=1';

  /**
   * Create a new authentication controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('guest', ['except' => 'logout']);
  }

  /**
   * Get a validator for an incoming registration request.
   *
   * @param  array  $data
   * @return \Illuminate\Contracts\Validation\Validator
   */
  protected function validator(array $data)
  {
    
    $rules = [
      'email'             => 'required|email|max:255|unique:users',
      'password'          => 'required|confirmed|min:8',
      'name'              => 'required|min:2|max:25',        
      'lastname'          => 'required|min:2|max:25',
      'phone_lada_id'     => 'required|integer|min:2|exists:ladas,id',
      'phone_number'      => 'required|regex:/^[0-9]{10,15}$/',
      'agree'             => 'required|boolean|accepted'
    ];

    return Validator::make($data, $rules);
  }

  /**
   * Create a new user instance after a valid registration.
   *
   * @param  array  $data
   * @return User
   */
  protected function create(array $data)
  {
    \Log::info('USR: ' . $data['email'] . ' PW: ' . $data['password']);

    $user = User::create([
      'email'               => $data['email'],
      'password'            => bcrypt($data['password']),
      'name'                => $data['name'],
      'lastname'            => $data['lastname'],
      'phone_lada_id'       => $data['phone_lada_id'],
      'phone_number'        => $data['phone_number'],
      'agree'               => (boolean) $data['agree'],
      'confirmed '          => $data['confirmed'],
      'confirmation_code'   => $data['confirmation_code']
    ]);

    $register = new Register([
      'user_id' => $user->id
    ]);

    $register->save();

    return $user;
  }

  /**
   * View of email sent.
   * 
   * @return \Illuminate\Http\Response
   */
  public function email_sent($email)
  {
    return view('auth.email_sent')
      ->with([
        'email' => $email
      ]);
  }
}
