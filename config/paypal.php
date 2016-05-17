<?php

return [

  /*
   * PayPal Credential
   */
  'CLIENT_ID' => 'AUZ9-Z022PfBcd0PT5TLhB2ffOjn1iw1Ie8Y7IidoctRzbGuUYBzSb2CLseiDdl_q7N6F4toKPek3Lhz',
  'SECRET'    => 'EJXte6tE6s42X-h4VT7AOG89WLfKnbLkxkQOXkECXtnxcvp1ejxFRqXctvKnGQhmg5OZOzHqV_3NPFBL',

  // SDK Config
  'settings'  => [

    // Available option "sandbox" or "live".
    'mode'                      =>  'sandbox',

    // Max request time in seconds.
    'http.ConnectionTimeOut'    =>         30,

    // Whether want to log to a file
    'log.LogEnabled'            =>       true,

    // Specify the file that want to write on
    'log.FileName'              => storage_path() . '/logs/paypal.log',

    // Available option "FINE", "INFO", "WARN" or "ERROR".
    // Logging is most verbose in the "FINE" level and decreases as you
    // proceed towards ERROR.
    'log.LogLevel'              =>     'FINE',

  ]

];