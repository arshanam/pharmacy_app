	<h3 class="headline m-top-md">
		<div class="float-left">Listing Customers: </div>
		<a href="customer/add" class="btn btn-primary btn-sm">New Customer</a></div>
		<div class="clear"></div>

		<span class="line"></span>
	</h3>
    <?php
        $db2 = new MysqliDb (DBHOST, DBUSER, DBPASS, DBNAME);
    ?>
	<?php //check_for_notifications(); ?>

	<?php $results = $db->get("customer"); ?>

	<div class="panel panel-default table-responsive">
		<div class="padding-md clearfix">
			<?php if($results): ?>
				<table style="font-size: 12px;" class="table table-striped" id="dataTable">
					<thead>
						<tr>
							<th>#</th>
                            <th>Card Code</th>
                            <th>Card Name</th>
                            <th>Group Code</th>
                            <th>Group Name</th>
							<th>Region</th>
							<th>Address</th>
							<th>Phone</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$i=0;
							foreach($results as $res):
								$db->where('id', $res['region']);
								$region = $db->getOne("region");

                                $db2->where('group_code', $res['group_code']);
                                $group = $db2->getOne("groups");

                                $i++;
						?>					
						<tr>
							<td><?= $i; ?></td>
							<td><?= $res['card_code']; ?></td>
                            <td><?= $res['card_name']; ?></td>
                            <td><?= $res['group_code']; ?></td>
                            <td><?= $group['group_name']; ?></td>
							<td><?= $region['title']; ?></td>
							<td><?= $res['address']; ?></td>
							<td><?= $res['phone1']; ?></td>
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