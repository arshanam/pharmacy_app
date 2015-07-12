<?php isset($_GET['id']) ? $edit=true : $edit=false; ?>

<?php

	if($_SERVER['REQUEST_METHOD'] && $_SERVER['REQUEST_METHOD']=='POST'):
		
		$insert = array(
		    "group_name" => post_text_variable($_POST['group_name']),
		    "group_code" => post_text_variable($_POST['group_code'])
		);

    if(isset($_GET['id'])){
      $db->where ('id', $_GET['id']);
      $res = $db->update ('groups', $insert);
      $action_msg='<b>Group '.$_POST['group_name'].'</b> Updated!';
      $res ? $_SESSION['result']=array('res'=>'gritter-success','msg'=>$action_msg) : $_SESSION['msg']=array('res'=>'gritter-danger','msg'=>'Not updated! Please try again!');
    }else{
      $res = $db->insert("groups", $insert);
      $action_msg='<b>Group '.$_POST['group_name'].'</b> Added!';
      $res ? $_SESSION['result']=array('res'=>'gritter-success','msg'=>$action_msg) : $_SESSION['msg']=array('res'=>'gritter-danger','msg'=>'Not added! Please try again!');
    }
    create_log_action($_SESSION['user_id'], $action_msg);    
		echo'<meta http-equiv="refresh" content="0;url='.BASEURL.'customer/groups">';

  else:

	  if(isset($_SESSION['result']) && $_SESSION['result']!=''):
	    check_for_notifications($_SESSION['result']['msg'],$_SESSION['result']['res']);
	  endif;

	  if($edit):
	    $db->where ("id", $_GET['id']);
	    $groups = $db->getOne("groups");
	  endif;

	  $db->orderBy('id','ASC');
	  $results = $db->get("groups"); ?>

		<div class="panel panel-default table-responsive">
			<div class="padding-md clearfix">
				<?php if($results): ?>
					<div class=" col-lg-4 col-md-4 col-sm-12">
						<h3 class="headline m-top-md">
								<div>Groups: </div>
								<span class="line"></span>
						</h3>
						<table class="table table-font-size float-left">
							<thead>
		            <tr>
		              <th>#</th>
		              <th>Group Code</th>
		              <th>Group Name</th>
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
									<td><?= $res['group_code']; ?></td>
									<td><?= $res['group_name']; ?></td>
		              <td>
		                <a href="customer/groups/<?=$res['id'];?>" title="Edit" class="btn btn-primary btn-sm tooltip-test" data-toggle="tooltip" data-placement="top"><i class="fa fa-edit"></i></a>
		              </td>
								</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
					<div class="col-lg-8 col-md-8 col-sm-12">
						<h3 class="headline m-top-md">
								<?= $edit ? '<div class="float-left">Edit:</div><div class="float-right"><a href="customer/groups" class="btn btn-primary btn-sm">Add New</a></div>' : '<div>Add New: </div>'; ?>
								<div class="clear"></div>
								<span class="line"></span>
						</h3>
						<form id="formToggleLine" class="form-horizontal no-margin form-border" name="" action="customer/groups<?= isset($_GET['id']) ? '/'.$_GET['id'] : '';?>" method="POST">
							<?= $form->text_field('group_code', 'Group Code',$edit ? $groups['group_code'] : ''); ?>
							<?= $form->text_field('group_name', 'Group Name',$edit ? $groups['group_name'] : ''); ?>
							<?= $form->submit_button('Submit') ?>
						</form>
					</div>
				<?php
					endif;
				endif;
				?>
		</div><!-- /.padding-md -->
	</div><!-- /panel -->

<!-- Script Files -->
<?php include('js/scripts/add.php'); ?>
<?php include('js/scripts/list.php'); ?>