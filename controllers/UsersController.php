<?php 
require_once 'Controller.php'; 
require_once './models/User.php';   
require_once './lib/Helpers.php';   
/**
 * 
 */
class UsersController  extends Controller
{
	private $userModel;  

	public function __construct()   
	{
		$this->userModel = new User();        
	}

	public function index()
	{ 
		/* if (!isLoggedIn()) {    
			header("Location: /user/login");     
		} */ 

		$users = $this->userModel->users();  
		$data = [
			'users' => $users
		];  
		$this->view('backend/users/index', $data);         
	}

	public function register() 
	{
		/* if (!isLoggedIn()) {     
			header("Location: /users/login");     
		} */

		// Check for POST
		if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
			// process form 
			
			// sanitize post data
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING); 

			// init data 
			$data = [ 
				'name' => trim($_POST['name']),
				'email' => trim($_POST['email']), 
				'password' => trim($_POST['password']),
				'confirm_password' => trim($_POST['confirm_password']),
				'name_error' => '',
				'email_error' => '',
				'password_error' => '',
				'confirm_password_error' => '', 
			];

			// validte name
			if (empty($data['name'])) {
				$data['name_error'] = 'Name is required.';
			}  

			// validate email 
			if (empty($data['email'])) {
				$data['email_error'] = 'Email is required.';
			} else {
				// valid email address 
				if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
					$data['email_error'] = 'Invalid Email Address.'; 
				}
				// already exist 
				if ($this->userModel->findUserByEmail($data['email'])) {
					$data['email_error'] = 'Email is aready taken.';
				} 
			}

			//validate password 
			if (empty($data['password'])) {
				$data['password_error'] = 'Password is required.';
			} elseif(strlen($data['password']) < 6) {
				$data['password_error'] = 'Password must be at least 6 characters.';
			}

			// conf password 
			if (empty($data['confirm_password'])) {
				$data['confirm_password_error'] = 'Confirm Password is required.'; 
			} else {
				if ($data['password'] != $data['confirm_password'] ) {
					$data['confirm_password_error'] = 'Password did not match.';   
				}
			}
 
			// Makes sure errors are empty 
			if ( empty($data['name_error']) && empty($data['email_error']) && empty($data['password_error']) && empty($data['confirm_password_error'])) {
		
				// Hash Password 
				$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT); 

				// Register User
				if($this->userModel->register($data)) { // receive true/false 
					flash('register_success', 'You are registered and can log in');                    
				} else {
					die('Something went wrong!'); 
				} 
			} else {
				// load view with errors 
				$this->view('backend/users/register', $data);     
			}


		} else {  // if post not submit 
			// init data
			$data = [
				'name' => '',
				'email' => '', 
				'password' => '',
				'confirm_password' => '',
				'name_error' => '',
				'email_error' => '',
				'password_error' => '',
				'confirm_password_error' => '',   
			];

			// load view 
			$this->view('backend/users/register', $data);     
		}
	}

	public function update()
	{
		if (!isLoggedIn()) {    
			header("Location: /users/login");     
		} 
	}

	public function delete()  
	{
		if (!isLoggedIn()) {    
			header("Location: /users/login");      
		} 
	}

	public function login() 
	{
		// Check for POST
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			# process form 
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING); 

			// init data 
			$data = [
				'email' => trim($_POST['email']), 
				'password' => trim($_POST['password']),
				'name_error' => '',
				'email_error' => '',
				'password_error' => ''
			];

			// validate email 
			if (empty($data['email'])) {
				$data['email_error'] = 'Email is required.';
			} else {
				if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
					$data['email_error'] = 'Invalid Email Address.'; 
				} 

				// check for user/email exists 
				if ($this->userModel->findUserByEmail($data['email'])) {
					// user found
				} else {
					$data['email_error'] = 'User not found!'; 
				}
			}


			//validate password 
			if (empty($data['password'])) {
				$data['password_error'] = 'Password is required.';
			} elseif(strlen($data['password']) < 6) {
				$data['password_error'] = 'Password must be at least 6 characters.';
			} 

			// Makes sure errors are empty 
			if (empty($data['email_error']) && empty($data['password_error'])) {
				// validated 
				// check and set logged in user
				$loggedInUser = $this->userModel->login($data['email'], $data['password']); 
				if ($loggedInUser) {
					
					// create session
					$this->createUserSession($loggedInUser);

				} else {
					$data['password_error'] = 'Incorrect password!';
					$this->view('/users/login', $data);  
				}
			} else {
				// load view with errors 
				$this->view('/users/login', $data);    
			}

		} else { 
			// init data
			$data = [
				'email' => '', 
				'password' => '',
				'email_error' => '',
				'password_error' => '',
			];

			// load view 
			$this->view('users/login', $data);    
		}
	}

	/**
	 * [createUserSession description]
	 * @param  [type] $user [description]
	 * @return [type]       [description]
	 */
	public function createUserSession($user)
	{
		$data = [];
		$_SESSION['user_id'] = $user->id;
		$_SESSION['user_name'] = $user->name;
		$_SESSION['user_email'] = $user->email;

		flash('login_success', 'Welcome, you are successfuly logged in.');   
		redirect('user/index');                  
	}


	public function logout()    
	{
		$data = [
			'email' => '',
			'password' => ''        
		];   

		unset($_SESSION['user_id']);
		unset($_SESSION['user_name']);
		unset($_SESSION['user_email']);
		session_destroy();

		flash('logout_success', 'You are now logged out.');
		redirect('user/login');         
	} 

	public function isLoggedIn() 
	{
		if (isset($_SESSION['user_id'])) {
			return true;
		} else {
			return false;   
		}
	}   
}