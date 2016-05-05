<?php

namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\CreditCard;
use PayPal\Api\FundingInstrument;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

class PaymentController extends Controller
{

  private $_api_context;

  public function __construct()
  {
    $paypal = config('paypal');

    $this->_api_context = new ApiContext(new OAuthTokenCredential(
      $paypal['CLIENT_ID'],
      $paypal['SECRET']
    ));

    $this->_api_context->setConfig($paypal['settings']);
  }

  public function form()
  {
    return view('test.payment.form');
  }

  public function postPayment(Request $request)
  {
    $creditcard = new CreditCard([
      'type'          =>  $request->input('type'),
      'number'        =>  $request->input('number'), 
      'expire_month'  =>  $request->input('month'),
      'expire_year'   =>  $request->input('year'),
      'cvv2'          =>  $request->input('cvv2'),
      'first_name'    =>  $request->input('name'),
      'last_name'     =>  $request->input('lastname')
    ]);

    $funding_instruments = new FundingInstrument([
      'credit_card'   => $creditcard
    ]);

    $payer = new Payer([
      'payment_method'      =>  'credit_card',
      'funding_instruments' => [
        $funding_instruments
      ]
    ]);

    $items = [];

    array_push($items, new Item([
      'name'        => 'Laptop Dell',
      'currency'    =>         'USD',
      'quantity'    =>             1,
      'price'       =>             700
    ]));

    $itemlist = new ItemList([
      'items'       =>  $items
    ]);

    $amount   = new Amount([
      'currency'    =>  'USD',
      'total'       =>      700
    ]);

    $transactions = [];

    array_push($transactions, new Transaction([
      'amount'        => $amount,
      'item_list'     => $itemlist,
      'description'   => 'Laptop Dell &copy; Windows 8.1 Starter Pack 64bits 8GB RAM - Intel Core i7'
    ]));

    $redirect_urls = new RedirectUrls([
      'return_url'   => route('test.payment.status'),
      'cancel_url'   => route('test.payment.status')
    ]);

    $payment       = new Payment([
      'intent'        =>  'Sale',
      'payer'         =>  $payer,
      'redirect_urls' =>  $redirect_urls,
      'transactions'  =>  $transactions
    ]);

    try 
    {
        $payment->create($this->_api_context);
    } 
    catch (\PayPal\Exception\PayPalConnectionException $ex) 
    {
      if (\Config::get('app.debug')) {
        echo "Exception: " . $ex->getMessage() . PHP_EOL;
        $err_data = json_decode($ex->getData(), true);
        exit;
      } else {
        die('Some error occurred, sorry for inconvenient');
      }
    }
    /*
    $approvalUrl = $payment->getApprovalLink();

    if (isset($approvalUrl))
    {
      return redirect()->away($approvalUrl);
    }

    return redirect()->route('test.payment.index')->with('error', 'Unknown error occurred');
    */
    return $payment->state;
  }
}
