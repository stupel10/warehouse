<?php

require '../config.php';

$user_profile = get_user_profile(get_user()->id);
$products = get_all_company_products($user_profile['company_id']);


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$sheet->setCellValue('A1', 'Product ID');
$sheet->setCellValue('B1', 'Product name');
$sheet->setCellValue('C1', 'Product quantity');
$sheet->setCellValue('D1', 'Unit price');
$sheet->setCellValue('E1', 'Unit weight');
$sheet->setCellValue('F1', 'About');
$sheet->setCellValue('G1', 'Photo link');

$i = 2;
foreach ($products as $product){
	$sheet->setCellValueByColumnAndRow(1, $i,$product['id']);
	$sheet->setCellValueByColumnAndRow(2, $i,$product['name']);
	$WH_states = get_warehouses_product_state($product['id']);
	$global_state = 0;
	if($WH_states){
		foreach ( $WH_states as $one ){
			$global_state += intval($one['quantity']);
		}
	}
	$sheet->setCellValueByColumnAndRow(3, $i,$global_state);
	$sheet->setCellValueByColumnAndRow(4, $i,$product['unit_price']);
	$sheet->setCellValueByColumnAndRow(5, $i,$product['unit_weight']);
	$sheet->setCellValueByColumnAndRow(6, $i,$product['about']);
	$sheet->setCellValueByColumnAndRow(7, $i,$base_url.$product['photo_link']);
	$i++;
}
$writer = new Xlsx($spreadsheet);
$writer->save('../../assets/files/export.xlsx');

redirect('/assets/files/export.xlsx');