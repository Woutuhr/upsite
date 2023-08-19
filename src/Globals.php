<?php

namespace Upsite;

class Globals
{
  private $data;

  public function __construct(array $data)
  {
    $this->data = $data;
  }

  public function get(string $prop)
  {
    return $this->data[$prop] ?? null;
  }
}