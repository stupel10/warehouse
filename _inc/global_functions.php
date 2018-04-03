<?php
//////////////////////////////////////////////////////////////////
////////////////////////     W A R E H O U S E
//////////////////////////////////////////////////////////////////
function redirect( $page ){
	global $base_url;

	$page = ltrim( $page, '/');

	header("Location: $base_url/$page");
	die();
}

/**
 * Do Login
 *
 * Create cookie after logging in
 *
 * @param $data
 * @return bool
 */
function do_login( $data ){

	global $auth_config;

	setcookie(
		$auth_config->cookie_name,
		$data['hash'],
		$data['expire'],
		$auth_config->cookie_path,
		$auth_config->cookie_domain,
		$auth_config->cookie_secure,
		$auth_config->cookie_http
	);
}
/**
 * Do Logout
 *
 * Logs the user out
 *
 * @return bool
 */
function do_logout(){
	if ( !is_logged_in() ){
		return true;
	}
	global $auth;
	global $auth_config;

	return $auth->logout( $_COOKIE[$auth_config->cookie_name] );

}

/**
 * Is user logged in?
 *
 * returns true if user is logged in
 *
 * @return bool
 */
function is_logged_in(){
	global $auth;

	return ($auth->isLogged() );
}

/**
 * Get user
 *
 * Grab data for the logged in user
 * @param int $user_id
 * @return bool|mixed
 */
function get_user( $user_id = 0){

	global $auth;

	if( ! $user_id && is_logged_in() ){
		$user_id = $auth->getSessionUID($auth->getSessionHash());
	}
	return (object) $auth->getUser($user_id);
}

/**
 * Get user profile
 *
 * @param $user_id - id of user from users table
 *
 * @return array|bool
 */
function get_user_profile($user_id){
	global $auth;
	global $auth_config;
	global $database;

	if( ! $user_id && is_logged_in() ){
		$user_id = $auth->getSessionUID($auth->getSessionHash());
	}
	$profile_id = $auth->getUserActiveProfile($user_id);
	$user_profiles = $database->select($auth_config->table_user_profiles, "*",[ "id" => $profile_id ]);

	return $user_profiles[0];
}


/**
 *
 * Get all warehouses of company
 *
 * @param $company_id
 *
 * @return array|bool
 */
function get_warehouses($company_id){
	if (!is_logged_in() ){
		flash()->error('You are not logged in.');
		return false;
	}
	global $database;
	$warehouses = $database->select('warehouses','*',['company_id'=>$company_id]);

	return $warehouses ? $warehouses : false;
}

/**
 * Get warehouse
 *
 * @param $warehouse_id
 *
 * @return bool
 */
function get_warehouse($warehouse_id){
	global $database;
	$warehouse = $database->select('warehouses','*',['id'=>$warehouse_id]);

	return $warehouse ? $warehouse[0] : false;
}

/**
 * Get product
 *
 * @param $product_id
 *
 * @return bool
 */
function get_product($product_id){
	global $database;
	$product = $database->select('products','*',['id'=>$product_id]);

	return $product ? $product[0] : false;
}

/**
 * Get products of warehouse
 *
 * @param $warehouse_id
 *
 * @return array|bool
 */
function get_warehouse_products($warehouse_id){
	$user = get_user();
	$user_profile = get_user_profile($user->id);
	$warehouse = get_warehouse($warehouse_id);

	if($warehouse['company_id'] != $user_profile['company_id']) {
		flash()->error( 'Restricted warehouse!' );
		return false;
	}

	global $database;
	$products =$database->select('warehouse_products','*',['warehouse_id'=>$warehouse['id']]);

	return $products ? $products : false;
}

/**
 * Get all products that belong to company
 *
 * @param $company_id
 *
 * @return array|bool
 */
function get_all_company_products($company_id){
	global $database;

	$products = $database->select('products','*',['company_id'=>$company_id]);

	return $products ? $products : false;
}

/**
 * Get state of one product in all warehouses
 *
 * @param $product_id
 *
 * @return array|bool
 */
function get_warehouses_product_state($product_id){
	$user = get_user();
	$user_profile = get_user_profile($user->id);

	$product = get_product($product_id);

	if($product['company_id'] != $user_profile['company_id']) {
		flash()->error( 'Restricted product!' );
		return false;
	}

	global $database;
	$products =$database->select('warehouse_products','*',['product_id'=>$product['id']]);

	return $products ? $products : false;
}