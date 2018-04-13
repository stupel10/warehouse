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
			<h3 class="text-danger">Product not found</h3>
		</div>
	</div>
<?php }else{ ?>
	<form action="/_inc/user/product_edit.php" method="POST" enctype="multipart/form-data">
		<div class="row">
			<div class="col-sm-12">
				<div class="form-group">
					<label for="name">NAME</label><br>
					<input type="text" name="name" value="<?php if(isset($product) && $product) echo $product['name'] ?>"><br>
				</div>
				<div class="form-group">
					<label for="unit_price">UNIT PRICE</label><br>
					<input type="number" name="unit_price" step="0.01" value="<?php if(isset($product) && $product) echo $product['unit_price'] ?>">€<br>
				</div>
				<div class="form-group">
					<label for="unit_weight">UNIT WEIGHT</label><br>
					<input type="number" name="unit_weight" step="0.001" value="<?php if(isset($product) && $product) echo $product['unit_weight'] ?>">kg<br>
				</div>
				<div class="form-group">
					PROFILE PHOTO
					<a href="javascript:void(0);" onclick="select_profile_photo()">
						<img id="profile_photo" src="<? if( isset($product['photo_link'])){ echo $product['photo_link']; }else{ echo '/assets/images/product_default.png'; }?>" alt="Profile photo" style="height:200px;width:auto;">
						Click to change.
					</a>
					<input type="file" id="change_profile_photo_input" name="product_photo" accept=".png, .jpg, .jpeg" style="display:none;">
				</div>
					<label for="about">ABOUT</label><br>
					<textarea name="about" cols="100" rows="10"><?php if(isset($product) && $product) echo $product['about'] ?></textarea>
				</div>
			</div>
			<div class="form-group">
				<input type="hidden" name="company_id" value="<?=$user_profile['company_id']?>">
				<input type="hidden" name="id" value="<?=$product_id?>">
				<input type="submit" value="submit" class="btn btn-danger">
			</div>
		</div>
	</form>
<?php }?>