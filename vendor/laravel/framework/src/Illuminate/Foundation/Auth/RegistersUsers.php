<?php

namespace Illuminate\Foundation\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Mail;

trait RegistersUsers
{
    use RedirectsUsers;

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRegister()
    {
        return $this->showRegistrationForm();
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        if (property_exists($this, 'registerView')) {
            return view($this->registerView);
        }
        
        return view('auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postRegister(Request $request)
    {
        return $this->register($request);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $request_user                       = $request->all();
        $request_user['confirmed']          = 0;
        $request_user['confirmation_code']  = g_confirmation_code();

        $this->create($request_user);

        $user = [
            'name'              => $request_user['name'], 
            'lastname'          => $request_user['lastname'],
            'email'             => $request_user['email'], 
            'confirmation_code' => $request_user['confirmation_code']
        ];

        $email_sent = Mail::send('emails.confirm_email', ['user' => $user], function ($m) use ($user) {
          
          $m->from('web@urcorp.mx', 'AEM Platform');
          $m->replyTo('web@urcorp.mx', 'AEM Platform');

          $m->to($user['email'], $user['name'] . ' ' . $user['lastname'])
            ->subject('Confirmar correo electrónico | AEM Platform');

        });

        // //Auth::guard($this->getGuard())->login($this->create($request->all()));
        if ($email_sent)
        {
            return redirect()->route('register.confirm.email', ['email' => $user['email']]);
        }
        // return redirect($this->redirectPath());
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return string|null
     */
    protected function getGuard()
    {
        return property_exists($this, 'guard') ? $this->guard : null;
    }
}
