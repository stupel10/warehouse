<form action="/_inc/user/user_create.php" method="POST">
	<div class="row">
		<div class="col-sm-12">
			<h1>CREATE USER</h1>
		</div>
		<div class="col-sm-12">
			<div class="form-group">
				<label for="email">EMAIL</label><br>
				<input type="email" name="email">
			</div>
			<div class="form-group">
				<label for="pass">PASSWORD</label><br>
				<input type="password" name="password">
			</div>
			<h4>USER PROFILE:</h4>
			<div class="form-group">
				<label for="name">NAME</label><br>
				<input type="text" name="name">
			</div>
			<div class="form-group">
				<label for="surname">SURNAME</label><br>
				<input type="text" name="surname">
			</div>
		</div>
		<div class="col-sm-12">
			<input type="hidden" name="company_id" value="<?=$user_profile['company_id']?>">
			<input type="submit" class="btn btn-success">
		</div>
	</div>
</form>