<?php

require_once '../config.php';

if( $_SERVER['REQUEST_METHOD']==='POST' ){
	$email = filter_input(INPUT_POST,'email',FILTER_SANITIZE_EMAIL);
	$password = $_POST['password'];
	//$password_repeat = $_POST['repeat'];
	$password_repeat = $_POST['password'];

	$register = $auth->register($email,$password,$password_repeat, Array(),NULL,NULL,true);

	if( $register['error'] ){
		flash()->error($register['message']);
		redirect('/');
	}else {
		$login = $auth->login($email, $password, false, NULL, 'user');

		if($login['error']) {
			flash()->error($login['message']);
			redirect('/');
		} else {
			// Logged in successfully, set cookie, display success message
			do_login( $login );

			flash()->success('User registered succesfully!');
			redirect('/user/homepage');
		}
	}

}

