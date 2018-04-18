<?php
$redirect_page = '/user/homepage';
require_once '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


	$user_profile = get_user_profile( get_user()->id );

	if( !have_permission($user_profile['id'],7) ){
		flash()->error('Zakázané');
		die();
	}


	if( !isset($_POST['name']) || empty($_POST['name']) ||
	    !isset($_POST['about']) || empty($_POST['about']) ||
	    !isset($_POST['company_id']) || empty($_POST['company_id']) ||
	    !isset($_POST['buy_price']) || empty($_POST['buy_price']) ||
	    !isset($_POST['sell_price']) || empty($_POST['sell_price']) ||
	    !isset($_POST['code']) || empty($_POST['code']) ||
	    !isset($_POST['type']) || empty($_POST['type']) ||
	    !isset($_POST['id'])
	){
		flash()->error('$_POST parameter neplatný.');
		redirect($redirect_page);
	}

	$name = $_POST['name'];
	$about = $_POST['about'];
	$code = $_POST['code'];
	$type = $_POST['type'];
	$buy_price = $_POST['buy_price'];
	$sell_price = $_POST['sell_price'];
	$company_id = $_POST['company_id'];
	$id = $_POST['id'];


	if($id!=0 && $user_profile['company_id'] != $company_id){
		flash()->error('Editovanie cudzieho materiálu zakázané.');
		redirect($redirect_page);
	}

	// IMAGE
	if( (isset($_FILES['product_photo']) ) ) {

		$target_dir    = "../../assets/images/products/";
		$imageFileType = strtolower( pathinfo( './' . basename( $_FILES["product_photo"]["name"],
				PATHINFO_EXTENSION ) )['extension'] );
		$user          = get_user();
		$target_file   = $target_dir . 'company_' . $company_id . '_product_' . $id . '.' . $imageFileType;
		$uploadOk      = 1;
		// Check if image file is a actual image or fake image
		if ( isset( $_POST["submit"] ) ) {
			$check = getimagesize( $_FILES["product_photo"]["tmp_name"] );
			if ( $check !== false ) {
				//echo "File is an image - " . $check["mime"] . ".";
				//flash()->error( "File is an image - " . $check["mime"] . "." );
				$uploadOk = 1;
			} else {
				//echo "File is not an image.";
				flash()->error( "Súbor nie je obrázok." );
				$uploadOk = 0;
			}
		}
		// Check if file already exists
		//if (file_exists($target_file)) {
		//	echo "Sorry, file already exists.";
		//	$uploadOk = 0;
		//}
		// Check file size lower than 5 000 000B = 5MB
		if ( $_FILES["product_photo"]["size"] > 5000000 ) {
			//echo "Sorry, your file is too large.";
			flash()->error( "Súbor príliž veľký." );
			$uploadOk = 0;
		}
		// Allow certain file formats
		if ( $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
			//echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			flash()->error( "Povolené formáty: jpg,png,jpeg." );
			$uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ( $uploadOk == 0 ) {
			//echo "Sorry, your file was not uploaded.";
			flash()->error( "Súbor nebol nahratý." );
			// if everything is ok, try to upload file
		} else {
			if ( move_uploaded_file( $_FILES["product_photo"]["tmp_name"], $target_file ) ) {
				//echo "The file ". basename( $_FILES["product_photo"]["name"]). " has been uploaded.";
				// save link to DB
				$target_file = substr( $target_file, 5, strlen( $target_file ) - 5 );
				//if(set_profile_photo($target_file)){
				//flash()->success( "The file " . basename( $_FILES["product_photo"]["name"] ) . " has been set as your profile picture." );
				//}
			} else {
				//echo "Sorry, there was an error uploading your file.";
				flash()->error( "Chyba pri uploade obrázku." );
			}
		}
	}else{
		//flash()-> info('Nevyplnený.');
		$target_file = '';
	}
	// END IMAGE

	global $database;
	global $auth_config;

	if( $id == 0){
		$upd = $database->insert('products',[
			'name' => $name,
			'about' => $about,
			'buy_price' => $buy_price,
			'sell_price' => $sell_price,
			'company_id' => $company_id,
			'photo_link' => $target_file,
			'code' => $code,
			'type' => $type
		]);
	}else{
		$upd = $database->update( 'products', [
			'name' => $name,
			'about' => $about,
			'buy_price' => $buy_price,
			'sell_price' => $sell_price,
			'company_id' => $company_id,
			'photo_link' => $target_file,
			'code' => $code,
			'type' => $type
		],[
			'id' => $id
		]);
	}
	if( $upd->rowCount() > 0  ){
		flash()->success('materiál vytvorený/editovaný');
	}else{
		flash()->error('materiál nebol správne vytvorený/editovaný');
	}
}else{
	flash()->error('žiaden POST request');
}
redirect($redirect_page);