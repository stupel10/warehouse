<?php

require '../config.php';

$user_profile = get_user_profile(get_user()->id);
$products = get_all_company_products($user_profile['company_id']);

if ( !isset($_GET['id']) || empty($_GET['id']) ){
	flash()->error('Missing parameter id.');
	redirect('/user/homepage');
}else{
	$warehouse_id = $_GET['id'];
	$warehouse = get_warehouse($warehouse_id);
	$warehouse_products = get_warehouse_products($warehouse_id);
}

if (!$warehouse_products || !$warehouse){
	redirect('/user/homepage');
}


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$sheet->setCellValue('A1',"Sklad:");
$sheet->setCellValue('A2',$warehouse['name']);

$sheet->setCellValue('A4', 'ID produktu');
$sheet->setCellValue('B4', 'Meno produktu');
$sheet->setCellValue('C4', 'Počet');
$sheet->setCellValue('D4', 'Cena za jednotku');
$sheet->setCellValue('E4', 'Jednotková váha');
$sheet->setCellValue('F4', 'Vlastnosti');
$sheet->setCellValue('G4', 'Link na obrázok');

$i = 5;
foreach ($warehouse_products as $warehouse_product){
	$product = get_product($warehouse_product['product_id']);

	$sheet->setCellValueByColumnAndRow(1, $i,$product['id']);
	$sheet->setCellValueByColumnAndRow(2, $i,$product['name']);
	$sheet->setCellValueByColumnAndRow(3, $i,$warehouse_product['quantity']);
	$sheet->setCellValueByColumnAndRow(4, $i,$product['unit_price']);
	$sheet->setCellValueByColumnAndRow(5, $i,$product['unit_weight']);
	$sheet->setCellValueByColumnAndRow(6, $i,$product['about']);
	$sheet->setCellValueByColumnAndRow(7, $i,$base_url.$product['photo_link']);
	$i++;
}
$writer = new Xlsx($spreadsheet);
$writer->save('../../assets/files/export.xlsx');
redirect('/assets/files/export.xlsx');