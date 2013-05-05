<?php
class View
{
  private $_viewPath;

  private $_defaultLayout = 'layout';

  private $_suffix = '.php';

  private $_data = array();

  private $_layout = null;

  public function __construct($viewPath) {
    $this->_viewPath = $viewPath;
    $this->layout = new stdClass();
  }

  public function __get($name) {
    if (array_key_exists($name, $this->_data)) {
      return $this->_data[$name];
    }
    return null;
  }

  public function __set($name, $value) {
    $this->_data[$name] = $value;
  }

  public function setViewPath($path) {
    $this->_viewPath = $path;
  }

  public function renderPartial($file) {
    # Start output buffer
    ob_start();
    # Render template
    include $this->_viewPath . '/' . $file . $this->_suffix;
    # Get result
    $result = ob_get_contents();
    # Clean buffer
    ob_end_clean();
    return $result;
  }

  public function render($file) {
    # Render default layout
    if (!$this->_layout) {
      $this->_layout = $this->_defaultLayout;
    }
    # Render partial
    $this->layout->content = $this->renderPartial($file);
    # Render layout
    return $this->renderPartial($this->_layout);
  }

  public function setLayout($layout) {
    $this->_layout = $layout;
  }

  # View helper function here
}