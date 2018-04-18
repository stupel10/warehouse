<?php
$redirect_page = '/user/homepage';
require_once '../config.php';

$user_profile = get_user_profile( get_user()->id );
//if( !have_permission($user_profile['id'],13) ){
//	flash()->error('Zakázané');
//	die();
//}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	if( !isset($_POST['company_id']) || empty($_POST['company_id']) ||
        !isset($_POST['name']) || empty($_POST['name']) ||
	    !isset($_POST['address']) || empty($_POST['address']) ||
		!isset($_POST['subscriber_id'])
	){
		flash()->error('$_POST parameter nesprávny');
		redirect($redirect_page);
	}


	$company_id = $_POST['company_id'];
	$subscriber_id = $_POST['subscriber_id'];
	$name = $_POST['name'];
	$address = $_POST['address'];

	if(isset($_POST['ico']) && !empty($_POST['ico'])){$ico = $_POST['ico'];}else{$ico="";}
	if(isset($_POST['dic']) && !empty($_POST['dic'])){$dic = $_POST['dic'];}else{$dic="";}
	if(isset($_POST['dph']) ){$dph = 1;}else{$dph=0;}
	if(isset($_POST['iban']) && !empty($_POST['iban'])){$iban = $_POST['iban'];}else{$iban="";}
	if(isset($_POST['web']) && !empty($_POST['web'])){$web = $_POST['web'];}else{$web="";}
	if(isset($_POST['info']) && !empty($_POST['info'])){$info = $_POST['info'];}else{$info="";}


	if($subscriber_id !=0) {
		$subscriber = get_subscriber( $subscriber_id );

		if ( $user_profile['company_id'] != $subscriber['company_id'] ) {
			flash()->error( 'Upravovanie cudzích odoberatelov je zakázané.' );
			redirect( $redirect_page );
		}
	}else {
		$subscriber = null;
	}

	global $database;
	global $auth_config;

	if( $subscriber_id == 0){
		$upd = $database->insert('subscribers',[
			'name' => $name,
			'address' => $address,
			'company_id' => $company_id,
			'ico' => $ico,
			'dic' => $dic,
			'dph' => $dph,
			'iban' => $iban,
			'web' => $web,
			'info' => $info
		]);
	}else{
		$upd = $database->update( 'subscribers', [
			'name' => $name,
			'company_id' => $company_id,
			'address' => $address,
			'ico' => $ico,
			'dic' => $dic,
			'dph' => $dph,
			'iban' => $iban,
			'web' => $web,
			'info' => $info
		],[
			'id' => $subscriber_id
		]);
	}
	if( $upd->rowCount() > 0  ){
		flash()->success('Odoberatel upravený/vytvorený');
	}else{
		flash()->error('Odoberatel nebol upravný/vytvorený');
	}
}else{
	flash()->error('žiaden POST request');
}
redirect($redirect_page);
