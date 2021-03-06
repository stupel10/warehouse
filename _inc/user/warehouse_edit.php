<?php
$redirect_page = '/user/homepage';
require_once '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	$user         = get_user();
	$user_profile = get_user_profile( $user->id );

	if( !have_permission($user_profile['id'],11) ){
		flash()->error('Zakázané');
		die();
	}


	if( !isset($_POST['name']) || empty($_POST['name']) ||
	    !isset($_POST['company_id']) || empty($_POST['company_id']) ||
	    !isset($_POST['address']) || empty($_POST['address']) ||
	    !isset($_POST['id'])
	){
		flash()->error('$_POST parameter nesprávny.');
		redirect($redirect_page);
	}

	$name = $_POST['name'];
	$company_id = $_POST['company_id'];
	$id = $_POST['id'];
	$address =  $_POST['address'];

	if( isset($_POST['info']) || !empty($_POST['info']) ){
		$info = $_POST['info'];
	}else { $info = ''; }

	if($id!=0 && $user_profile['company_id'] != $company_id){
		flash()->error('Editácia cudzích skladov zakázaná.');
		redirect($redirect_page);
	}

	global $database;
	global $auth_config;

	if( $id == 0){
		$upd = $database->insert('warehouses',[
			'name' => $name,
			'company_id' => $company_id,
			'address' => $address,
			'info' => $info
		]);
	}else{
		$upd = $database->update( 'warehouses', [
			'name' => $name,
			'company_id' => $company_id,
			'address' => $address,
			'info' => $info
		],[
			'id' => $id
		]);
	}
	if( $upd->rowCount() > 0  ){
		flash()->success('Sklad upravený/vytvorený');
	}else{
		flash()->error('Sklad nebol upravný/vytvorený');
	}
}else{
	flash()->error('žiaden POST request');
}
redirect($redirect_page);
