<?php
abstract class Controller_Base {
	protected $registry;
	static protected $current_user;

	function __construct() {
		$this->registry = MVC_Registry::getReg();

//		$user = Domain_User::loadFromCookie();
		
		// Check for user. If no authenticated user, redirect to login
//		if( !$user->isValidUser() && $_GET['r'] != 'login' ){
//			$this->redirect('index.php?r=login');
//		}else{
//			$this->registry['current_user'] = $user;
//			self::$current_user = $user;
//		}
	}

	abstract function index();

	/**
	 * Login action, inherited by all classes. 
	 */
	function login(){

		// If no posted username, password, and no session stored username, present login screen
		if (is_null($_POST['user']) && is_null($_POST['encpass']) && is_null($_COOKIE['username'])){
			$this->registry['template']->show('login');
			exit();
		}

		// If username and password posted, check for authorization
		if (isset($_POST['user']) && isset($_POST['encpass'])){

			$user = new Domain_User($_POST['user'], $_POST['encpass']);

			// If username and password are correct, create session variable "username"
			if( $user->isValidUser() ){
				setcookie('username', $user->getUsername(), time()+60*60*24*30 );
				redirect('index.php');
				exit;
			// If not, present login screen again (with last given username in username box)
			}else{
				$this->registry['template']->set('username', $_POST['user']);
				$this->registry['template']->show('login');
				exit();
			}
		}
		redirect('index.php');
	}

	function logout(){
		setcookie('username', '', time() - 3600);
		redirect('index.php');
	}

	function redirect($to) {
		header("Location: $to");
		exit ();
	}
}
