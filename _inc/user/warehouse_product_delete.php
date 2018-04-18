<?php
$redirect_page = '/user/homepage';
require_once '../config.php';

$user_profile = get_user_profile(get_user()->id);
if( !have_permission($user_profile['id'],13) ){
	flash()->error('Zakázané');
	die();
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {


	$user         = get_user();
	$user_profile = get_user_profile( $user->id );

	if( !have_permission($user_profile['id'],13) ){
		flash()->error('Zakázané');
		die();
	}

	if( !isset($_GET['warehouse_id']) || empty($_GET['warehouse_id']) ||
	    !isset($_GET['product_id']) || empty($_GET['product_id']) ||
	    !isset($_GET['supplier_id']) || empty($_GET['supplier_id'])
	){
		flash()->error('$_GET parameter nesprávny.');
		redirect($redirect_page);

	}

	$warehouse_id = $_GET['warehouse_id'];
	$warehouse = get_warehouse($warehouse_id);
	$product_id = $_GET['product_id'];


	if( $user_profile['company_id'] != $warehouse['company_id']){
		flash()->error('Mazanie materiálov cudzieho skladu zakázané.');
		redirect($redirect_page);
	}

	global $database;
	global $auth_config;

	$upd = $database->delete('warehouse_products',[ 'warehouse_id' => $warehouse_id,'product_id'=>$product_id, 'supplier_id' =>$_GET['supplier_id'] ]);

	if( $upd->rowCount() > 0 ){
		flash()->success('Zmazaný material skladu.');
	}else{
		flash()->error('nezmazané');
	}
}else{
	flash()->error('žiaden GT request');
}
redirect($redirect_page);
