<?php

	if( !have_permission($user_profile['id'],10) ){
		flash()->error('Zakázané');
		die();
	}


	if ( !isset($_GET['id']) || empty($_GET['id']) ){
		//flash()->error('Missing parameter id.');
		//redirect('/user/homepage');
		$warehouse = false;
		$warehouse_products = false;
	}else{
		$warehouse_id = $_GET['id'];
		$warehouse = get_warehouse($warehouse_id);
		$warehouse_products = get_warehouse_products($warehouse['id']);
	}
?>
<?php if(!$warehouse) { ?>
	<div class="row">
		<div class="col-sm-12">
			<h3 class="text-danger">Sklad nebol nájdený</h3>
		</div>
	</div>
<?php }else { ?>
	<div class="row">
		<div class="col-sm-12">
			<div class="form-group">
				<h1><?=$warehouse['name']?></h1>
			</div>
		</div>
	</div>
	<?php if ( ! $warehouse_products ) { ?>
		<div class="row">
			<div class="col-sm-12">
				<h3 class="text-danger">V sklade zatiaľ nie sú žiadne materiály.</h3>
			</div>
		</div>
	<?php } else { ?>
		<div class="row">
			<div class="col-sm-12">
				<table class="table table-hover">
					<tr class="table-primary">
						<th>ID</th>
						<th>Kod</th>
						<th>Typ</th>
						<th>Obrázok</th>
						<th>Meno</th>
						<th>Možnosti</th>
						<th>Počet</th>
						<th>Celkový počet</th>
						<th>Dodávateľ</th>
						<th>Nákupná cena</th>
						<th>Predajná cena</th>
						<th>DPH</th>
						<th>Vlastnosti</th>
					</tr>
					<?php $i=0;foreach ($warehouse_products as $warehouse_product){
						$product = get_product($warehouse_product['product_id'])
						?>
						<tr<?php if( ($i%2)==0 )echo ' class="table-light"'?>>
							<td><?=$product['id']?></td>
							<td><?=$product['code']?></td>
							<td><?=$product['type']?></td>
							<td><img src="<? if(isset($product['photo_link'])){ echo $product['photo_link']; }else{ echo '/assets/images/product_default.png'; }?>" alt="" style="height: 30px;width:auto;"></td>
							<td><?=$product['name']?></td>
							<td>
								<a href="/user/product_detail?id=<?=$product['id']?>" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Info"><i class="fas fa-info"></i></a>
								<a href="/user/warehouse_product_add?id=<?= $warehouse['id'] ?>&product_id=<?=$product['id']?>&supplier_id=<?=$warehouse_product['supplier_id']?>&direction=in" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Add pieces"><i class="fas fa-plus"></i></a>
								<a href="/user/warehouse_product_add?id=<?= $warehouse['id'] ?>&product_id=<?=$product['id']?>&supplier_id=<?=$warehouse_product['supplier_id']?>&direction=out" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete pieces"><i class="fas fa-minus"></i></a>
								<a href="javascript:void(0);" onclick="deleteAllProductsFromWarehouse(<?=$warehouse['id']?>,<?=$product['id']?>,<?=$warehouse_product['supplier_id']?>);" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Zmazať všetko"><i class="fas fa-sign-out-alt"></i></a>
							</td>
							<td><?=$warehouse_product['quantity']?></td>
							<td>
								<?php
								$same_products = get_all_same_products_in_one_warehouse($warehouse_product['warehouse_id'],$product['id']);
								$counter = 0;
								foreach ($same_products as $one){
									$counter += $one['quantity'];
								}
								echo $counter;
								?>
							</td>
							<td>
								<? $supplier = get_supplier($warehouse_product['supplier_id']);
								echo $supplier['name'];?>
							</td>
							<td><?=$product['buy_price']?></td>
							<td><?=$product['sell_price']?></td>
							<td><?=intval($product['sell_price'])*0.2?></td>
							<td><?=$product['about']?></td>
						</tr>
					<?php $i++;}?>
				</table>
			</div>
		</div>
	<?php } ?>
	<div class="row">
		<div class="col-sm-12">
			<?php
			if( have_permission($user_profile['id'],5) ){?>
				<a href="/user/warehouse_product_add?id=<?= $warehouse['id'] ?>" class="btn btn-success">Pridaj iný materiál</a>
			<?php }
			if($warehouse_products){?>
				<a href="/_inc/user/warehouse_xls.php?id=<?= $warehouse['id']?>" class="btn btn-primary">Exportuj XLS</a>
			<?php }
			if( have_permission($user_profile['id'],11) ){?>
				<a href="/user/warehouse_edit?id=<?= $warehouse['id'] ?>" class="btn btn-info">Upraviť sklad</a>
			<?php }
			if( have_permission($user_profile['id'],12) ){?>
				<a href="javascript:void(0)" onclick="deleteWarehouse(<?=$warehouse['id']?>);" class="btn btn-danger">Vymazať sklad</a>
			<?php } ?>
		</div>
	</div>
<?php }?>
