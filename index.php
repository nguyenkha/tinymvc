<?php
# Set application path
define('APPLICATION_PATH', __DIR__);

# Add require path
set_include_path(get_include_path() . ';' . APPLICATION_PATH . '/library;'. APPLICATION_PATH . '/models');

# Require class
require_once 'functions.php';
require_once 'Database.php';
require_once 'Request.php';
require_once 'Response.php';

# Read config file
$config = require_once 'config.php';
define('BASE_URL', $config['baseUrl']);

# Start session
session_start();

# Set database config
Database::setConfig($config['db']);

# Create request and response object
$request = new Request();
$response = new Response();

# Routing request
$request->route();

# Get controller and action name
$controllerName = $request->getParam('controller');
$actionName = $request->getParam('action');

# Create controller
$controllerClass = dashToCamelCase($controllerName, true) . 'Controller';
$controllerPath = APPLICATION_PATH . '/controllers/' . $controllerClass . '.php';

# Check if file exist
if (!file_exists($controllerPath)) {
  $response->fileNotFound();
} else {
  # Require file
  require_once $controllerPath;

  # Check if class exist
  if (!class_exists($controllerClass)) {
    $response->fileNotFound();
  } else {
    $controller = new $controllerClass($request, $response);

    # Process request
    $actionMethod = dashToCamelCase($actionName, false) . 'Action';

    # Check if action exist
    if (!method_exists($controller, $actionMethod)) {
      $response->fileNotFound();
    } else {
      $controller->$actionMethod();
      # Auto render base on controller and action
      $controller->autoRender($controllerName, $actionName);
    }
  }
}

# Get render result
$result = $response->getResult();

# Echo result
echo $result;
