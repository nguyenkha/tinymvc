<?php
require_once 'View.php';

class Response {
  private $_result = '';

  private $_view;

  # Create view object
  public function __construct() {
    $this->_view = new View(APPLICATION_PATH . '/views');
  }

  # Get view object
  public function getView() {
    return $this->_view;
  }

  # Shortcut
  public function render($file, $layout = null) {
    $this->_result = $this->_view->render($file, $layout);
  }

  # Shortcut
  public function renderPartial($file) {
    $this->_result = $this->_view->renderPartial($file);
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
    exit(0);
  }

  # Error 404
  public function fileNotFound() {
    http_response_code(404);
    $this->_view->layout->title = 'File not found';
    $this->render('error/file-not-found');
  }
}
