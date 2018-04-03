<?php

require_once '_inc/config.php';

if (isset($_GET['url'])) {
	$explode = explode("/", $_GET["url"]);
	$pages_dir = $explode[0];
	$id = isset($explode[1]) ? intval($explode[1]) : 0;
	$page = isset($explode[1]) ? trim($explode[1]) : '';
	//$param2 = isset($explode[2]) ? trim($explode[2]) : '';
	//$param3 = isset($explode[3]) ? trim($explode[3]) : '';
}
else $pages_dir = '';

if( $pages_dir !== '' ) {
	if( $pages_dir === 'user'){
		include_once '_partials/user_header.php';
	}else {
		include_once "_partials/header.php";
	}

	$link = 'pages/' . $pages_dir .'/'. $page . '.php';
	$link = 'pages/' . $pages_dir;
	if($page != '') $link .='/'. $page;
	$link.= '.php';
	//echo $link;
	include file_exists( $link ) ? $link : '404.php';
}else {
	if(is_logged_in()){
		redirect('/user/homepage');
	}else {
		include_once "_partials/header.php";
		include 'main.php';
	}
}
include_once "_partials/footer.php";



