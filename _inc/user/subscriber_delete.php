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


	if( !isset($_GET['subscriber_id']) || empty($_GET['subscriber_id']) ){
		flash()->error('$_GET parameter neplatný.');
		redirect($redirect_page);
	}

	$subscriber_id = $_GET['subscriber_id'];
	$subscriber = get_subscriber($subscriber_id);

	if( $user_profile['company_id'] != $subscriber['company_id']){
		flash()->error('Mazanie cudzieho odoberatela zakázané.');
		redirect($redirect_page);
	}

	global $database;
	global $auth_config;

	$upd = $database->delete('subscribers',[ 'id' => $subscriber_id ]);

	if( $upd->rowCount() > 0 ){
		flash()->success('Odoberatel odstránený');
	}else{
		flash()->error('Odoberatel nebol odstránený');
	}
}else{
	flash()->error('žiaden GET request');
}
redirect($redirect_page);
