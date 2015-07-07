
<h3 class="headline m-top-md">
		<div class="float-left">Listing Customers: </div>
    <div class="float-right"><a href="customer/add" class="btn btn-primary btn-sm">New Customer</a></div>
    <div class="clear"></div>
 
		<span class="line"></span>
</h3>

<?php
  if(isset($_SESSION['result']) && $_SESSION['result']!=''):
    check_for_notifications($_SESSION['result']['msg'],$_SESSION['result']['res']);
  endif;
?>

<?php
  $db->orderBy('id');
  $results = $db->get("customer","100"); ?>

  <!--<pre><?php print_r($db); ?></pre>-->

	<div class="panel panel-default table-responsive">
		<div class="padding-md clearfix">
			<?php if($results): ?>
				<table class="table-font-size table table-striped" id="dataTable">
					<thead>
            <tr>
              <th>#</th>
              <th>Card</th>
              <th>Group</th>
              <th>Region</th>
              <th>City</th>
              <th>Phone 1</th>
              <th>Edit</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$i=0;
							foreach($results as $res):
								$db->where('id', $res['region']);
								$region = $db->getOne("region");

                $db->where('group_code', $res['group_code']);
                $group = $db->getOne("groups");

                $i++;
						?>					
						<tr>
							<td><?= $i; ?></td>
							<td><?= $res['card_code']; ?> - <?= $res['card_name']; ?></td>
              <td><?= $res['group_code']; ?> - <?= $group['group_name']; ?></td>
							<td><?= $region['title']; ?></td>
							<td><?= $res['city']; ?></td>
							<td><?= $res['phone1']; ?></td>
              <td>
                <a href="customer/add/<?=$res['id'];?>" title="Edit" class="btn btn-primary btn-sm tooltip-test" data-toggle="tooltip" data-placement="top"><i class="fa fa-edit"></i></a>
                <!--<a href="customer/disable/<?=$res['id'];?>" title="Delete" class="btn btn-primary btn-sm tooltip-test" data-toggle="tooltip" data-placement="top"><i class="fa fa-times"></i></a>-->
              </td>
						</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			<?php else:  ?>
				<div class="row">
					<div class="col-md-12">	
						<div class="alert alert-warning">
							<strong>Warning!</strong> No customers found!
						</div>
					</div>
        </div>
			<?php endif; ?>
		</div><!-- /.padding-md -->
	</div><!-- /panel -->

<!-- Script Files -->
<?php include('js/scripts/list.php'); ?>