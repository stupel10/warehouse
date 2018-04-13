<?php

	$products = get_all_company_products($user_profile['company_id']);

?>

<?php if( !$products){ ?>
	<div class="row">
		<div class="col-sm-12">
			<h3 class="text-danger">This company have no products yet</h3>
		</div>
	</div>
<?php }else{ ?>
	<div class="row">
		<div class="col-sm-12">
			<h1>All company products</h1>
		</div>
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
				<?php $i = 0;foreach($products as $product){ ?>
					<tr<?php if( ($i%2)==0 )echo ' class="table-light"'?>>
						<td><?=$product['id']?></td>
						<td><img src="<? if(isset($product['photo_link'])){ echo $product['photo_link']; }else{ echo '/assets/images/product_default.png'; }?>" alt="" style="height: 30px;width:auto;"></td>
						<td><?=$product['name']?></td>
						<td>
							<?php
							if( have_permission($user_profile['id'],6) ){?>
								<a href="/user/product_detail?id=<?=$product['id']?>" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Info"><i class="fas fa-info"></i></a>
							<?php }
							if( have_permission($user_profile['id'],7) ){?>
								<a href="/user/product_edit?id=<?=$product['id']?>" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit"><i class="fas fa-pencil-alt"></i></a>
							<?php }
							if( have_permission($user_profile['id'],8) ){?>
								<a href="javascript:void(0);" onclick="deleteProduct(<?=$product['id']?>);" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit"><i class="fas fa-times"></i></a>
							<?php }?>
						</td>
						<td><?php
							$WH_states = get_warehouses_product_state($product['id']);
							$global_state = 0;
							if($WH_states){
								foreach ( $WH_states as $one ){
									$global_state += intval($one['quantity']);
								}
							}
							echo $global_state;
						?></td>
						<td><?=$product['unit_price']?></td>
						<td><?=$product['unit_weight']?></td>
						<td><?=$product['about']?></td>
					</tr>
				<?php $i++;} ?>
			</table>
		</div>
	</div>
<?php } ?>
<div class="row">
	<div class="col-sm-12">
		<?php
		if( have_permission($user_profile['id'],5) ){?>
			<a href="/user/product_edit?id=0" class="btn btn-success">CREATE PRODUCT</a>
		<?php } ?>
		<?php if($products){?>
			<a href="/_inc/user/products_all_xls.php" class="btn btn-info">EXPORT XLS</a>
		<?php } ?>
	</div>
</div>
