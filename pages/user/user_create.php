<?php

if( !have_permission($user_profile['id'],1) ){
	flash()->error('Zakázané');
	die();
}

?>

<form action="/_inc/user/user_create.php" method="POST">
	<div class="row">
		<div class="col-sm-12">
			<h1>Vytvorenie používateľa</h1>
		</div>
		<div class="col-sm-6">
			<h4>Osobné údaje:</h4>
			<div class="form-group">
				<label for="name">Meno</label><br>
				<input type="text" name="name" class="form-control">
			</div>
			<div class="form-group">
				<label for="surname">Priezvisko</label><br>
				<input type="text" name="surname" class="form-control">
			</div>
			<div class="form-group">
				<label for="role">Rola</label><br>
				<select name="role" id="role" class="custom-select">
					<option value="admin">Admin</option>
					<option value="administrative">Administratívny pracovník</option>
					<option value="warehouseman">Skladník</option>
					<option value="accountant">Účtovník</option>
				</select>
			</div>
		</div>
		<div class="col-sm-6">
			<h4>Prístupové údaje</h4>
			<div class="form-group">
				<label for="email">Email</label><br>
				<input type="email" name="email" class="form-control">
			</div>
			<div class="form-group">
				<label for="pass">Heslo</label><br>
				<input type="password" name="password" class="form-control">
			</div>

		</div>
		<div class="col-sm-12">
			<input type="hidden" name="company_id" value="<?=$user_profile['company_id']?>">
			<input type="submit" value='Uložiť' class="btn btn-success">
		</div>
	</div>
</form>