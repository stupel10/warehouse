<?php
if( !have_permission($user_profile['id'],7) ){
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
			<h3 class="text-danger">Produkt sa nenašiel</h3>
		</div>
	</div>
<?php }else{ ?>
	<form action="/_inc/user/product_edit.php" method="POST" enctype="multipart/form-data">
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<label for="name">Meno</label><br>
					<input type="text" name="name" value="<?php if(isset($product) && $product) echo $product['name'] ?>"><br>
				</div>
				<div class="form-group">
					<label for="code">Kód</label><br>
					<input type="text" name="code" step="0.01" value="<?php if(isset($product) && $product) echo $product['code'] ?>"><br>
				</div>
				<div class="form-group">
					<label for="type">Typ</label><br>
					<input type="text" name="type" step="0.01" value="<?php if(isset($product) && $product) echo $product['type'] ?>"><br>
				</div>
				<div class="form-group">
					<label for="buy_price">Nakupná cena</label><br>
					<input type="number" name="buy_price" step="0.01" value="<?php if(isset($product) && $product) echo $product['buy_price'] ?>">€<br>
				</div>
				<div class="form-group">
					<label for="sell_price">Predajná cena</label><br>
					<input type="number" name="sell_price" step="0.01" value="<?php if(isset($product) && $product) echo $product['sell_price'] ?>">€<br>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label>Obrázok</label><br>
					<a href="javascript:void(0);" onclick="select_profile_photo()">
						<img id="profile_photo" src="<? if( !empty($product['photo_link'])){ echo $product['photo_link']; }else{ echo '/assets/images/product_default.png'; }?>" alt="Profile photo" style="height:200px;width:auto;">
						<!--Klinutím zmeňte.-->
					</a>
					<input type="file" id="change_profile_photo_input" name="product_photo" accept=".png, .jpg, .jpeg" style="display:none;">
				</div>
			</div>
			<div class="col-sm-12">
				<div class="form-group">
					<label for="about">Vlastnosti</label><br>
					<textarea name="about" cols="100" rows="10"><?php if(isset($product) && $product) echo $product['about'] ?></textarea>
				</div>
			</div>
			<div class="col-sm-12">
				<div class="form-group">
					<input type="hidden" name="company_id" value="<?=$user_profile['company_id']?>">
					<input type="hidden" name="id" value="<?=$product_id?>">
					<input type="submit" value="Uložiť" class="btn btn-danger">
				</div>
			</div>
		</div>
	</form>
<?php }?>