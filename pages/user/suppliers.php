<?php

if( !have_permission($user_profile['id'],15) ){
	flash()->error('Zakázané');
	die('zakazane');
}

$suppliers = get_all_company_suppliers($user_profile['company_id']);

?>

<div class="row">
	<div class="col-sm-12">
		<div class="form-group">
			<h1>Dodávatelia</h1>
		</div>
	</div>
</div>
<?php if ( ! $suppliers ) { ?>
	<div class="row">
		<div class="col-sm-12">
			<h3 class="text-danger">Dodávatelia neboli nájdení.</h3>
		</div>
	</div>
<?php } else { ?>
	<div class="row">
		<div class="col-sm-12">
			<table class="table table-hover">
				<tr class="table-primary">
					<th>ID</th>
					<th>Meno</th>
					<th>Možnosti</th>
					<th>Adresa</th>
					<th>ICO</th>
					<th>DIC</th>
					<th>DPH</th>
					<th>IBAN</th>
					<th>WEB</th>
					<th>INFO</th>
				</tr>
				<?php $i=0;foreach ($suppliers as $one){
					$supplier = get_supplier($one['id']);
					?>
					<tr<?php if( ($i%2)==0 )echo ' class="table-light"'?>>
						<td><?=$supplier['id']?></td>
						<td><?=$supplier['name']?></td>
						<td>
							<a href="/user/supplier_edit?supplier_id=<?=$supplier['id']?>" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Upraviť"><i class="fas fa-pencil-alt"></i></a>
							<a href="javascript:void(0);" onclick="deleteSupplier(<?=$supplier['id']?>);" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Zmazať"><i class="fas fa-trash-alt"></i></a>
						</td>
						<td><?=$supplier['address']?></td>
						<td><?=$supplier['ico']?></td>
						<td><?=$supplier['dic']?></td>
						<td><?=$supplier['dph']?></td>
						<td><?=$supplier['iban']?></td>
						<td><?=$supplier['web']?></td>
						<td><?=$supplier['info']?></td>
					</tr>
					<?php $i++;}?>
			</table>
		</div>
	</div>
<?php } ?>
<div class="row">
	<div class="col-sm-12">
		<?php
		//if( have_permission($user_profile['id'],5) ){?>
		<a href="/user/supplier_edit?supplier_id=0" class="btn btn-success">Pridaj dodávateľa</a>
		<?php //}
		//if($warehouse_products){?>
		<!--	<a href="/_inc/user/warehouse_xls.php?id=--><?//= $warehouse['id']?><!--" class="btn btn-primary">Exportuj XLS</a>-->
		<?php //} ?>
	</div>
</div>
