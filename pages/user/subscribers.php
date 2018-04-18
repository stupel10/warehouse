<?php

if( !have_permission($user_profile['id'],15) ){
	flash()->error('Zakázané');
	die('zakazane');
}
	$subscribers = get_all_company_subscribers($user_profile['company_id']);
?>

<div class="row">
	<div class="col-sm-12">
		<div class="form-group">
			<h1>Odoberatelia</h1>
		</div>
	</div>
</div>
<?php if ( ! $subscribers ) { ?>
	<div class="row">
		<div class="col-sm-12">
			<h3 class="text-danger">Odoberatelia neboli nájdení.</h3>
		</div>
	</div>
<?php } else { ?>
	<div class="row">
		<div class="col-sm-12">
			<table class="table table-hover">
				<tr class="table-primary">
					<th>ID</th>
					<th>Meno</th>
					<th>Možnosti</th>
					<th>Adresa</th>
					<th>ICO</th>
					<th>DIC</th>
					<th>DPH</th>
					<th>IBAN</th>
					<th>WEB</th>
					<th>INFO</th>
				</tr>
				<?php $i=0;foreach ($subscribers as $one){
					$subscriber = get_subscriber($one['id']);
					?>
					<tr<?php if( ($i%2)==0 )echo ' class="table-light"'?>>
						<td><?=$subscriber['id']?></td>
						<td><?=$subscriber['name']?></td>
						<td>
							<a href="/user/subscriber_edit?subscriber_id=<?=$subscriber['id']?>" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Upraviť"><i class="fas fa-pencil-alt"></i></a>
							<a href="javascript:void(0);" onclick="deleteSubscriber(<?=$subscriber['id']?>);" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Zmazať"><i class="fas fa-trash-alt"></i></a>
						</td>
						<td><?=$subscriber['address']?></td>
						<td><?=$subscriber['ico']?></td>
						<td><?=$subscriber['dic']?></td>
						<td><?=$subscriber['dph']?></td>
						<td><?=$subscriber['iban']?></td>
						<td><?=$subscriber['web']?></td>
						<td><?=$subscriber['info']?></td>
					</tr>
					<?php $i++;}?>
			</table>
		</div>
	</div>
<?php } ?>
<div class="row">
	<div class="col-sm-12">
		<?php
		//if( have_permission($user_profile['id'],5) ){?>
			<a href="/user/subscriber_edit?subscriber_id=0" class="btn btn-success">Pridaj odoberatela</a>
		<?php //}
		//if($warehouse_products){?>
		<!--	<a href="/_inc/user/warehouse_xls.php?id=--><?//= $warehouse['id']?><!--" class="btn btn-primary">Exportuj XLS</a>-->
		<?php //} ?>
	</div>
</div>
