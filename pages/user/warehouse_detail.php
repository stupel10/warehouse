<?php

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
			<h3 class="text-danger">Warehouse not found</h3>
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
				<h3 class="text-danger">No products in this warehouse</h3>
			</div>
		</div>
	<?php } else { ?>
		<div class="row">
			<div class="col-sm-12">
				<table class="table table-hover">
					<tr class="table-primary">
						<th>ID</th>
						<th>Product image</th>
						<th>Product name</th>
						<th>Tools</th>
						<th>Quantity</th>
						<th>Unit price</th>
						<th>Unit weight</th>
						<th>About</th>
					</tr>
					<?php $i=0;foreach ($warehouse_products as $warehouse_product){
						$product = get_product($warehouse_product['product_id'])
						?>
						<tr<?php if( ($i%2)==0 )echo ' class="table-light"'?>>
							<td><?=$product['id']?></td>
							<td><img src="<? if(isset($product['photo_link'])){ echo $product['photo_link']; }else{ echo '/assets/images/product_default.png'; }?>" alt="" style="height: 30px;width:auto;"></td>
							<td><?=$product['name']?></td>
							<td>
								<a href="/user/product_detail?id=<?=$product['id']?>" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Info"><i class="fas fa-info"></i></a>
								<!--<a href="#" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Add pieces"><i class="fas fa-plus"></i></a>-->
								<!--<a href="#" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete pieces"><i class="fas fa-minus"></i></a>-->
								<a href="javascript:void(0);" onclick="deleteAllProductsFromWarehouse(<?=$warehouse['id']?>//,<?=$product['id']?>//);" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete all"><i class="fas fa-sign-out-alt"></i></a>
							</td>
							<td><?=$warehouse_product['quantity']?></td>
							<td><?=$product['unit_price']?></td>
							<td><?=$product['unit_weight']?></td>
							<td><?=$product['about']?></td>
						</tr>
					<?php $i++;}?>
				</table>
			</div>
		</div>
	<?php } ?>
	<div class="row">
		<div class="col-sm-12">
			<a href="/user/warehouse_product_add?id=<?= $warehouse['id'] ?>" class="btn btn-success">ADD PRODUCT</a>
			<a href="/user/warehouse_edit?id=<?= $warehouse['id'] ?>" class="btn btn-info">EDIT WAREHOUSE</a>
			<a href="javascript:void(0)" onclick="deleteWarehouse(<?=$warehouse['id']?>);" class="btn btn-danger">DELETE WAREHOUSE</a>
		</div>
	</div>
<?php }?>
