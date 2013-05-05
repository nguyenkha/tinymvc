<?php
require_once 'Controller.php';

class IndexController extends Controller {
   function indexAction() {
    $this->_view->layout->title = 'Tiny MVC framework for PHP';
    $this->_view->message = 'Hello world';
  }
}