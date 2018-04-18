<?php
$redirect_page = '/user/users_all';
require_once '../config.php';



if ($_SERVER['REQUEST_METHOD'] === 'GET') {

	$user         = get_user();
	$user_profile = get_user_profile( $user->id );

	if( !have_permission($user_profile['id'],3) ){
		flash()->error('Zakázané');
		die('Zakázané');
	}


	if( !isset($_GET['user_id']) || empty($_GET['user_id']) ){
		flash()->error('$_GET parameter neplatný.');
		redirect($redirect_page);
	}

	$editing_user_profile_id = $_GET['user_id'];
	$editing_user_profile = get_user_profile_by_id($editing_user_profile_id);

	if( $user_profile['company_id'] != $editing_user_profile['company_id']){
		flash()->error('Mazanie cudzieho uzivatela zakázané.');
		redirect($redirect_page);
	}
	if( $user_profile['id'] == $editing_user_profile_id){
		flash()->error('Mazanie seba zakázané.');
		redirect($redirect_page);
	}

	global $database;
	global $auth_config;

	$upd = $database->delete('user_profiles',[ 'id' => $editing_user_profile_id ]);
	$upd = $database->delete('users',[ 'active_profile' => $editing_user_profile_id ]);

	flash()->success('Uzivatel odstránený');

}else{
	flash()->error('žiaden GET request');
}
redirect($redirect_page);
