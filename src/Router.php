<?php

namespace Upsite;

class Router
{
  public $request;

  private $config;

  public function __construct(Config $config)
  {
    $this->config = $config;
  }

  public function handle()
  {
    $this->request = Request::captureCurrent();

    if(array_key_exists($this->request->path, $this->config->getRoutes()))
    {
      $routeConf = $this->config->getRoutes()[$this->request->path];

      $view = new View($routeConf["view"], $routeConf, $this->config);
      $view->render();

      return;
    }

    // TODO add better handeling
    die('404');

  }
}
