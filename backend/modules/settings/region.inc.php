
<h3 class="headline m-top-md">
		<div>Regions: </div>
		<span class="line"></span>
</h3>

<?php
  if(isset($_SESSION['result']) && $_SESSION['result']!=''):
    check_for_notifications($_SESSION['result']['msg'],$_SESSION['result']['res']);
  endif;
?>

<?php

  $db->orderBy('id','ASC');
  $results = $db->get("region"); ?>

	<div class="panel panel-default table-responsive">
		<div class="padding-md clearfix">
			<?php if($results): ?>
				<table class="table table-font-size" style="max-width: 400px;">
					<thead>
            <tr>
              <th>#</th>
              <th>Title</th>
              <th>Edit</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$i=0;
							foreach($results as $res):
              $i++;
						?>					
						<tr>
							<td><?= $i; ?></td>
							<td><?= $res['title']; ?></td>
              <td>
                <a href="customer/add/<?=$res['id'];?>" title="Edit" class="btn btn-primary btn-sm tooltip-test" data-toggle="tooltip" data-placement="top"><i class="fa fa-edit"></i></a>
              </td>
						</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			<?php endif; ?>
		</div><!-- /.padding-md -->
	</div><!-- /panel -->

<!-- Script Files -->
<?php include('js/scripts/add.php'); ?>
<?php include('js/scripts/list.php'); ?>