<?php

use Medoo\Medoo;
// conect to db
$database = new medoo([
	'database_type' => 'mysql',
	'database_name' => $db_name,
	'server'        => $db_server_name,
	'username'      => $db_user_name,
	'password'      => $db_user_pass
]);