<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');
});

Route::group(['middleware' => ['web']], function () {

  Route::group(['prefix' => 'register', 'as' => 'register'], function () {

    Route::group(['prefix' => 'confirm', 'as' => '.confirm'], function () {

      Route::group(['prefix' => 'email', 'as' => '.email'], function() {

        Route::get('/{email}', [
          'uses' => 'Auth\AuthController@email_sent'
        ]);

        Route::get('token/{confirmation_code}', [
          'as' => '.token',
          function ($confirmation_code) {

            $user = App\User::whereConfirmationCode($confirmation_code)->first();

            if (!$user) 
            {
              return abort(403);
            }

            $user->confirmed          = 1;
            $user->confirmation_code  = null;

            if ($user->update())
            {
              Auth::guard('web')->login($user);

              return redirect()->route('register.enterprise.index');
            }
            else 
            {
              return abort(403);
            }
            
          }
        ]);

      });

    });

  });

});

Route::group(['middleware' => ['web', 'auth', 'register']], function () {

  /**
   * Home
   */
  Route::get('/', [
    'as'    => 'home',
    'uses'  => 'HomeController@index'
  ]);

  /*
   * Register
   */
  Route::group(['prefix' => 'register'], function () {

    Route::resource('enterprise', 'EnterprisesController');

    Route::get('commercial', [
      'as'        => 'register.commercial.index',
      'uses'      => 'RegisterController@commercial'
    ]);

    Route::post('commercial', [
      'as'        => 'register.commercial.store',
      'uses'      => 'RegisterController@commercial_store'
    ]);

    Route::get('as', [
      'as'        => 'register.as.index',
      'uses'      => 'RegisterController@register_as'
    ]);

    Route::post('as', [
      'as'        => 'register.as.store',
      'uses'      => 'RegisterController@register_as_store'
    ]);

    Route::get('dates', [
      'as'        => 'register.dates.index',
      'uses'      => 'RegisterController@register_dates'
    ]);
    
    Route::post('dates', [
      'as'        => 'register.dates.store',
      'uses'      => 'RegisterController@register_dates_store'
    ]);

    Route::get('finished', [
      'as'        => 'register.finished',
      'uses'      => 'RegisterController@register_finished'
    ]);

    Route::get('complete', [
      'as'        => 'register.complete',
      function () {
        $user         = \Auth::user();
        $register     = $user->register;
        $enterprise   = $user->enterprises->first();

        $register->updateProgress('finished');

        return redirect()->route('enterprise.profile', ['slug' => $enterprise->slug]);
      }
    ]);

  }); // <!-- END REGISTER -->

  /*
   * API RESTful
   */
  Route::group(['prefix' => 'api', 'as' => 'api'], function () {

    /*
     * API version 1.0
     */
    Route::group(['prefix' => 'v1', 'as' => '.v1'], function () {

      /*
       * Enterprises
       */
      Route::group(['as' => '.enterprise'], function () {

        Route::get('enterprises/', [
          'as'        => '.index',
          'uses'      => 'API\v1\EnterprisesController@index'
        ]);

        Route::get('enterprise/{id}', [
          'as'        => '.show',
          'uses'      => 'API\v1\EnterprisesController@show'
        ]);

        Route::get('enterprise/{id}/update', [
          'as'        => '.update',
          'uses'      => 'API\v1\EnterprisesController@update'
        ]);

        Route::get('enterprise/{id}/destroy', [
          'as'        => '.destroy',
          'uses'      => 'API\v1\EnterprisesController@destroy'
        ]);

      });

    });

  });

  Route::get('profile/{slug}', [
    'uses'        => 'EnterprisesController@profile',
    'as'          => 'enterprise.profile'
  ]);

  Route::get('profile/{slug}/edit', [
    'uses'        => 'EnterprisesController@edit_profile',
    'as'          => 'enterprise.profile.edit'
  ]);

  Route::get('search', [
    'uses'        => 'EnterprisesController@search',
    'as'          => 'enterprise.search'
  ]);

  Route::get('engine', function() {

    $client = ClientBuilder::create()->build();

    dd($client);

  });

});

/*
 * Tests Controllers
 */
if (App::environment('local') || config('app.debug')) {
  
  Route::group(['prefix' => 'test', 'as' => 'test'], function () { 

    Route::get('/other', function () {

      $arr_status = config('variables.enterprise_status');
      $status_id = ((int) array_search('not_verified', $arr_status)) + 2;
      
      dd($status_id);

    });

    Route::get('/environment', function () {
      dd([
        'debug' => config('app.debug'),
        'environment' => App::environment('local')
      ]);
    });

    Route::get('/mails', [
      'uses'  => 'Test\IndexController@mails',
      'as'    => '.mails'
    ]);

    Route::get('/embebed', function () {
      return view('test/embebed');
    });

    Route::group(['prefix' => 'payment', 'as' => '.payment'], function () {

      Route::get('/', [
        'uses'        => 'Test\PaymentController@form',
        'as'          => '.index'
      ]);

      Route::post('/post', [
        'uses'        => 'Test\PaymentController@postPayment',
        'as'          => '.post'
      ]);

      Route::get('/status', [
        'uses'        => 'Test\PaymentController@getPaymentStatus',
        'as'          => '.status'
      ]);

    });

  });
}