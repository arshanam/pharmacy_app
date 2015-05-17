	<h3 class="headline m-top-md">
		Listing Pharmacies: 
		<span class="line"></span>
	</h3>

	<?php	$results = $db->select("pharmacy"); ?>

	<div class="panel panel-default table-responsive">
		<div class="padding-md clearfix">
			<?php if($results): ?>
				<table class="table table-striped" id="dataTable">
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
								$city = $db->select("city", "id = ".$res->city);
								$i++;
						?>					
						<tr>
							<td><?= $i; ?></td>
							<td><?= $res->name; ?> <?= $res->lastname; ?></td>
							<td><?= $city; ?></td>
							<td><?= $res->address; ?></td>
							<td><?= $res->phone_number; ?></td>
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