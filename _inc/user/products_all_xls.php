<?php

require '../config.php';

$user_profile = get_user_profile(get_user()->id);
$products = get_all_company_products($user_profile['company_id']);


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

$i = 2;
foreach ($products as $product){
	$sheet->setCellValueByColumnAndRow(1, $i,$product['id']);
	$sheet->setCellValueByColumnAndRow(2, $i,$product['code']);
	$sheet->setCellValueByColumnAndRow(3, $i,$product['type']);
	$sheet->setCellValueByColumnAndRow(4, $i,$product['name']);
	$WH_states = get_warehouses_product_state($product['id']);
	$global_state = 0;
	if($WH_states){
		foreach ( $WH_states as $one ){
			$global_state += intval($one['quantity']);
		}
	}
	$sheet->setCellValueByColumnAndRow(5, $i,$global_state);
	$sheet->setCellValueByColumnAndRow(6, $i,$product['buy_price']);
	$sheet->setCellValueByColumnAndRow(7, $i,$product['sell_price']);
	$sheet->setCellValueByColumnAndRow(7, $i,intval(['sell_price'])*0.2);
	$sheet->setCellValueByColumnAndRow(9, $i,$product['about']);
	$sheet->setCellValueByColumnAndRow(10, $i,$base_url.$product['photo_link']);
	$i++;
}
$writer = new Xlsx($spreadsheet);
$writer->save('../../assets/files/export.xlsx');

redirect('/assets/files/export.xlsx');