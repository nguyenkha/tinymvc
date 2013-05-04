<?php
require_once 'View.php';

class Response {
  private $_result = '';

  # Shortcut
  public function render($file, $data = null, $layout = null) {
    $this->_result = View::render($file, $data, $layout);
  }

  # Shortcut
  public function renderPartial($file, $data = null) {
    $this->_result = View::renderPartial($file, $data);
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