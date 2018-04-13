<?php
//
//	// zatial nechceme spristupnit verejnu registraciu firiem
//	include_once '403.php';
//	exit();
//
//	die('restricted yet! :)');
//
//?>

<div class="page-header">
	<h1>WAREHOUSE SYSTEM</h1>
</div>
<form action="/_inc/user/registration.php" class="row" method="post">
	<div class="col-sm-6 box">
		<h2>REGISTER</h2>
		<div class="form-group">
			<input type="email" name="email" class="form-control" placeholder = "EMAIL" >
		</div>
		<div class="form-group">
			<input type="password" name="password" class="form-control" placeholder = "PASSWORD" >
		</div>
		<p class="text-muted">Submiting this form is created whole new company with first user. This user is named: admin and has all admin rights.</p>
		<div class="form-group">
			<input type="submit" value="REGISTER" class="btn btn-small btn-danger">
		</div>
	</div>
</form>