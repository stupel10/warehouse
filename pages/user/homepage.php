<?php

	if( !have_permission($user_profile['id'],10) ){
		flash()->error('Zakázané');
		die();
	}

	$company_id = $user_profile['company_id'];
	$warehouses = get_warehouses($company_id);

?>
<div class="page-header">
	<h1>Zoznam skladov</h1>
</div>
<div class="row">
	<?php if(!$warehouses){ ?>
		<div class="col-sm-12">
			<h2 class="text-danger">Spoločnosť zatial nemá vyvtorený žiaden sklad.</h2>
			<p class="text-secondary">Pre vytvorenie skladu kontaktujte zodpovednú osobu.</p>
		</div>
	<?php }else {
		foreach ( $warehouses as $warehouse ) { ?>
			<a href="/user/warehouse_detail?id=<?= $warehouse['id'] ?>" class="col-sm-6">
				<div class="card border-primary mb-3">
					<div class="card-header"><h3><?= $warehouse['name']?><i class="fas fa-arrow-right"></i></h3></div>
					<div class="card-body">
						<p class="card-text"><?=$warehouse['info']?></p>
						<p class="card-text"><?=$warehouse['address']?></p>
					</div>
				</div>
			</a>
		<?php }
	}?>
</div>
<div class="row">
	<div class="col-sm-12">
		<a href="/user/warehouse_edit?id=0" class="btn btn-success">Vytvoriť sklad</a>
	</div>
</div>
