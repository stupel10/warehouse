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

$sheet->setCellValue('A1', 'ID materiálu');
$sheet->setCellValue('B1', 'Kód materiálu');
$sheet->setCellValue('C1', 'Typ materiálu');
$sheet->setCellValue('D1', 'Meno materiálu');
$sheet->setCellValue('E1', 'Počet');
$sheet->setCellValue('F1', 'Nákupná cena');
$sheet->setCellValue('G1', 'Predajná cena');
$sheet->setCellValue('H1', 'DPH');
$sheet->setCellValue('I1', 'Vlastnosti');
$sheet->setCellValue('J1', 'Link na obrázok');

$i = 5;
foreach ($warehouse_products as $warehouse_product){
	$product = get_product($warehouse_product['product_id']);

	$sheet->setCellValueByColumnAndRow(1, $i,$product['id']);
	$sheet->setCellValueByColumnAndRow(2, $i,$product['code']);
	$sheet->setCellValueByColumnAndRow(3, $i,$product['type']);
	$sheet->setCellValueByColumnAndRow(4, $i,$product['name']);
	$sheet->setCellValueByColumnAndRow(5, $i,$warehouse_product['quantity']);
	$sheet->setCellValueByColumnAndRow(6, $i,$product['buy_price']);
	$sheet->setCellValueByColumnAndRow(7, $i,$product['sell_price']);
	$sheet->setCellValueByColumnAndRow(8, $i,intval(['sell_price'])*0.2);
	$sheet->setCellValueByColumnAndRow(9, $i,$product['about']);
	$sheet->setCellValueByColumnAndRow(10, $i,$base_url.$product['photo_link']);
	$i++;
}
$writer = new Xlsx($spreadsheet);
$writer->save('../../assets/files/export.xlsx');
redirect('/assets/files/export.xlsx');