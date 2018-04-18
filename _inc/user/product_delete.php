<?php
$redirect_page = '/user/products_all';
require_once '../config.php';



if ($_SERVER['REQUEST_METHOD'] === 'GET') {

	$user         = get_user();
	$user_profile = get_user_profile( $user->id );

	if( !have_permission($user_profile['id'],8) ){
		flash()->error('Zakázané');
		die();
	}


	if( !isset($_GET['id']) || empty($_GET['id']) ){
		flash()->error('$_GET parameter neplatný.');
		redirect($redirect_page);
	}

	$id = $_GET['id'];
	$product = get_product($id);

	if( $user_profile['company_id'] != $product['company_id']){
		flash()->error('Mazanie cudzieho materiálu zakázané.');
		redirect($redirect_page);
	}

	global $database;
	global $auth_config;

	$upd = $database->delete('products',[ 'id' => $id ]);

	if( $upd->rowCount() > 0 ){
		flash()->success('materiál odstránený');
	}else{
		flash()->error('materiál nebol odstránený');
	}
}else{
	flash()->error('žiaden GET request');
}
redirect($redirect_page);
