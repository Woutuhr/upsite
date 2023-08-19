<?php

namespace Upsite;

use Upsite\Exceptions\ViewNotFoundException;

class ComponentCollection
{
  private array $config = [];

  private array $components = [];

  public function __construct(?array $config = null)
  {
    if($config)
    {
      $this->config = $config;
    }
  }

  public function load()
  {
    foreach($this->config as $name)
    {
      $this->components[$name] = View::getViewContent($_SERVER["DOCUMENT_ROOT"] . "/views/components/" . $name . ".php"); // TODO add the path form the View class (dynamic)
    }
  }

  public function get(string $name)
  {
    if(in_array($name, $this->config))
    {
      return $this->components[$name];
    }

    throw new ViewNotFoundException($name);
  }
}