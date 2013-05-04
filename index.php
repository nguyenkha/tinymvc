<?php
# Set application path
define('APPLICATION_PATH', __DIR__);

# Add require path
set_include_path(get_include_path() . ';' . APPLICATION_PATH . '/library');

# Require class
require_once 'View.php';
require_once 'Database.php';
require_once 'Request.php';
require_once 'Response.php';

# Read config file
$config = require_once 'config.php';

# Set view path
View::setViewPath(APPLICATION_PATH . '/views');

# Set database config
Database::setConfig($config['db']);

# Create request and response object
$request = new Request();
$response = new Response();

# Parse controller and action name
$controllerName = $request->getQuery('controller', 'index');
$actionName = $request->getQuery('action', 'index');

# Create controller
$controllerClass = ucfirst($controllerName) . 'Controller';
require_once APPLICATION_PATH . '/controllers/' . $controllerClass . '.php';
$controller = new $controllerClass();

# Process request
$actionMethod = $actionName . 'Action';
$controller->$actionMethod($request, $response);

# Get render result
$result = $response->getResult();

# Echo result
echo $result;