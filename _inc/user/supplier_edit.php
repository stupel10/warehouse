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
		!isset($_POST['supplier_id'])
	){
		flash()->error('$_POST parameter nesprávny');
		redirect($redirect_page);
	}


	$company_id = $_POST['company_id'];
	$supplier_id = $_POST['supplier_id'];
	$name = $_POST['name'];
	$address = $_POST['address'];

	if(isset($_POST['ico']) && !empty($_POST['ico'])){$ico = $_POST['ico'];}else{$ico="";}
	if(isset($_POST['dic']) && !empty($_POST['dic'])){$dic = $_POST['dic'];}else{$dic="";}
	if(isset($_POST['dph']) ){$dph = 1;}else{$dph=0;}
	if(isset($_POST['iban']) && !empty($_POST['iban'])){$iban = $_POST['iban'];}else{$iban="";}
	if(isset($_POST['web']) && !empty($_POST['web'])){$web = $_POST['web'];}else{$web="";}
	if(isset($_POST['info']) && !empty($_POST['info'])){$info = $_POST['info'];}else{$info="";}

	if($supplier_id !=0) {
		$supplier = get_supplier( $supplier_id );

		if ( $user_profile['company_id'] != $supplier['company_id'] ) {
			flash()->error( 'Upravovanie cudzích odoberatelov je zakázané.' );
			redirect( $redirect_page );
		}
	}

	global $database;
	global $auth_config;


	if( $supplier_id == 0){
		$upd = $database->insert('suppliers',[
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
		$upd = $database->update( 'suppliers', [
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
			'id' => $supplier_id
		]);
	}

	if( $upd->rowCount() > 0  ){
		flash()->success('Dodávateľ upravený/vytvorený');
	}else{
		flash()->error('Dodávateľ nebol upravný/vytvorený');
	}
}else{
	flash()->error('žiaden POST request');
}
redirect($redirect_page);
