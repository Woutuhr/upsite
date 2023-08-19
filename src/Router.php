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

    if($routeConf = $this->getCurrentRoute())
    {
      $viewData = array_merge(["title" => $routeConf["title"]], $routeConf["data"] ?? []);

      $view = new View($routeConf["view"], $viewData, $this->config);
      $view->render();

      return;
    }

    // TODO add better handeling
    die('404');

  }

  private function getCurrentRoute(): bool|array
  {
    if(!array_key_exists($this->request->path, $this->config->getRoutes()))
    {
      return false;
    }

    return $this->config->getRoutes()[$this->request->path];
  }
}
