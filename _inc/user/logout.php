<?php

require_once '../config.php';

if (! $auth->isLogged() ){
	// u arent logged in, y u want to logout?
	redirect('/');
}

$logout = do_logout();

if (!$logout){
	// neodhlasil si sa
	flash()->error('Log out failed');
	redirect('/');
}else {
	flash()->success('Successfuly logged out');
	redirect('/');
}