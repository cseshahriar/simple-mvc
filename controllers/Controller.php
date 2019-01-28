<?php 
/**
 * Base Controller 
 * Author: Md. Shahriar Hosen <cse.shahriar.hosen@gmail.com>
 */
class Controller
{	
	/**
	 * @param  [model file]
	 * @return [object]
	 */
	public function model($model)
	{
		// require model file
		require_once '../models/'.$model.'.php';  

		// instantiate model 
		return new $model();  // return a obj 
	}

	/**
	 * @param  [view file]
	 * @param  data array
	 * @return [view file with data array]
	 */
	public function view($view, $data = []) 
	{
		// check for the view file 
		if (file_exists('./views/'.$view.'.php')) {
			require_once './views/'.$view.'.php';  
		} else {
			// Views does not exist 
			die('View does not exists');  
		}
	}

	/**
	 * [isLoggedInUser description]
	 * @return boolean [description]
	 */
	public function isLoggedInUser()
	{
		if (!isset($_SESSION['user_id'])) {     
			header("Location: /user/login");       
		} 
	}

	/**
	 * [redirect description] 
	 * @param  [type] $route [description]
	 * @return [type]        [description]
	 */
	public function redirect($route) {
		header('Location: '.ROOTURL.'/'.$route);      
		exit();  
	} 

}