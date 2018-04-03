<?php

use Medoo\Medoo;
// conect to db
$database = new medoo([
	'database_type' => 'mysql',
	'database_name' => 'warehouse',
	'server'        => 'localhost',
	'username'      => 'root',
	'password'      => 'root'
]);

// pre endoru
//$database = new medoo([
//	'database_type' => 'mysql',
//	'database_name' => 'jobi',
//	'server'        => 'localhost',
//	'username'      => 'jobi6fsk',
//	'password'      => 'Jakub123'
//]);