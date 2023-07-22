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
    $data = array_merge($this->data, $this->config->getGlobals());
    foreach($data as $key => $val)
    {
      $$key = $val;
    }

    $content = $this->getViewContent($this->getViewPath($this->viewName). ".php");

    if($this->useLayout)
    {
      require $this->getViewPath("layout.php");
    } else {
      echo $content;
    }
  }

  public function getViewContent(string $path)
  {
    require $path;
    return ob_get_clean();
  }

  public function getViewPath(string $path)
  {
    return $this->viewsDir . "/" . $path;
  }
}