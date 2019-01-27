<?php 

// Routes 
$routes = array(); 

// Default Routes
$routes['home'] = "HomeController/index"; 

// Admin Controllers
$routes['user/index'] = "UsersController/index";       
$routes['user/register'] = "UsersController/register";   
$routes['user/login'] = "UsersController/login";      