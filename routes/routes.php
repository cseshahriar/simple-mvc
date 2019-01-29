<?php 

// Routes 
$routes = array();  

// Default Routes
$routes['home'] = "HomeController/index";  

// User routes 
$routes['user/dashboard'] = "UsersController/dashboard";

$routes['user/index'] = "UsersController/index";    
$routes['user/register'] = "UsersController/register";          
$routes['user/edit'] = "UsersController/edit";       
$routes['user/update'] = "UsersController/update";      
$routes['user/delete'] = "UsersController/delete";     

$routes['user/login'] = "UsersController/login";      
$routes['user/logout'] = "UsersController/logout";        