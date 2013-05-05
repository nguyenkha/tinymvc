<?php
require_once 'View.php';

class Response {
  private $_result = '';

  private $_view;

  # Construct with view
  public function __construct($view) {
    $this->_view = $view;
  }

  # Get view object
  public function getView() {
    return $this->_view;
  }

  # Shortcut
  public function render($file, $data = null, $layout = null) {
    $this->_result = $this->_view->render($file, $data, $layout);
  }

  # Shortcut
  public function renderPartial($file, $data = null) {
    $this->_result = $this->_view->renderPartial($file, $data);
  }

  # Set response content
  public function setResult($data) {
    $this->_result = $data;
  }

  # Get response content
  public function getResult() {
    return $this->_result;
  }

  # Redirect helper
  public function redirect($url) {
    header('Location: ' . $url);
  }

  # Error 404
  public function fileNotFound() {
    $this->render('file-not-found.php');
  }
}