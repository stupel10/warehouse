<?php

if( !have_permission($user_profile['id'],1) ){
	flash()->error('Zakázané');
	die();
}

if ( !isset($_GET['id']) || empty($_GET['id'])
){
	$editing_user_id = 0;
	$editing_user = false;
}else{
	$editing_user_id = $_GET['id'];
	$editing_user = get_user_profile_by_id($editing_user_id);
}

?>
<?php if(!$editing_user) { ?>
	<form action="/_inc/user/user_create.php" method="POST">
	<?php } else { ?>
	<form action="/_inc/user/user_edit.php" method="POST">
<?php } ?>
	<div class="row">
		<div class="col-sm-12">
			<?php if($editing_user) {?>
				<h1>Editovanie používateľa</h1>
			<?php } else {?>
				<h1>Vytvorenie používateľa</h1>
			<?php } ?>
		</div>
		<div class="col-sm-6">
			<h4>Osobné údaje:</h4>
			<div class="form-group">
				<label for="name">Meno</label><br>
				<input type="text" name="name" class="form-control" value="<? if($editing_user) echo $editing_user['name'];?>">
			</div>
			<div class="form-group">
				<label for="surname">Priezvisko</label><br>
				<input type="text" name="surname" class="form-control" value="<? if($editing_user) echo $editing_user['surname'];?>">
			</div>
			<div class="form-group">
				<label for="phone">Telefónne číslo</label><br>
				<input type="text" name="phone" class="form-control" value="<? if($editing_user) echo $editing_user['phone'];?>">
			</div>
			<div class="form-group">
				<label for="email">Email</label><br>
				<input type="text" name="email" class="form-control" value="<? if($editing_user) echo $editing_user['email'];?>">
			</div>
			<div class="form-group">
				<label for="address">Adresa</label><br>
				<input type="text" name="address" class="form-control" value="<? if($editing_user) echo $editing_user['address'];?>">
			</div>
		</div>
		<div class="col-sm-6">
			<?php if(!$editing_user) { ?>
			<h4>Prístupové údaje</h4>
			<div class="form-group">
				<label for="email">Email</label><br>
				<input type="email" name="email" class="form-control">
			</div>
			<div class="form-group">
				<label for="pass">Heslo</label><br>
				<input type="password" name="password" class="form-control">
			</div>
			<?php } ?>
			<h4>Prístupové práva</h4>
			<div class="form-group">
				<label for="role">Rola</label><br>
				<select name="role" id="role" class="custom-select">
					<option value="admin" <?php if($editing_user && $editing_user['role']==='admin') echo 'selected';?>>Admin</option>
					<option value="administrative" <?php if($editing_user && $editing_user['role']==='administrative') echo 'selected';?>>Administratívny pracovník</option>
					<option value="warehouseman" <?php if($editing_user && $editing_user['role']==='warehouseman') echo 'selected';?>>Skladník</option>
					<option value="accountant" <?php if($editing_user && $editing_user['role']==='accountant') echo 'selected';?>>Účtovník</option>
				</select>
			</div>
		</div>
		<div class="col-sm-12">
			<?php if (!$editing_user){ ?>
				<input type="hidden" name="company_id" value="<?=$user_profile['company_id']?>">
				<?php } else { ?>
				<input type="hidden" name="user_id" value="<?=$editing_user['id']?>">
			<?php } ?>
			<input type="submit" value='Uložiť' class="btn btn-success">
		</div>
	</div>
</form>