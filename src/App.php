<?php

namespace Upsite;

class App {
  
  public $config;

  public $router;

  public function __construct(?string $configPath = null)
  {
    $this->config = new Config($configPath);
    $this->router = new Router($this->config);
  }
  
  public function start()
  {
    $this->router->handle();
  }
}