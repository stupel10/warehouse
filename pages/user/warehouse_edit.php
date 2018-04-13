<?php

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
<?php if(!$warehouse && $warehouse_id !=0) { ?>
<div class="row">
	<div class="col-sm-12">
		<h3 class="text-danger">Sklad nenájdený</h3>
	</div>
</div>
<?php }else{ ?>
<form action="/_inc/user/warehouse_edit.php" method="POST">
	<div class="row">
		<div class="col-sm-12">
			<div class="form-group">
				<label for="name">Meno</label><br>
				<input type="text" name="name" value="<?php if(isset($warehouse) && $warehouse) echo $warehouse['name'] ?>"><br>
			</div>
		</div>
		<div class="col-sm-12">
			<input type="hidden" name="company_id" value="<?=$user_profile['company_id'];?>">
			<input type="hidden" name="id" value="<?=$warehouse_id?>">
			<input type="submit" value="Uložiť" class="btn btn-danger">
		</div>
	</div>
</form>
<?php }?>