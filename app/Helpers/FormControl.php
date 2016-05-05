<?php
  // Archivo: FormControl.php
  // Ubicación: App/Helpers/FormControl.php
  // Descripción: Implementa los componentes de interfaz 
  // de usuario necesarios para la creación de formularios.

  function getCountriesOptions()
  {
    return config('variables.countries');
  }

  function getLadaOptions()
  {
    return config('variables.lada');
  }

  function getSectorOptions()
  {
    return config('variables.sector');
  }

  function getNumEmployeesOptions()
  {
    return config('variables.num_employees');
  }

  function getEnterpriseTypeOptions()
  {
    return config('variables.enterprise_type');
  }

  function getRegisterAsOptions()
  {
    return config('variables.register_as');
  }

  function getAEMType()
  {
    return config('variables.aem_type');
  }

?>