<?php
class Database {
  private static $_config;

  private static $_instance = null;

  public static function setConfig($config) {
    self::$_config = $config;
  }

  public static function getInstance() {
    if (self::$_instance === null) {
      # Connect to database
      $config = self::$_config;
      self::$_instance = new PDO('mysql:host=' . $config['host'] . ';port=' . $config['port'] . ';dbname=' . $config['dbname'] . ';charset=utf8', $config['user'], $config['password']);
    }
    return self::$_instance;
  }
}
