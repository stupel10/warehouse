<?php

if ( is_logged_in() ) {
	$user = get_user();
	$user_profile = get_user_profile($user->id);
}else {
	header('HTTP/1.0 403 Forbidden');
	include_once '403.php';
	exit();
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>WAREHOUSE</title>

	<link rel="stylesheet" href="/assets/css/bootstrap.min.css">
	<!--<link rel="stylesheet" href="/assets/css/bootstrap-grid.css">-->
	<!--<link rel="stylesheet" href="/assets/css/bootstrap-reboot.css">-->
	<link rel="stylesheet" href="/assets/plugins/font-awesome.5.0.8/css/fontawesome-all.min.css">
	<link rel="stylesheet" href="/assets/css/main.css">

	<script>
		var baseUrl = '<?php echo $base_url ?>'
	</script>
	<script src="/assets/js/jquery.js"></script>
	<script src="/assets/js/plugins.js"></script>
	<script src="/assets/js/popper.js"></script>
	<!--<script src="/assets/js/bootstrap.bundle.js"></script>-->
	<script src="/assets/js/bootstrap.min.js"></script>
	<script src="/assets/js/app.js"></script>
</head>
<body class="user <?php echo $page ?>">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
	<div class="container">
		<a class="navbar-brand" href="/"><i class="fas fa-warehouse"></i></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarColor01">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item<?php if($page=='homepage') echo ' active'?>"><a href="/user/homepage" class="btn nav-link">COMPANY HOME</a></li>
				<li class="nav-item<?php if($page=='products_all') echo ' active'?>"><a href="/user/products_all" class="btn nav-link">ALL PRODUCTS</a></li>
				<!--<li class="nav-item dropdown">-->
					<!--<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="download" aria-expanded="true">Yeti <span class="caret"></span></a>-->
					<!--<div class="dropdown-menu show" aria-labelledby="download">-->
					<!--	<a class="dropdown-item" href="https://jsfiddle.net/bootswatch/vdr1vx77/">Open in JSFiddle</a>-->
					<!--	<div class="dropdown-divider"></div>-->
					<!--	<a class="dropdown-item" href="../4/yeti/bootstrap.min.css">bootstrap.min.css</a>-->
					<!--	<a class="dropdown-item" href="../4/yeti/bootstrap.css">bootstrap.css</a>-->
					<!--	<div class="dropdown-divider"></div>-->
					<!--	<a class="dropdown-item" href="../4/yeti/_variables.scss">_variables.scss</a>-->
					<!--	<a class="dropdown-item" href="../4/yeti/_bootswatch.scss">_bootswatch.scss</a>-->
					<!--</div>-->
				<!--</li>-->
			</ul>
			<div class="my-2 my-lg-0">
				<a href="/_inc/user/logout.php" class="btn btn-danger">LOG OUT</a>
			</div>
		</div>
	</div>
</nav>
<header class="container">
	<?= flash()->display() ?>
</header>
<main>
	<section>
		<div class="container">