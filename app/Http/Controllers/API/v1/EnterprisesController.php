<?php

namespace App\Http\Controllers\API\v1;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\EnterpriseRequest;
use App\Http\Controllers\Controller;
use App\Enterprise;

class EnterprisesController extends Controller
{

  public function index()
  {
    $response = [
      'query'   =>  'fail', 
      'msg'     =>  'Not found enterprises', 
      'found'   =>  0,
      'data'    =>  null,
    ];

    if ($enterprises = Enterprise::all())
    {
      $response['query']  = 'success';
      $response['msg']    = 'Found ' . $enterprises->count() . ' enterprises successfully';
      $response['found']  = $enterprises->count();
      $response['data']   = $enterprises;
    }
    else 
    {
      $response['query']  = 'error';
      $response['msg']    = 'Could not get enterprises';
    }

    return response()->json($response);
  }

  public function show($id)
  {
    $response = [
      'query'   =>  'fail', 
      'msg'     =>  'Not found enterprise',
      'data'    =>  null,
    ];

    if ($enterprise = Enterprise::find($id))
    {
      $response['query']  = 'success';
      $response['msg']    = 'Enterprise has successfully obtained';
      $response['data']   = $enterprise;
    }
    else
    {
      $response['query']  = 'error';
      $response['msg']    = 'Enterprise can not be obtained';
    }

    return response()->json($response);
  }

  public function update($id, Request $request)
  {
    $response = [
      'query'   =>  'fail', 
      'msg'     =>  'Not found enterprise',
      'data'    =>  null
    ];

    if ($enterprise = Enterprise::find($id))
    {
      $enterprise->fill( $request->all() );

      if ($enterprise->update())
      {
        $response['query']  = 'success';
        $response['msg']    = 'Enterprise was successfully updated';
      }
      else 
      {
        $response['query']  = 'error';
        $response['query']  = 'Enterprise could not be updated';
      }

      $response['data'] = $enterprise;
    }
    else
    {
      $response['query']  = 'error';
      $response['msg']    = 'Enterprise can not be obtained';
    }

    return response()->json($response);
  }

  public function destroy($id, Request $request)
  {
    $response = [
      'query'   =>  'fail', 
      'msg'     =>  'Not found enterprise',
      'data'    =>  null
    ];

    if ($enterprise = Enterprise::find($id))
    {
      if ($enterprise->delete())
      {
        $response['query']  = 'success';
        $response['msg']    = 'Enterprise was successfully deleted';
      }
      else 
      {
        $response['query']  = 'error';
        $response['query']  = 'Enterprise could not be deleted';
      }

      $response['data'] = $enterprise;
    } 
    else
    {
      $response['query']  = 'error';
      $response['msg']    = 'Enterprise can not be obtained';
    }
    return response()->json($response);
  }
}
