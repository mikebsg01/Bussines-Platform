<?php

namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mail;

class IndexController extends Controller
{
  public function mails ()
  {
    $msg = "Mundo";
    $v = Mail::send('test.emails.reminder', ['msg' => $msg], function ($m) use ($msg) {
      $m->from('web@urcorp.mx', 'Application');

      $m->to('mikebs01@gmail.com', 'Mike Serrato')->subject('Mensaje enviado');
    });
    dd($v);
  }
}
