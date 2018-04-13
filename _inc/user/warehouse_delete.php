<?php
$redirect_page = '/user/homepage';

require_once '../config.php';

if( !have_permission($user_profile['id'],12) ){
	flash()->error('Zakázané');
	die();
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {


	$user         = get_user();
	$user_profile = get_user_profile( $user->id );


	if( !isset($_GET['id']) || empty($_GET['id']) ){
		flash()->error('$_GET parameter nesprávny.');
		redirect($redirect_page);
	}

	$id = $_GET['id'];
	$warehouse = get_warehouse($id);

	if( $user_profile['company_id'] != $warehouse['company_id']){
		flash()->error('Mazanie cudzích skladov zakázané.');
		redirect($redirect_page);
	}

	global $database;
	global $auth_config;

	$upd = $database->delete('warehouses',[ 'id' => $id ]);

	if( $upd->rowCount() > 0 ){
		flash()->success('Sklad zmazaný');
	}else{
		flash()->error('Sklad nebol zmazaný');
	}
}else{
	flash()->error('žiaden GET request');
}
redirect($redirect_page);
