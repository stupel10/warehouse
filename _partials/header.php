<?php
	$user_logged = is_logged_in() ?  true :  false;

	$page = isset($page) ? $page : '';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Sklad</title>

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
<body class="<?php echo (isset($pages_dir) && $pages_dir !='')? $pages_dir : 'index' ?> <?php echo isset($page)? $page : 'homepage' ?>">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
	<div class="container">
		<a class="navbar-brand" href="#"><i class="fas fa-warehouse"></i></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<?php
		if($user_logged){?>
			<div class="collapse navbar-collapse" id="navbarColor01">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item<?php if($page=='homepage') echo ' active'?>"><a href="/user/homepage" class="btn nav-link">Domov</a></li>
					<li class="nav-item<?php if($page=='products_all') echo ' active'?>"><a href="/user/products_all" class="btn nav-link">Materiály</a></li>
					<li class="nav-item<?php if($page=='vyrobky_all') echo ' active'?>"><a href="/user/vyrobky_all" class="btn nav-link">Výrobky</a></li>
					<?php if( have_permission($user_profile['id'],15) ){?>
					<li class="nav-item dropdown">
						<a class="btn nav-link dropdown-toggle " data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Partneri</a>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="/user/suppliers">Dodávatelia</a>
							<a class="dropdown-item" href="/user/subscribers">Odoberatelia</a>
						</div>
					</li>
					<?php } ?>
					<?php if( have_permission($user_profile['id'],4) ){?>
						<li class="nav-item<?php if($page=='users_all') echo ' active'?>"><a href="/user/users_all" class="btn nav-link">Používatelia</a></li>
					<?php } ?>
				</ul>
				<div class="my-2 my-lg-0">
					<a href="/_inc/user/logout.php" class="btn btn-danger">Odhlásiť</a>
				</div>
			</div>
		<?php } else{ ?>
			<div class="collapse navbar-collapse" id="navbar">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item<?php if($page=='') echo ' active'?>"><a href="/" class="btn nav-link">Domov</a></li>
				</ul>
				<div class="my-2 my-lg-0">
					<?php if($pages_dir=='company_register'){ ?>
						<a href="/" class="btn btn-success">Prihlásiť</a>
					<?php }else{?>
						<!--<a href="/company_register" class="btn btn-success">REGISTER COMPANY</a>-->
					<?php }?>
				</div>
			</div>
		<?php } ?>
	</div>
</nav>

<header class="container">
	<?= flash()->display() ?>
</header>
<main>
	<section>
		<div class="container">