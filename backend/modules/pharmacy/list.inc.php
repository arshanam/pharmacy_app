

	
	

	<h3 class="headline m-top-md">
		<div class="float-left">Listing Pharmacies: </div>
		<div class="float-right"><button type="button" class="btn btn-primary btn-sm" id="success-notification">Regular</button><a href="pharmacy/add" class="btn btn-primary btn-sm">New Pharmacy</a></div>
		<div class="clear"></div>

		<span class="line"></span>
	</h3>
	
	<?php check_for_notifications(); ?>

	<?php	$results = $db->get("pharmacy"); ?>

	<div class="panel panel-default table-responsive">
		<div class="padding-md clearfix">
			<?php if($results): ?>
				<table style="font-size: 12px;" class="table table-striped" id="dataTable">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Region</th>
							<th>Address</th>
							<th>Phone</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$i=0;
							foreach($results as $res):
								$db->where ('id', $res['city']);
								$city = $db->getOne("city");
								$i++;
						?>					
						<tr>
							<td><?= $i; ?></td>
							<td><?= $res['name']; ?> <?= $res['lastname']; ?></td>
							<td><?= $city['city']; ?></td>
							<td><?= $res['address']; ?></td>
							<td><?= $res['phone_number']; ?></td>
						</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			<?php else:  ?>
				<div class="row">
					<div class="col-md-12">	
						<div class="alert alert-warning">
							<strong>Warning!</strong> No pharmacies found!
						</div>
					</div>
			<?php endif ?>
		</div><!-- /.padding-md -->
	</div><!-- /panel -->

<!-- Script Files -->
<?php include('js/scripts/list.php'); ?>