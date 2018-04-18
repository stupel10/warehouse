<?php

require_once '../config.php';


$user = get_user();
$user_profile = get_user_profile($user->id);
if( !have_permission($user_profile['id'],2) ){
	flash()->error('Zakázané');
	die();
}


if( $_SERVER['REQUEST_METHOD']==='POST' ){
		// create user profile

	if( !isset($_POST['user_id']) || empty($_POST['user_id']) ||
	    !isset($_POST['name']) || empty($_POST['name']) ||
	    !isset($_POST['surname']) || empty($_POST['surname']) ||
	    !isset($_POST['role']) || empty($_POST['role'])
	){
		flash()->error('Zle vyplnene udaje.');
		redirect('/');
	}

	if(isset($_POST['name']) && !empty($_POST['name']) ){$name=$_POST['name'];}else{$name='';}
	if(isset($_POST['surname']) && !empty($_POST['surname']) ){$surname=$_POST['surname'];}else{$surname='';}
	if(isset($_POST['role']) && !empty($_POST['role']) ){$role=$_POST['role'];}else{$role='';}
	if(isset($_POST['phone']) && !empty($_POST['phone']) ){$phone=$_POST['phone'];}else{$phone='';}
	if(isset($_POST['email']) && !empty($_POST['email']) ){$email=$_POST['email'];}else{$email='';}
	if(isset($_POST['address']) && !empty($_POST['address']) ){$address=$_POST['address'];}else{$address='';}
	$editing_user_id = $_POST['user_id'];

		global $database;
		$upd = $database->update( 'user_profiles', [
			'name'    => $name,
			'surname' => $surname,
			'role' => $role,
			'phone' => $phone,
			'email' => $email,
			'address' => $address
		], [ 'id' =>  $editing_user_id] );

		// permissions
		set_permissions($editing_user_id,$role);
		// end permissions


		if ( $upd->rowCount() ) {
			flash()->success( 'Užívateľ registrovaný!' );
			redirect( '/user/homepage' );
		}else{
			flash()->error( 'Profil uživateľa nebol správne vytvorený!' );
			redirect( '/user/homepage' );
		}
}

