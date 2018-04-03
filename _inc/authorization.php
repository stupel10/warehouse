<?php

// Includes
require_once 'vendor_edited/phpauth/phpauth/languages/en_GB.php' ;
require_once 'vendor_edited/phpauth/phpauth/Config.php' ;
require_once 'vendor_edited/phpauth/phpauth/Auth.php' ;

$dbh = new PDO("mysql:host=localhost;dbname=warehouse", "root", "root");
// endora
//$dbh = new PDO("mysql:host=localhost;dbname=jobi", "jobi6fsk", "Jakub123");

// Class initialization
$auth_config = new \PHPAuth\Config($dbh);
$auth = new PHPAuth\Auth($dbh, $auth_config, $lang);

?>