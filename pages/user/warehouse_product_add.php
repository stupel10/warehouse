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
			<h3 class="text-danger">Sklad nenájdený</h3>
		</div>
	</div>
<?php }else { ?>
	<?php
	$available_products = get_all_company_products( $user_profile['company_id'] );

	if ( ! $available_products ) { ?>
		<div class="row">
			<div class="col-sm-12">
				<h3 class="text-danger">Táto spoločnosť zatiaľ nemá žiaden materíal.</h3>
			</div>
		</div>
	<?php } else {

		if ( !isset($_GET['product_id']) || empty($_GET['product_id']) ||
		     !isset($_GET['supplier_id']) || empty($_GET['supplier_id']) ||
		     !isset($_GET['direction']) || empty($_GET['direction'])
		){
			$isEdit = false;
			$product_id = 0;
			$supplier_id = 0;
			$direction = 'in';
		}else{
			$isEdit = true;
			$product_id = $_GET['product_id'];
			$supplier_id = $_GET['supplier_id'];
			$direction = $_GET['direction'];
		}

		if($isEdit){ ?>
			<h1>Úprava stavu materiálu</h1>
			<?php } else { ?>
			<h1>Pridanie nového materiálu</h1>
			<?php } ?>
		<form action="/_inc/user/warehouse_product_add.php" method="POST">
			<div class="row">
				<div class="col-sm-12">
					<div class="form-group">
						<label for="supplier_id">Dodávateľ</label>
						<select name="supplier_id" id="supplier_id" class="form-control custom-select" <?php if($isEdit) echo 'disabled' ?> >
							<?php $suppliers = get_all_company_suppliers($user_profile['company_id']);
								foreach ( $suppliers as $one){ ?>
								<option value="<?=$one['id']?>" <?php if($isEdit && $one['id']==$supplier_id) echo 'selected'?>><?=$one['name']?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label for="product_id">materiál</label><br>
						<select name="product_id" class="custom-select" <?php if($isEdit) echo 'disabled' ?>>
							<?php foreach ( $available_products as $product ) { ?>
								<option value="<?=$product['id']?>" <?php if($isEdit && $product['id']==$product_id) echo 'selected'?>><?=$product['name']?></option>
							<?php } ?>
						</select><br>
					</div>
					<div class="form-group">
						<label for="quantity">Počet</label><br>
						<input type="number" name="quantity" min="0"><br>
					</div>
				</div>
				<?php if($isEdit){ ?>
					<div class="col-sm-12">
						<div class="form-group">
							<select name="subscriber_id" id="subscriber_id" class="custom-select">
								<?php
									$subscribers = get_all_company_subscribers($user_profile['company_id']);
									foreach ( $subscribers as $one ) { ?>
										<option value="<?=$one['id']?>"><?=$one['name']?></option>
									<?php } ?>
							</select>
						</div>
					</div>
				<?php }?>
				<div class="col-sm-12">
					<!--<input type="hidden" name="company_id" value="--><?//= $user_profile['company_id'];?><!--">-->
					<input type="hidden" name="warehouse_id" value="<?= $warehouse_id ?>">
					<input type="hidden" name="direction" value="<?=$direction?>">
					<input type="submit" value="Potvrdiť" class="btn btn-danger">
				</div>
			</div>
		</form>
	<?php }
}?>