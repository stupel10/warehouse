<?php

require_once '../config.php';

if( $_SERVER['REQUEST_METHOD']==='POST' ){
	$email = filter_input(INPUT_POST,'email',FILTER_SANITIZE_EMAIL);
	$password = $_POST['password'];
	//$password_repeat = $_POST['repeat'];
	$password_repeat = $_POST['password'];

	$register = $auth->register($email,$password,$password_repeat, Array(),NULL,NULL);

	if( $register['error'] ){
		flash()->error($register['message']);
		redirect('/user/user_create');
	}else {
		// create user profile
		$name    = $_POST['name'];
		$surname = $_POST['surname'];
		$admin_profile = get_user_profile(get_user()->id);
		global $database;
		$upd = $database->update( 'user_profiles', [
			//'rights' => $rights,
			'name'    => $name,
			'surname' => $surname,
			'company_id' => $admin_profile['company_id']
		], [ 'id' => $register['profile_id'] ] );

		if ( $upd->rowCount() ) {
			flash()->success( 'User registered successfully!' );
			redirect( '/user/homepage' );
		}else{
			flash()->error( 'User profile not created successfully registered!' );
			redirect( '/user/homepage' );
		}
	}
}

