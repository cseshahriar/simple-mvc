<?php 

// Helpers Functions
session_start(); 

// App Info 
require_once '../config/config.php';   

/**
 * [flash message]
 * @param  string $name    [message for what]
 * @param  string $message [message text]
 * @param  string $class   [bootstrap class]
 * @return [type] string   [message]
 */
  function flash($name = '', $message = '', $class = 'alert alert-success') {  
    if(!empty($name)) { // if have name
      if(!empty($message) && empty($_SESSION[$name])) { // if have message and empty sessaion name
        if(!empty($_SESSION[$name])) { // is have session message name  
          unset($_SESSION[$name]); // unset 
        }

        if(!empty($_SESSION[$name. '_class'])){
          unset($_SESSION[$name. '_class']);
        }

        $_SESSION[$name] = $message;
        $_SESSION[$name. '_class'] = $class;
      } elseif(empty($message) && !empty($_SESSION[$name])){
        $class = !empty($_SESSION[$name. '_class']) ? $_SESSION[$name. '_class'] : '';
        echo '<div class="'.$class.'" id="msg-flash">'.$_SESSION[$name].'</div>';
        unset($_SESSION[$name]);
        unset($_SESSION[$name. '_class']);
      }
    }
  }

 // check user is logged in
function isLoggedIn() 
{
	if (isset($_SESSION['user_id'])) { 
	  return true;
	} else {
	  return false;   
	}
}   

// Simple page redirect
function redirect($page)
{
	header("Location: ".URLROOT.'/'.$page); 
} 