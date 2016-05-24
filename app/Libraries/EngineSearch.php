<?php 
  
namespace App\Libraries;


class EngineSearch {

  public $model;
  public $paginate;
  public $query;
  public $filters;
  public $request;
  public $filterNames;
  public $results;

  public function __construct(array $search)
  {
    $this->model = new $search['model']();
    $this->paginate = $search['paginate'];
    $this->request = $search['request'];
    $this->query = $search['query'];
    $this->filterNames = [];
    $this->filters = (object) [];

    foreach($search['filters'] as $filter => $params)
    {
      array_push($this->filterNames, $filter);
      $obj = new $params['class']();

      $this->filters->{$filter} = (object) [
        'name'      => $filter,
        'alias'     => $params['alias'],
        'options'   => $obj->getOptions(),
        'values'    => $this->request->input($params['alias'])
      ];
    }

    $this->results = $this->model->search($this->query, $this->filters);
  }

  public function getResults()
  {
    return $this->results->paginate($this->paginate);
  }

  public function getNumRows()
  {
    return $this->results->count();
  }

  public function getFilterNames() 
  {
    return $this->filterNames;
  }

  public function getFilterOptions($filterName)
  {
    return $this->filters->{$filterName}->options;
  }

  public function getAlias($filterName)
  {
    return $this->filters->{$filterName}->alias;
  }

  public function filterOptionIsChecked($filterName, $val)
  {
    $alias = $this->getAlias($filterName);

    if (is_null($this->request->input($alias)))
    {
      return false;
    } 
    else 
    {
      return in_array($val, $this->request->input($alias));
    }
  }

  public function getParameters()
  {
    $parameters = [
      'q' => $this->query
    ];

    foreach($this->getFilterNames() as $filterName)
    {
      $alias  = $this->getAlias($filterName);
      $params = $this->request->input($alias);

      if (is_array($params)) {
        $tmp_n = count($params);

        for ($i = 0; $i < $tmp_n; ++$i) 
        {
          $type = null;

          if ($alias == 's')
          {
            $type = 'sectors';
          }
          else if ($alias == 'c') 
          {
            $type = "countries";
          }
          else if ($alias == 'a') 
          {
            $type = "aem_chapters";
          }
          else if ($alias == 'status')
          {
            $type = 'enterprise_status';
          }

          $params[$i] = txti18n($type, $params[$i]);
        }
      }
      
      $parameters[$alias] = $params ?: [];
    }

    return $parameters;
  }

  public function getParametersToString()
  {
    $str  = "";
    $i    = 0;

    foreach($this->getParameters() as $param)
    {
      if (is_array($param))
      {
        $j = 0; 
        $n = count($param);

        if ($n > 0)
        {
          if ($i > 0)
          {
            $str .= " > "; 
          }

          $str .= $param[0];
        }

        for ($j = 1;  $j < $n; ++$j)
        {
          $str .= ", " . $param[$j];
        }
      }
      else if (is_string($param))
      {
        if ($i > 0) 
        {
          $str .= " > ";
        }

        $str .= $param;
      }

      ++$i;
    }
    return $str;
  }

}