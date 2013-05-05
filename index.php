<?php
# Set application path
define('APPLICATION_PATH', __DIR__);

# Add require path
set_include_path(get_include_path() . ';' . APPLICATION_PATH . '/library');

# Require class
require_once 'functions.php';
require_once 'Database.php';
require_once 'Request.php';
require_once 'Response.php';

# Read config file
$config = require_once 'config.php';
define('BASE_URL', $config['baseUrl']);

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
$controllerClass = underscoreToCamelCase($controllerName, true) . 'Controller';
require_once APPLICATION_PATH . '/controllers/' . $controllerClass . '.php';
$controller = new $controllerClass($request, $response);

# Process request
$actionMethod = underscoreToCamelCase($actionName, false) . 'Action';
$controller->$actionMethod();

# Auto render base on controller and action
$controller->autoRender($controllerName, $actionName);
# Get render result
$result = $response->getResult();

# Echo result
echo $result;