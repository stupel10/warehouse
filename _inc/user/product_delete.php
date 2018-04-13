<?php
$redirect_page = '/user/products_all';
require_once '../config.php';

if( !have_permission($user_profile['id'],8) ){
	flash()->error('Zakázané');
	die();
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

	$user         = get_user();
	$user_profile = get_user_profile( $user->id );


	if( !isset($_GET['id']) || empty($_GET['id']) ){
		flash()->error('$_GET parameter neplatný.');
		redirect($redirect_page);
	}

	$id = $_GET['id'];
	$product = get_product($id);

	if( $user_profile['company_id'] != $product['company_id']){
		flash()->error('Mazanie cudzieho produktu zakázané.');
		redirect($redirect_page);
	}

	global $database;
	global $auth_config;

	$upd = $database->delete('products',[ 'id' => $id ]);

	if( $upd->rowCount() > 0 ){
		flash()->success('Produkt odstránený');
	}else{
		flash()->error('Produkt nebol odstránený');
	}
}else{
	flash()->error('žiaden GET request');
}
redirect($redirect_page);
