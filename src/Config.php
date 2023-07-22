<?php

namespace Upsite;

class Config {

  const DEFAULT_CONFIG_PATH = "upsiteConfig.json";

  private $path;

  private $routes;

  private $globals;

  private $components;

  public function __construct(?string $path)
  {
    $this->path = $_SERVER['DOCUMENT_ROOT'] . "/" . ($path ?? static::DEFAULT_CONFIG_PATH);
    $this->load();
  }

  private function load()
  {
    $configContent = file_get_contents($this->path);
    $config = json_decode($configContent, true);
    
    foreach($config as $prop => $val)
    {
      if(property_exists($this, $prop))
      {
        $this->$prop = $val;
      }
    }
  }

  public function getRoutes()
  {
    return $this->routes;
  }

  public function getGlobals()
  {
    return $this->globals;
  }

  public function getComponents()
  {
    return $this->components;
  }
}