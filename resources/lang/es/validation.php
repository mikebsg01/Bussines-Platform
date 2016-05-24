<?php

return [

  /*
  |--------------------------------------------------------------------------
  | Validation Language Lines
  |--------------------------------------------------------------------------
  |
  | The following language lines contain the default error messages used by
  | the validator class. Some of these rules have multiple versions such
  | such as the size rules. Feel free to tweak each of these messages.
  |
  */

  'accepted'             => ':attribute debe ser aceptado.',
  'active_url'           => ':attribute no es una URL válida.',
  'after'                => ':attribute debe ser una fecha posterior a :date.',
  'alpha'                => ':attribute solo debe contener letras.',
  'alpha_dash'           => ':attribute solo debe contener letras, números y guiones.',
  'alpha_num'            => ':attribute solo debe contener letras y números.',
  'array'                => ':attribute debe ser un conjunto.',
  'before'               => ':attribute debe ser una fecha anterior a :date.',
  'between'              => [
    'numeric' => ':attribute tiene que estar entre :min - :max.',
    'file'    => ':attribute debe pesar entre :min - :max kilobytes.',
    'string'  => ':attribute tiene que tener entre :min - :max carácateres.',
    'array'   => ':attribute tiene que tener entre :min - :max ítems.',
  ],
  'boolean'              => 'El campo :attribute debe tener un valor verdadero o falso.',
  'confirmed'            => 'La confirmación de :attribute no coincide.',
  'date'                 => ':attribute no es una fecha válida.',
  'date_format'          => ':attribute no corresponde al formato :format.',
  'different'            => ':attribute y :other deben ser diferentes.',
  'digits'               => ':attribute debe tener :digits dígitos.',
  'digits_between'       => ':attribute debe tener entre :min y :max dígitos.',
  'email'                => ':attribute no es un correo válido',
  'exists'               => ':attribute es inválido.',
  'filled'               => 'El campo :attribute es obligatorio.',
  'image'                => ':attribute debe ser una imagen.',
  'in'                   => ':attribute es inválido.',
  'integer'              => ':attribute debe ser un número entero.',
  'ip'                   => ':attribute debe ser una dirección IP válida.',
  'json'                 => 'El campo :attribute debe tener una cadena JSON válida.',
  'max'                  => [
    'numeric' => ':attribute no debe ser mayor a :max.',
    'file'    => ':attribute no debe ser mayor que :max kilobytes.',
    'string'  => ':attribute no debe ser mayor que :max carácateres.',
    'array'   => ':attribute no debe tener más de :max elementos.',
  ],
  'mimes'                => ':attribute debe ser un archivo con formato: :values.',
  'min'                  => [
    'numeric' => 'El tamaño de :attribute debe ser de al menos :min.',
    'file'    => 'El tamaño de :attribute debe ser de al menos :min kilobytes.',
    'string'  => ':attribute debe contener al menos :min carácateres.',
    'array'   => ':attribute debe tener al menos :min elementos.',
  ],
  'not_in'               => ':attribute es inválido.',
  'numeric'              => ':attribute debe ser numérico.',
  'regex'                => 'El formato de :attribute es inválido.',
  'required'             => 'El campo :attribute es obligatorio.',
  'required_if'          => 'El campo :attribute es obligatorio cuando :other es :value.',
  'required_unless'      => 'The :attribute field is required unless :other is in :values.',
  'required_with'        => 'El campo :attribute es obligatorio cuando :values está presente.',
  'required_with_all'    => 'El campo :attribute es obligatorio cuando :values está presente.',
  'required_without'     => 'El campo :attribute es obligatorio cuando :values no está presente.',
  'required_without_all' => 'El campo :attribute es obligatorio cuando ninguno de :values estén presentes.',
  'same'                 => ':attribute y :other deben coincidir.',
  'size'                 => [
    'numeric' => 'El tamaño de :attribute debe ser :size.',
    'file'    => 'El tamaño de :attribute debe ser :size kilobytes.',
    'string'  => ':attribute debe contener :size carácateres.',
    'array'   => ':attribute debe contener :size elementos.',
  ],
  'string'               => 'El campo :attribute debe ser una cadena de carácateres.',
  'timezone'             => 'El :attribute debe ser una zona válida.',
  'unique'               => ':attribute ya ha sido registrado.',
  'url'                  => 'El formato :attribute es inválido.',

  /*
  |--------------------------------------------------------------------------
  | Custom Validation Language Lines
  |--------------------------------------------------------------------------
  |
  | Here you may specify custom validation messages for attributes using the
  | convention "attribute.rule" to name the lines. This makes it quick to
  | specify a specific custom language line for a given attribute rule.
  |
  */

  'custom'               => [

    /*
    |-----------------------------------------------
    | Example:
    |----------------------------------------------- 
    |
    | 'attribute-name' => [
    |     'rule-name' => 'custom-message',
    | ],
    |
    */
    'email' => [
      'required'      => 'Por favor, introduzca su correo electrónico.',
      'email'         => 'El correo electrónico es inválido.',
      'max'           => 'El correo electrónico no puede tener más de :max carácteres.',
      'unique'        => 'El correo introducido ya existe.'
    ],

    'password' => [
      'required'      => 'Por favor, introduzca una contraseña. ',
      'confirmed'     => 'La confirmación de la contraseña no coincide.',
      'min'           => 'La contraseña debe tener al menos :min carácteres.'
    ],

    'name' => [
      'required'      => 'Por favor, introduzca su nombre.',
      'min'           => 'El nombre debe tener al menos :min carácteres.',
      'max'           => 'El nombre no puede tener más de :max carácateres.'
    ],

    'lastname' => [
      'required'      => 'Por favor, introduzca sus apellidos.',
      'min'           => 'El campo apellidos debe tener al menos :min carácteres.',
      'max'           => 'El campo apellidos no puede tener más de :max carácateres.'
    ],

    'phone_lada_id' => [
      'required'      => 'Por favor seleccione el lada de su teléfono.',
      'integer'       => 'Por favor seleccione el lada de su teléfono.',
      'min'           => 'Por favor seleccione el lada de su teléfono.',
      'exists'        => 'El lada es inválido.'
    ],

    'phone_number' => [
      'required'      => 'Por favor, introduzca su número de teléfono.',
      'regex'         => 'Número de teléfono inválido. El campo únicamente puede contener dígitos.'
    ],

    'agree' => [
      'required'      => 'Debe aceptar los términos y condiciones para continuar.',
      'boolean'       => 'Debe aceptar los términos y condiciones para continuar.',
      'accepted'      => 'Debe aceptar los términos y condiciones para continuar.'
    ],

    'url_logo' => [
      'mimes'         => 'El archivo del logotipo debe ser una imagen.'
    ],

    'description' => [
      'required'      => 'Por favor, introduzca una descripción.',
      'min'           => 'La descripción debe tener al menos :min carácteres.',
      'max'           => 'La descripción no puede tener más de :max carácteres.'
    ],

    'fiscal_name' => [
      'required'      => 'Por favor, introduzca la razón social de su empresa.',
      'max'           => 'El campo de la razón social no puede contener más de :max carácteres.'
    ],

    'country_id' => [
      'required'      => 'Por favor seleccione un país.',
      'integer'       => 'Por favor seleccione un país.',
      'min'           => 'Por favor seleccione un país.',
      'exists'        => 'El país seleccionado es inválido.'
    ],

    'state' => [
      'required'      => 'Por favor, introduzca su estado.',
      'max'           => 'El nombre del estado no puede tener más de :max carácteres.'
    ],

    'city' => [
      'required'      => 'Por favor, introduzca su ciudad.',
      'max'           => 'El nombre de la ciudad no puede tener más de :max carácteres.'
    ],

    'aem_chapter_id' => [
      'required'      => 'Por favor, seleccione a que capítulo AEM pertenece.',
      'integer'       => 'Por favor, seleccione a que capítulo AEM pertenece.',
      'min'           => 'Por favor, seleccione a que capítulo AEM pertenece.',
      'exists'        => 'Capítulo AEM inválido.'
    ],

    'address' => [
      'required'      => 'Por favor, introduzca una dirección.',
      'max'           => 'La dirección no puede tener más de :max carácteres.'
    ],

    'codepostal' => [
      'required'      => 'Por favor, introduzca un código postal',
      'size'          => 'El tamaño del código postal debe ser de 5 carácteres.'
    ],

    'url_website' => [
      'url'           => 'La URL de su sitio web es inválida.'
    ],

    'sector_id' => [
      'required'      => 'Por favor, seleccione el sector de su empresa.',
      'integer'       => 'Por favor, seleccione el sector de su empresa.',
      'min'           => 'Por favor, seleccione el sector de su empresa.',
      'exists'        => 'Sector inválido.'
    ],

    'enterprise_type_id' => [
      'required'      => 'Por favor, seleccione el tipo de empresa.',
      'integer'       => 'Por favor, seleccione el tipo de empresa.',
      'min'           => 'Por favor, seleccione el tipo de empresa.',
      'exists'        => 'Tipo de empresa inválido.'
    ],

    'enterprise_num_employees_id' => [
      'required'      => 'Por favor, seleccione el número de empleados',
      'num_employees' => 'La opción seleccionada es inválida.'
    ],

    'year_established' => [
      'required'      => 'Por favor, elija una fecha.',
      'date_format'   => 'El formato de la fecha no es válido.',
      'before'        => 'Aún no ha pasado la fecha seleccionada.'
    ],

    'products' => [
      'required'      => 'Por favor, introduzca los productos o servicios que provee su empresa.'
    ],

    'role_id' => [
      'required'      => 'Por favor, elija una opción.',
      'in'            => 'La opción seleccionada es inválida.',
      'exists'        => 'La opción seleccionada es inválida.'
    ],

    'schedule' => [
      'empty'         => 'Debe agregar al menos un horario.'
    ],

    'day.*.from' => [
      'required'      => 'Por favor, introduzca la hora de inicio.',
      'custom_hour'   => 'Formato inválido en la hora de inicio.',
      'arr_hour_lt'       => 'La hora de inicio debe ser menor a la hora de finalización.'
    ],

    'day.*.to' => [
      'required'      => 'Por favor, introduzca la hora de finalización.',
      'custom_hour'   => 'Formato inválido en la hora de finalización.'
    ]

  ],

  /*
  |--------------------------------------------------------------------------
  | Custom Validation Attributes
  |--------------------------------------------------------------------------
  |
  | The following language lines are used to swap attribute place-holders
  | with something more reader friendly such as E-Mail Address instead
  | of "email". This simply helps us make messages a little cleaner.
  |
  */

  'attributes' => [
    'name'              => 'nombre',
    'password'          => 'contraseña',
    'type'              => 'tipo' 
  ],

];
