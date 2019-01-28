<?php
require_once 'Database.php';  
/**
 * User Model 
 */
class User extends Database 
{
	private $db;
	
	public function __construct() 
	{
		$this->db = new Database; 
	}

	/**
	 * [findUserByEmail description]
	 * @param  [type] $email [description]
	 * @return [type] true   [description]
	 */
	public function findUserByEmail($email) 
	{
		$this->db->query('SELECT * FROM users WHERE email = :email'); 
		$this->db->bind(':email', $email); 

		$row = $this->db->single(); 
		
		// check row 
		if ($this->db->rowCount() > 0) {
			return true;
		} else {
			return false; 
		}
	}


	public function register($data)
	{
		$this->db->query('INSERT INTO users(name,email,password) VALUES(:name,:email,:password)');
		// Bind values
		$this->db->bind(':name', $data['name']);
		$this->db->bind(':email', $data['email']);
		$this->db->bind(':password', $data['password']);
		// Execute
		if($this->db->execute()) {
			return true;
		} else {
			return false;  
		}
	} 

	/**
	 * [login description]
	 * @param  [string] $email    [description]
	 * @param  [string] $password [description]
	 * @return [true/false]           [description]
	 */
	public function login($email, $password)
	{
		$this->db->query('SELECT * FROM users WHERE email = :email'); 
		$this->db->bind(':email', $email);
		$row = $this->db->single();

		$hashPasswordd = $row->password; 
		if (password_verify($password, $hashPasswordd)) {
			return $row;
		} else {
			return false;  
		}
	}

	/**
	 * [getUserById description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */ 
	public function getUserById($id)
	{
		$this->db->query('SELECT * FROM users WHERE id = :id'); 
		$this->db->bind(':id', $id);
		$row = $this->db->single(); 
		return $row; 	 
	}

	public function users()
	{
		$this->db->query('SELECT * FROM users'); 
		$rows = $this->db->get(); 
		return $rows;  
	}

	public function delete($id) 
	{
		$this->db->query('DELETE FROM users WHERE id=:id');
		$this->db->bind(':id', $id); 
		if ($this->db->execute()) {
			return true;
		} else {
			return false;  
		}
	}


}