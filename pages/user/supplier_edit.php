<?php
if( !have_permission($user_profile['id'],14) ){
	flash()->error('Zakázané');
	die('Zakázané');
}

if ( !isset($_GET['supplier_id']) || empty($_GET['supplier_id'])
){
	//flash()->error('Missing parameter id.');
	//redirect('/user/homepage');
	$supplier = false;
	$supplier_id = 0;
}else{
	$supplier_id = $_GET['supplier_id'];
	$supplier = get_supplier($supplier_id);
}
?>
<?php if(!$supplier && $supplier_id !=0) { ?>
	<div class="row">
		<div class="col-sm-12">
			<h3 class="text-danger">Odoberatel sa nenašiel</h3>
		</div>
	</div>
<?php }else{ ?>
<div class="row">
	<div class="col-sm-12">
		<h1>Dodávateľ</h1>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
	<form action="/_inc/user/supplier_edit.php" method="POST">
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<label for="name">Meno</label>
					<input type="text" name="name" value="<?php if( $supplier) echo $supplier['name'] ?>" class="form-control">
				</div>
				<div class="form-group">
					<label for="address">Adresa</label>
					<textarea name="address" id="address" cols="30" rows="4" class="form-control"><?php if(isset($supplier) && $supplier) echo $supplier['address'] ?></textarea>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label for="ico">ICO</label>
					<input type="text" name="ico" value="<?php if(isset($supplier) && $supplier) echo $supplier['ico'] ?>" class="form-control">
				</div>
				<div class="form-group">
					<label for="dic">DIC</label>
					<input type="text" name="dic" value="<?php if(isset($supplier) && $supplier) echo $supplier['dic'] ?>" class="form-control">
				</div>
				<div class="form-group">
					<label for="dph">
						<input type="checkbox" name="dph" <?php if(isset($supplier) && $supplier && $supplier['dph']) echo 'checked' ?> >
					DPH</label>
				</div>
			</div>
			<div class="col-sm-12">
				<div class="form-group">
					<label for="iban">IBAN</label>
					<input type="text" name="iban" value="<?php if(isset($supplier) && $supplier) echo $supplier['iban'] ?>" class="form-control">
				</div>
				<div class="form-group">
					<label for="web">Webova stranka</label>
					<input type="text" name="web" value="<?php if(isset($supplier) && $supplier) echo $supplier['web'] ?>" class="form-control">
				</div>
				<div class="form-group">
					<label for="info">Info</label>
					<input type="text" name="info" value="<?php if(isset($supplier) && $supplier) echo $supplier['info'] ?>" class="form-control">
				</div>
			</div>
			<div class="col-sm-12">
				<div class="form-group">
					<input type="hidden" name="company_id" value="<?=$user_profile['company_id']?>">
					<input type="hidden" name="supplier_id" value="<?=$supplier_id?>">
					<input type="submit" value="Uložiť" class="btn btn-danger">
				</div>
			</div>
		</div>
	</form>
	</div>
</div>
<?php }?>