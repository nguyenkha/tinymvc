<?php
require_once 'Controller.php';

class IndexController extends Controller {
  function indexAction() {
    // Disable auto render
    // $this->_autoRender = false;
    $this->_view->layout->title = 'Tiny MVC framework for PHP';
    $this->_view->message = 'Hello world';
    // $this->_view->render('index/index');
  }
}