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
	<style>
		p.big-text {  font-size: 30px;  }
		p.medium-text {  font-size: 20px;  }
	</style>
	<div class="row">
		<div class="col-sm-12">
			<h1><?=$product['name'] ?></h1>
			<hr>
		</div>
		<div class="col-sm-6">
			<h3>ID</h3>
			<p class="big-text"><?=$product['id'] ?></p>

			<h3>Kod</h3>
			<p class="big-text"><?=$product['code'] ?></p>

			<h3>Typ</h3>
			<p class="big-text"><?=$product['type'] ?></p>

			<h3>Nákupná cena</h3>
			<p class="big-text"><?=$product['buy_price']?> €</p>

			<h3>Predajá cena</h3>
			<p class="big-text"><?=$product['sell_price']?> €</p>
		</div>
		<div class="col-sm-6">
			<img id="profile_photo" src="<? if( !empty($product['photo_link']) ){ echo $product['photo_link']; }else{ echo '/assets/images/product_default.png'; }?>" alt="Profile photo" style="height:200px;width:auto;">
		</div>
		<div class="col-sm-12">
			<h3>ABOUT:</h3>
			<p class="medium-text"><?=$product['about']?></p>
		</div>
	</div>
	<?php
		$warehouse_state = get_warehouses_product_state($product['id']);
		if($warehouse_state){
	?>
			<hr>
	<div class="row" style="margin-top: 50px;">
		<div class="col-lg-6">
			<h2>Stav v skladoch</h2>
			<table class="table table-hover">
				<tr class="table-primary">
					<th>ID skladu</th>
					<th>Meno skladu</th>
					<th>Počet</th>
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