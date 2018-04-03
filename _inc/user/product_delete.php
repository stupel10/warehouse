<?php
$redirect_page = '/user/products_all';
require_once '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

	$user         = get_user();
	$user_profile = get_user_profile( $user->id );


	if( !isset($_GET['id']) || empty($_GET['id']) ){
		flash()->error('$_GET parameters incorrect.');
		redirect($redirect_page);
	}

	$id = $_GET['id'];
	$product = get_product($id);

	if( $user_profile['company_id'] != $product['company_id']){
		flash()->error('Deleting foreign products restricted.');
		redirect($redirect_page);
	}

	global $database;
	global $auth_config;

	$upd = $database->delete('products',[ 'id' => $id ]);

	if( $upd->rowCount() > 0 ){
		flash()->success('Product deleted');
	}else{
		flash()->error('Product not deleted');
	}
}else{
	flash()->error('no GET request');
}
redirect($redirect_page);
