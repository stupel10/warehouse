<?php
$redirect_page = '/user/homepage';
require_once '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


	$user_profile = get_user_profile( get_user()->id );


	if( !isset($_POST['name']) || empty($_POST['name']) ||
	    !isset($_POST['about']) || empty($_POST['about']) ||
	    !isset($_POST['company_id']) || empty($_POST['company_id']) ||
	    !isset($_POST['unit_price']) || empty($_POST['unit_price']) ||
	    !isset($_POST['unit_weight']) || empty($_POST['unit_weight']) ||
	    !isset($_POST['id'])
	){
		flash()->error('$_POST parameters incorrect.');
		redirect($redirect_page);
	}

	$name = $_POST['name'];
	$about = $_POST['about'];
	$unit_price = $_POST['unit_price'];
	$unit_weight = $_POST['unit_weight'];
	$company_id = $_POST['company_id'];
	$id = $_POST['id'];

	if($id!=0 && $user_profile['company_id'] != $company_id){
		flash()->error('Editing foreign product restricted.');
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
				flash()->error( "File is an image - " . $check["mime"] . "." );
				$uploadOk = 1;
			} else {
				//echo "File is not an image.";
				flash()->error( "File is not an image." );
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
			flash()->error( "Sorry, your file is too large." );
			$uploadOk = 0;
		}
		// Allow certain file formats
		if ( $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
			//echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			flash()->error( "Sorry, only JPG, JPEG, PNG & GIF files are allowed." );
			$uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ( $uploadOk == 0 ) {
			//echo "Sorry, your file was not uploaded.";
			flash()->error( "Sorry, your file was not uploaded." );
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
				flash()->error( "Sorry, there was an error uploading your file." );
			}
		}
	}else{
		flash()-> info('Product image not filled.');
		$target_file = '';
	}
	// END IMAGE

	global $database;
	global $auth_config;

	if( $id == 0){
		$upd = $database->insert('products',[
			'name' => $name,
			'about' => $about,
			'unit_price' => $unit_price,
			'unit_weight' => $unit_weight,
			'company_id' => $company_id,
			'photo_link' => $target_file
		]);
	}else{
		$upd = $database->update( 'products', [
			'name' => $name,
			'about' => $about,
			'unit_price' => $unit_price,
			'unit_weight' => $unit_weight,
			'company_id' => $company_id,
			'photo_link' => $target_file
		],[
			'id' => $id
		]);
	}
	if( $upd->rowCount() > 0  ){
		flash()->success('Product created/edited');
	}else{
		flash()->error('Product not created/edited');
	}
}else{
	flash()->error('no POST request');
}
redirect($redirect_page);