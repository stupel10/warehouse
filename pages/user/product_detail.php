<?php
if( !have_permission($user_profile['id'],6) ){
	flash()->error('Zakázané');
	die();
}
if ( !isset($_GET['id']) || empty($_GET['id']) ){
	//flash()->error('Missing parameter id.');
	//redirect('/user/homepage');
	$product = false;
	$product_id = 0;
}else{
	$product_id = $_GET['id'];
	$product = get_product($product_id);
}

?>
<?php if(!$product && $product_id !=0) { ?>
	<div class="row">
		<div class="col-sm-12">
			<h3 class="text-danger">Produkt nenájdený.</h3>
		</div>
	</div>
<?php }else{ ?>
	<div class="row">
		<div class="col-sm-12">
			<h1>M:</h1>
			<?=$product['name'] ?>
			<h3>ID:</h3>
			<?=$product['id'] ?>

			<h3>UNIT PRICE</h3>
			<?=$product['unit_price']?> €

			<h3>UNIT WEIGHT</h3>
			<?=$product['unit_weight']?> kg

			<h3>PROFILE PHOTO</h3>
			<img id="profile_photo" src="<? if( isset($product['photo_link'])){ echo $product['photo_link']; }else{ echo '/assets/images/product_default.png'; }?>" alt="Profile photo" style="height:200px;width:auto;">

			<h3>ABOUT:</h3>
			<?=$product['about']?>
		</div>
	</div>
	<?php
		$warehouse_state = get_warehouses_product_state($product['id']);
		if($warehouse_state){
	?>
	<div class="row">
		<div class="col-sm-6">
			<h3>WAREHOUSE STATE</h3>
			<table class="table table-hover">
				<tr class="table-primary">
					<th>Warehouse ID</th>
					<th>Warehouse Name</th>
					<th>Quantity</th>
				</tr>
				<?php
					$i = 0;
					foreach ($warehouse_state as $one){
					$warehouse = get_warehouse($one['warehouse_id']);
				?>
				<tr<?php if( ($i%2)==0 )echo ' class="table-light"'?>>
					<td><?=$warehouse['id']?></td>
					<td><?=$warehouse['name']?></td>
					<td><?=$one['quantity']?></td>
				</tr>
				<? $i++;} ?>
			</table>
		</div>
	</div>
<?php }
	}?>