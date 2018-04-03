<?php

	// require stuff
	if( !session_id() ) @session_start();
	require_once 'vendor/autoload.php';

	// show all errors
	ini_set('display_startup_errors','On');
	ini_set('display_errors','On');
	error_reporting(-1);

	// PHP ERRORS FORMAT
	$whoops = new \Whoops\Run;
	$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
	$whoops->register();


	// global variables
	require_once 'variables.php';

	// database
	require_once 'database.php';

	// authorization -  PHPAuth
	require_once 'authorization.php';

	// pdf creator
	require_once 'vendor/setasign/fpdf/font/helvetica.php' ;
	require_once 'vendor/setasign/fpdf/fpdf.php' ;
	//use it in file: $pdf = new FPDF();

	// global functions
	require_once 'global_functions.php';