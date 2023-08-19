<?php

namespace Upsite\Exceptions;

class ViewNotFoundException extends \Exception
{
  public function __construct(string $name)
  {
    parent::__construct("View $name could not be found");
  }
}