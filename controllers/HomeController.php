<?php
/**
 * HomeController
 * Author: Md. Shahriar Hosen <cse.shahriar.hosen@gmail.com>
 */
class HomeController extends Controller
{
	public function index()
	{
		$this->view('welcome');   
	}
}