<?php

  // Archivo: SearchControl.php
  // Ubicación: App/Helpers/SearchControl.php
  // Descripción: Implementa una variedad de
  // métodos de búsqueda en diversos contextos.

  function arrayGetParentName($x, array $array){
    $q = [
      ['parent' => '{root}', 'content' => $array]
    ];

    while( count($q) )
    {
      $n = count($q);

      for($i = 0; $i < $n; ++$i)
      {
        $tmp = current($q);
        
        if( is_array($tmp['content']) ) 
        {
          foreach( $tmp['content'] as $key => $value )
          {
            if( $x === $key )
            {
              return $tmp['parent'];
            }
            array_push($q, [
              'parent'    => ( is_numeric($key) ? $tmp['parent'] : $key ), 
              'content'   => $tmp['content'][$key]
            ]);
          }
        } 
        else if( $x === $tmp['content'] )
        {
          return $tmp['parent'];
        }
        array_shift($q);
      }
    }
    return null;
  }