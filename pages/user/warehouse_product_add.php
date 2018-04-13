<?php
	if( !have_permission($user_profile['id'],10) ){
		flash()->error('Zakázané');
		die();
	}

	if ( !isset($_GET['id']) || empty($_GET['id']) ){
		//flash()->error('Missing parameter id.');
		//redirect('/user/homepage');
		$warehouse = false;
		$warehouse_id = 0;
	}else{
		$warehouse_id = $_GET['id'];
		$warehouse = get_warehouse($warehouse_id);
	}
?>

<?php if(!$warehouse) { ?>
	<div class="row">
		<div class="col-sm-12">
			<h3 class="text-danger">Warehouse not found</h3>
		</div>
	</div>
<?php }else { ?>
	<?php
	$available_products = get_all_company_products( $user_profile['company_id'] );

	if ( ! $available_products ) { ?>
		<div class="row">
			<div class="col-sm-12">
				<h3 class="text-danger">There are no products to select. You need to create some first!</h3>
			</div>
		</div>
	<?php } else {
		?>
		<form action="/_inc/user/warehouse_product_add.php" method="POST">
			<div class="row">
				<div class="col-sm-12">
					<div class="form-group">
						<label for="product_id">PRODUCT</label><br>
						<select name="product_id" class="custom-select">
							<?php foreach ( $available_products as $product ) { ?>
								<option value="<?=$product['id']?>"><?=$product['name']?></option>
							<?php } ?>
						</select><br>
						<label for="quantity">QUANTITY</label><br>
						<input type="number" name="quantity"><br>
					</div>
				</div>
				<div class="col-sm-12">
					<!--<input type="hidden" name="company_id" value="--><?//= $user_profile['company_id'];?><!--">-->
					<input type="hidden" name="warehouse_id" value="<?= $warehouse_id ?>">
					<input type="submit" value="submit" class="btn btn-danger">
				</div>
			</div>
		</form>
	<?php }
}?>