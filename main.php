<div class="page-header">
	<h1>Prístup do skladu</h1>
</div>
<form action="/_inc/user/login.php" class="row" method="post">
	<div class="box col-sm-6">
		<h2>LOGIN</h2>
		<div class="form-group">
			<input type="email" name="email" class="form-control" placeholder = "EMAIL" >
		</div>
		<div class="form-group">
			<input type="password" name="password" class="form-control" placeholder = "HESLO" >
		</div>
		<div class="form-group">
			<div class="custom-control custom-checkbox">
				<input type="checkbox" id="rememberMe" name="rememberMe" class="custom-control-input" checked>
				<label for="rememberMe" class="custom-control-label">Zapamätaj si ma</label>
			</div>
		</div>
		<p class="form-group">
			<input type="submit" value="Prihlásiť" class="btn btn-small btn-primary">
		</p>
	</div>
</form>