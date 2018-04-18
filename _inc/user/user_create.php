<?php

require_once '../config.php';


$user = get_user();
$user_profile = get_user_profile($user->id);
if( !have_permission($user_profile['id'],1) ){
	flash()->error('Zakázané');
	die();
}


if( $_SERVER['REQUEST_METHOD']==='POST' ){
	$email = filter_input(INPUT_POST,'email',FILTER_SANITIZE_EMAIL);
	$password = $_POST['password'];
	//$password_repeat = $_POST['repeat'];
	$password_repeat = $_POST['password'];

	$register = $auth->register($email,$password,$password_repeat, Array(),NULL,NULL);

	if( $register['error'] ){
		flash()->error($register['message']);
		redirect('/user/user_edit');
	}else {
		// create user profile
		if(isset($_POST['name']) && !empty($_POST['name']) ){$name=$_POST['name'];}else{$name='';}
		if(isset($_POST['surname']) && !empty($_POST['surname']) ){$surname=$_POST['surname'];}else{$surname='';}
		if(isset($_POST['role']) && !empty($_POST['role']) ){$role=$_POST['role'];}else{$role='';}
		if(isset($_POST['phone']) && !empty($_POST['phone']) ){$phone=$_POST['phone'];}else{$phone='';}
		if(isset($_POST['email']) && !empty($_POST['email']) ){$email=$_POST['email'];}else{$email='';}
		if(isset($_POST['address']) && !empty($_POST['address']) ){$address=$_POST['address'];}else{$address='';}


		$admin_profile = get_user_profile(get_user()->id);
		global $database;
		$upd = $database->update( 'user_profiles', [
			'name'    => $name,
			'surname' => $surname,
			'company_id' => $admin_profile['company_id'],
			'role' => $role,
			'phone' => $phone,
			'email' => $email,
			'address' => $address
		], [ 'id' => $register['profile_id'] ] );

		// permissions
		set_permissions($register['profile_id'],$role);
		// end permissions


		if ( $upd->rowCount() ) {
			flash()->success( 'Užívateľ registrovaný!' );
			redirect( '/user/homepage' );
		}else{
			flash()->error( 'Profil uživateľa nebol správne vytvorený!' );
			redirect( '/user/homepage' );
		}
	}
}

