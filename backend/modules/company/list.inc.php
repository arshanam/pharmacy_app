	<h3 class="headline m-top-md">
		Listing Companies: 
		<span class="line"></span>
	</h3>

	<?php	$results = $db->select("companies"); ?>

	<div class="panel panel-default table-responsive">
		<div class="padding-md clearfix">
			<?php if($results): ?>
				<table class="table table-striped" id="dataTable">
					<thead>
						<tr>
							<th>Title</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($results as $res):
							$res['status'] == 1 ? $status = '<span class="label label-success">Active</span>' : $status = '<span class="label label-danger">Disabled</span>';

						?>				
						<tr>
							<td><?= $res['title']; ?></td>
							<td><?= $status; ?></td>
						</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			<?php else:  ?>
				<div class="row">
					<div class="col-md-12">	
						<div class="alert alert-warning">
							<strong>Warning!</strong> No companies found!
						</div>
					</div>
			<?php endif ?>
		</div><!-- /.padding-md -->
	</div><!-- /panel -->

<!-- Script Files -->
<?php include('js/scripts/list.php'); ?>

	