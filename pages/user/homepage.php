<?php

	$company_id = $user_profile['company_id'];
	$warehouses = get_warehouses($company_id);

?>
<div class="page-header">
	<h1>Select warehouse.</h1>
</div>
<div class="row">
	<?php if(!$warehouses){ ?>
		<div class="col-sm-12">
			<h2 class="text-danger">This company has no warehouses. Contact admin to create some.</h2>
		</div>
	<?php }else {
		foreach ( $warehouses as $warehouse ) { ?>
			<a href="/user/warehouse_detail?id=<?= $warehouse['id'] ?>" class="col-sm-6">
				<div class="card border-primary mb-3">
					<div class="card-header"><h3><?= $warehouse['name']?><i class="fas fa-arrow-right"></i></h3></div>
					<div class="card-body">
						<!--<h4 class="card-title">Info</h4>-->
						<p class="card-text">Nejake info o danom sklade, mozno progressbar.</p>
					</div>
				</div>
			</a>
		<?php }
	}?>
</div>
<div class="row">
	<div class="col-sm-12">
		<a href="/user/warehouse_edit?id=0" class="btn btn-success">CREATE WAREHOUSE</a>
		<a href="/user/user_create" class="btn btn-secondary">CREATE USER</a>
	</div>
</div>
