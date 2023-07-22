<?php

namespace Upsite;

class Request
{
  public $method;

  public $path;

  public $getParams = [];

  public static function captureCurrent(): self
  {
    $instance = new self();

    $requestParts = explode("?", $_SERVER['REQUEST_URI']);

    $instance->method = $_SERVER['REQUEST_METHOD'];
    $instance->path = $requestParts[0];
    $instance->getParams = $_GET;

    return $instance;
  }
}