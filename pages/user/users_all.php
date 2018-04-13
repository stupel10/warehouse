<?php

if( !have_permission($user_profile['id'],4) ){
	flash()->error('Zakázané');
	die();
}

	$all_users = get_all_users_by_company($user_profile['company_id']);

?>
<div class="page-header">
	<h1>Zoznam užívateľov</h1>
</div>
<div class="row">
	<?php if(!$all_users){ ?>
		<div class="col-sm-12">
			<h2 class="text-danger">Spoločnosť zatiaľ nemá vyvtorených žiadnych uživateľov.</h2>
			<p class="text-secondary">Pre vytvorenie uživateľa kontaktujte zodpovednú osobu.</p>
		</div>
	<?php }else { ?>
		<div class="col-sm-12" style="overflow: scroll;">
			<table class="table table-hover">
				<tr class="table-primary">
					<th>ID</th>
					<th>Meno</th>
					<th>Priezvisko</th>
					<th>Dátum a čas registrácie</th>
					<?php
					$permissions = get_all_permissions();
					for ( $i = 0; $i < count($permissions); $i++ )
					{
						?>
						<td><?=$permissions[$i]['name']?></td>
						<?php
					}
					?>
				</tr>
	<?php
		$i = 0;
		foreach ( $all_users as $user ) { ?>
			<tr<?php if( ($i%2)==0 )echo ' class="table-light"'?>>
				<td><?=$user['id']?></td>
				<td><?=$user['name']?></td>
				<td><?=$user['surname']?></td>
				<td><?=$user['date_registered']?></td>
				<?php
				$all_permissions = get_all_permissions();
				$user_permissions = get_all_user_permissions($user['id']);
				for ( $i = 0; $i < count($all_permissions); $i++ )
				{
					$value = 'N/A';
					for ( $j = 0; $j < count($user_permissions); $j++ )
					{
						if( $all_permissions[$i]['id'] == $user_permissions[$j]['permission_id'] )
						{
							$value = $user_permissions[$j]['value'];
							break;
						}
					}
					?>
					<td><?=$value?></td>
					<?php
				}
				?>
			</tr>
		<?php } ?>
			</table>
		</div>
	<?php }?>
</div>
<div class="row">
	<div class="col-sm-12">
		<?php if( have_permission($user_profile['id'],1) ){?>
			<a href="/user/user_create" class="btn btn-success">Vytvoriť používateľa</a>
		<?php }?>
	</div>
</div>
