<?php
class Request {
  private $_params = array();

  private function _getValue($array, $name, $default = null) {
    if ($name === null) {
      return $array;
    }
    if (array_key_exists($name, $array)) {
      return $array[$name];
    }
    return $default;
  }

  # Get query param or all
  public function getQuery($name = null, $default = null) {
    return $this->_getValue($_GET, $name, $default);
  }

  # Get post param or all
  public function getPost($name = null, $default = null) {
    return $this->_getValue($_POST, $name, $default);
  }

  public function getParam($name = null, $default = null) {
    return $this->_getValue($this->_params, $name, $default);
  }

  public function setParam($name, $value) {
    $this->_params[$name] = $value;
  }

  # Check if request is post
  public function isPost() {
    return !empty($_POST);
  }

  # Routing request
  public function route() {
    # Default router
    $this->setParam('controller', $this->getQuery('controller', 'index'));
    $this->setParam('action', $this->getQuery('action', 'index'));
  }
}