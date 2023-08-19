<?php

namespace Upsite;

class View
{
  private $data;

  private $viewName;

  private $viewsDir;
  
  private $useLayout = true;

  private $config;

  public function __construct(string $viewName, array $data, ?Config $config = null)
  {
    $this->data = $data;
    $this->config = $config;
    $this->viewName = $viewName;
    $this->viewsDir = $_SERVER["DOCUMENT_ROOT"] . "/" . "views";
  }

  public function render()
  {
    $data = array_merge($this->data, [
      "globals" => $this->config->getGlobals(),
      "components" => $this->config->getComponents()
    ]);

    foreach($data as $key => $val)
    {
      $$key = $val;
    }

    $content = static::getViewContent($this->getViewPath($this->viewName). ".php", $data, true);

    if($this->useLayout)
    {
      require $this->getViewPath("layout.php");
    } else {
      echo $content;
    }
  }

  public function getViewPath(string $path)
  {
    return $this->viewsDir . "/" . $path;
  }

  public static function getViewContent(string $path, array $data = [], $debug = false)
  {
    ob_start();
    foreach($data as $key => $val)
    {
      $$key = $val;
    }

    require $path;
    return ob_get_clean();
  }
}