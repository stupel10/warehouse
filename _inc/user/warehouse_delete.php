<?php
$redirect_page = '/user/homepage';

require_once '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {


	$user         = get_user();
	$user_profile = get_user_profile( $user->id );


	if( !isset($_GET['id']) || empty($_GET['id']) ){
		flash()->error('$_GET parameters incorrect.');
		redirect($redirect_page);
	}

	$id = $_GET['id'];
	$warehouse = get_warehouse($id);

	if( $user_profile['company_id'] != $warehouse['company_id']){
		flash()->error('Deleting foreign warehouse restricted.');
		redirect($redirect_page);
	}

	global $database;
	global $auth_config;

	$upd = $database->delete('warehouses',[ 'id' => $id ]);

	if( $upd->rowCount() > 0 ){
		flash()->success('Warehouse deleted');
	}else{
		flash()->error('Warehouse not deleted');
	}
}else{
	flash()->error('no GET request');
}
redirect($redirect_page);
