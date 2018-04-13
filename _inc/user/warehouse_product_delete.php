<?php
$redirect_page = '/user/homepage';
require_once '../config.php';

if( !have_permission($user_profile['id'],13) ){
	flash()->error('Zakázané');
	die();
}


if ($_SERVER['REQUEST_METHOD'] === 'GET') {


	$user         = get_user();
	$user_profile = get_user_profile( $user->id );


	if( !isset($_GET['warehouse_id']) || empty($_GET['warehouse_id']) ||
	    !isset($_GET['product_id']) || empty($_GET['product_id'])
	){
		flash()->error('$_GET parameters incorrect.');
		redirect($redirect_page);
	}

	$warehouse_id = $_GET['warehouse_id'];
	$warehouse = get_warehouse($warehouse_id);
	$product_id = $_GET['product_id'];
	$warehouse = get_warehouse($product_id);

	if( $user_profile['company_id'] != $warehouse['company_id']){
		flash()->error('Deleting foreign warehouse product restricted.');
		redirect($redirect_page);
	}

	global $database;
	global $auth_config;

	$upd = $database->delete('warehouse_products',[ 'warehouse_id' => $warehouse_id,'product_id'=>$product_id ]);

	if( $upd->rowCount() > 0 ){
		flash()->success('Warehouse product deleted');
	}else{
		flash()->error('Warehouse product not deleted');
	}
}else{
	flash()->error('no GET request');
}
redirect($redirect_page);
