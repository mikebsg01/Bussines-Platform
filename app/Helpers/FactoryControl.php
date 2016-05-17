<?php
  // Archivo: FactoryControl.php
  // Ubicación: App/Helpers/FactoryControl.php
  // Descripción: Implementa funciones para 
  // fabricar registros ficticios.

  function gNumberStringRandom($n) {
    $x = "";
    for ($i = 0; $i<$n; ++$i) 
    {
        $x .= mt_rand(0,9);
    }
    return $x;
  }