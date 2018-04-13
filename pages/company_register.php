<?php

	// zatial nechceme spristupnit verejnu registraciu firiem
	include_once '403.php';
	exit();

	die('restricted yet! :)');

?>

<div class="page-header">
	<h1>Skladový systém</h1>
</div>
<form action="/_inc/user/registration.php" class="row" method="post">
	<div class="col-sm-6 box">
		<h2>Registrácia</h2>
		<div class="form-group">
			<input type="email" name="email" class="form-control" placeholder = "EMAIL" >
		</div>
		<div class="form-group">
			<input type="password" name="password" class="form-control" placeholder = "PASSWORD" >
		</div>
		<p class="text-muted">Registráciou sa vytvorí aj prvý užívateľ. Tento užívateľ má meno admin a priradené všetky práva.</p>
		<div class="form-group">
			<input type="submit" value="Registruj" class="btn btn-small btn-danger">
		</div>
	</div>
</form>