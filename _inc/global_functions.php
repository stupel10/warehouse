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

	make_log("Log out");

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
		flash()->error('Nie ste prihlásený.');
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
		flash()->error( 'Prístup k tomuto skladu zakázaný!' );
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
		flash()->error( 'Prístup k produktu zakázaný!' );
		return false;
	}

	global $database;
	$products =$database->select('warehouse_products','*',['product_id'=>$product['id']]);

	return $products ? $products : false;
}

/**
 * Create a log
 *
 * @param $text
 *
 * @return bool
 */
function make_log($text){
	$user = get_user();
	$user_profile = get_user_profile($user->id);
	$company_id = $user_profile['company_id'];

	global $database;

	$log = $database->insert('logs',[
		'company_id' =>$user_profile['company_id'],
		'user_id'=>$user_profile['id'],
		'user_name'=>$user_profile['name'].' '.$user_profile['surname'],
		'log' => $text
	]);
	return $log ? true : false;
}

/**
 *
 * Get all users of company by company ID
 *
 * @param $company_id
 *
 * @return array|bool
 */
function get_all_users_by_company($company_id){
	$user = get_user();
	$user_profile = get_user_profile($user->id);

	if( $company_id !=  $user_profile['company_id'] ){
		flash()->error('zakázané!');
		return false;
	}

	global $database;
	$users = $database->select('user_profiles','*',['company_id' => $company_id]);

	return $users? $users : false;

}

/**
 *
 * Set permissions to user by role
 *
 * @param $user_profile_id
 * @param $role
 *
 * @return bool
 */
function set_permissions($user_profile_id,$role){
	global $database;
	$assigned_permissions = [];
	switch ($role){
		case 'admin':
			$assigned_permissions = ['create_user','edit_user','view_user','delete_user','create_product','edit_product','view_product','delete_product','move_product','create_warehouse','edit_warehouse','view_warehouse','delete_warehouse'];
			break;
		case 'administrative':
			$assigned_permissions = ['create_product','edit_product','view_product','delete_product','move_product','create_warehouse','edit_warehouse','view_warehouse','delete_warehouse'];
			break;
		case 'warehouseman':
			$assigned_permissions = ['create_product','edit_product','view_product','delete_product','move_product','view_warehouse'];
			break;
		case 'accountant':
			$assigned_permissions = ['view_product','view_warehouse'];
			break;
		default:
			flash()->error("Neboli vytvorené práva pre uživateľa.");
			return false;
	}

	$all_permissions = get_all_permissions();
	for ( $i = 0; $i < count($all_permissions); $i++ )
	{
		if(in_array($all_permissions[$i]['name'],$assigned_permissions)){
			$value = 1;
		}else{ $value = 0; }
		$database->insert('users_permissions',[
			'user_profile_id' => $user_profile_id,
			'permission_id' => $all_permissions[$i]['id'],
			'value' => $value
		]);
	}
	return true;
}

/**
 *
 * Detect if user have permission in area
 *
 * @param $user_profile_id
 * @param $permission_id
 *
 * @return array|bool|mixed
 */
function have_permission($user_profile_id,$permission_id){
	global $database;

	$permission = $database->get('users_permissions',['value'],[
		'user_profile_id' => $user_profile_id,
		'permission_id' => $permission_id
	]);
	return $permission['value'];
}


/**
 *
 * Get all permissions
 *
 * @return array|bool
 */
function get_all_permissions(){
	global $database;

	$permissions = $database->select('user_permissions','*');

	return $permissions ? $permissions : false;
}

function get_all_user_permissions($user_profile_id){
	global  $database;

	$permissions = $database->select('users_permissions','*',['user_profile_id'=>$user_profile_id]);

	return $permissions ? $permissions : false;
}