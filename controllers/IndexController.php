<?php
class IndexController {
  public function indexAction($req, $res) {
    // $res->redirect('http://fb.me');
    $res->render('index.php', array('foo' => 'Hello world'));
  }
}