<?php
  // Archivo: DateTimeControl.php
  // Ubicación: App/Helpers/DateTimeControl.php
  // Descripción: Implementa los componentes de interfaz 
  // de usuario necesarios para la creación de formularios
  // con manejo de fechas u horas.

use Carbon\Carbon;

function getDaysOfTheWeek()
{
  return config('variables.days');
}

function createDateFromFormat($str, $format)
{
  return Carbon::createFromFormat($format, $str);
}

function getDateFormat(Carbon $date, $format)
{
  return $date
          ->setTimezone('America/Mexico_City')
          ->format($format);
}

?>