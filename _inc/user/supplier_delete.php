<?php
$redirect_page = '/user/homepage';
require_once '../config.php';



if ($_SERVER['REQUEST_METHOD'] === 'GET') {

	$user         = get_user();
	$user_profile = get_user_profile( $user->id );

	if( !have_permission($user_profile['id'],17) ){
		flash()->error('Zakázané');
		die();
	}


	if( !isset($_GET['supplier_id']) || empty($_GET['supplier_id']) ){
		flash()->error('$_GET parameter neplatný.');
		redirect($redirect_page);
	}

	$supplier_id = $_GET['supplier_id'];
	$supplier = get_supplier($supplier_id);

	if( $user_profile['company_id'] != $supplier['company_id']){
		flash()->error('Mazanie cudzieho odoberatela zakázané.');
		redirect($redirect_page);
	}

	global $database;
	global $auth_config;

	$upd = $database->delete('suppliers',[ 'id' => $supplier_id ]);

	if( $upd->rowCount() > 0 ){
		flash()->success('Dodavatel odstránený');
	}else{
		flash()->error('Dodavatel nebol odstránený');
	}
}else{
	flash()->error('žiaden GET request');
}
redirect($redirect_page);
