<?php

// include routes 
require_once 'routes/routes.php'; 

// controller auto load 
spl_autoload_register(function($className) {
	require_once 'controllers/'.$className.'.php';   
});

// Get Route 
$url = $_GET['route']; // route from index.php by .htaccess 

// base route 
if ($url === '') {
	$url = 'home'; 
}

// user request store in routes array 
$mappedString = $routes[$url]; 

if ($mappedString == null) {
	require_once 'views/404.php';
	die(); 
}

// slice mapped string for taking controller and methods 
$parts = explode("/", $mappedString);
$className = $parts[0];
$methodName = $parts[1];
$controllerObject = new $className;
$controllerObject->{ $methodName }(); // dynamicly method invoke 

