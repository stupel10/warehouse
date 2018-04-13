<?php
$redirect_page = '/user/homepage';
require_once '../config.php';

if( !have_permission($user_profile['id'],13) ){
	flash()->error('Zakázané');
	die();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	if( !isset($_POST['warehouse_id']) || empty($_POST['warehouse_id']) ||
	    !isset($_POST['product_id']) || empty($_POST['product_id']) ||
	    !isset($_POST['quantity']) || empty($_POST['quantity'])
	){
		flash()->error('$_POST parameter nesprávny');
		redirect($redirect_page);
	}


	$warehouse_id = $_POST['warehouse_id'];
	$product_id = $_POST['product_id'];
	$quantity = $_POST['quantity'];

	$redirect_page = '/user/warehouse_detail?id='.$warehouse_id;

	$user_profile = get_user_profile( get_user()->id );
	$product = get_product($product_id);
	if(!$product){
		flash()->error('Produkt nenájdený');
		redirect($redirect_page);
	}

	if($user_profile['company_id'] != $product['company_id']){
		flash()->error('Pridávanie cudzích produktov zakázané.');
		redirect($redirect_page);
	}

	global $database;
	global $auth_config;

	$record = $database->select('warehouse_products','*',['warehouse_id'=>$warehouse_id,'product_id'=>$product_id]);
	if($record){
		// update record with new quantity
		$new_quantity = $record[0]['quantity'] + $quantity;
		if($new_quantity <= 0){
			$database->delete('warehouse_products',['id'=>$record[0]['id']]);
			flash()->success('Produkt zmazaný');
			redirect($redirect_page);
		}
		$record = $database->update('warehouse_products',['quantity'=>$new_quantity],['warehouse_id'=>$warehouse_id,'product_id'=>$product_id]);
	}else{
		// create new record
		$record = $database->insert('warehouse_products',[
			'quantity'=>$quantity,
			'warehouse_id'=>$warehouse_id,
			'product_id'=> $product_id ]);
	}

	if( $record->rowCount() > 0  ){
		flash()->success('Počet editovaný');
	}else{
		flash()->error('Počet nebol editovaný');
	}
}else{
	flash()->error('žiaden POST request');
}
redirect($redirect_page);
