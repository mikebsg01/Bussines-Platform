<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class EnterpriseRequest extends Request
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'name'          => 'required|max:45|unique:enterprises',
      'url_logo'      => 'mimes:jpg,png,bmp,gif,svg',
      'description'   => 'required|min:10|max:250', 
      'fiscal_name'   => 'required|max:250',
      'country_id'    => 'required|integer|min:2|exists:countries,id',
      'state'         => 'required|max:25',
      'city'          => 'required|max:25',
      'address'       => 'required|max:250',
      'codepostal'    => 'required|size:5',
      'phone_lada_id' => 'required|integer|min:2|exists:ladas,id',
      'phone_number'  => 'required|regex:/^[0-9]{10,15}$/',
      'email'         => 'required|email|max:255',
      'url_website'   => 'url'
    ];
  }
}
