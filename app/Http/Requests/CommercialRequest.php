<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CommercialRequest extends Request
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
      'sector_id'             => 'required|integer|min:2|exists:sectors,id',
      'enterprise_type_id'    => 'required|integer|min:2|exists:enterprise_types,id',
      'num_employees'         => 'required|num_employees',
      'year_established'      => 'required|date_format:d/m/Y|before:tomorrow'
    ];
  }
}
