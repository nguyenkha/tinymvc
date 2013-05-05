<?php
class Controller {
  protected $_request;

  protected $_response;

  protected $_view;

  protected $_autoRender = true;

  public function __construct($request, $response) {
    $this->_request = $request;
    $this->_response = $response;
    # Shortcut
    $this->_view = $response->getView();
  }

  public function getRequest() {
    return $this->_request;
  }

  public function getResponse() {
    return $this->_response;
  }

  public function autoRender($controller, $action) {
    if ($this->_autoRender) {
      $this->_response->render($controller . '/' . $action);
    }
  }

  # Controller helper function here
}