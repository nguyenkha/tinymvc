<?php
class Request {
  # Get query param or all
  public function getQuery($name = null, $default = null) {
    if ($name === null) {
      return $_GET;
    }
    if (array_key_exists($name, $_GET)) {
      return $_GET[$name];
    }
    return $default;
  }

  # Get post param or all
  public function getPost($name = null, $default = null) {
    if ($name === null) {
      return $_POST;
    }
    if (array_key_exists($name, $_POST)) {
      return $_POST[$name];
    }
    return $default;
  }

  # Check if request is post
  public function isPost() {
    return !empty($_POST);
  }
}