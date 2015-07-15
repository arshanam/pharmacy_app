<?php
error_reporting(E_ALL);
session_start();
require_once '../../classes/class.mysqli.php';
require_once '../../includes/required.inc.php';
require_once '../../classes/class.encryption.php';
require_once '../../classes/class.log.php';
require_once '../../classes/class.user.php';
include_once '../../classes/class.form.php';
include_once '../../classes/class.pager.php';
$pager= new paginator();
$form = new Form();
$log = new LogActivity();

$db2 = new MysqliDb (DBHOST, DBUSER, DBPASS, DBNAME);


isset($_POST['page']) ? $currentPage=$_POST['page'] : $currentPage=0;
$pageLimit = 50;
if ($currentPage == 0) $currentPage = 1;
$limitFrom = ($pageLimit * $currentPage) - $pageLimit;

switch ($_POST['f']) {

	//search by region
	case 'fetch_users':
		
		//db2 is for getting total number of rows
		if(isset($_POST['search_term']) && $_POST['search_term']!=null):
			$db->where('(username LIKE "%'.$_POST['search_term'].'%"');
			$db->orWhere('name LIKE "%'.$_POST['search_term'].'%"');
			$db->orWhere('lastname LIKE "%'.$_POST['search_term'].'%")');
			
			$db2->where('(username LIKE "%'.$_POST['search_term'].'%"');
			$db2->orWhere('name LIKE "%'.$_POST['search_term'].'%"');
			$db2->orWhere('lastname LIKE "%'.$_POST['search_term'].'%")');
			
		else:
			$db->where('(username LIKE "%%"');
			$db->orWhere('name LIKE "%%"');
			$db->orWhere('lastname LIKE "%%")');			

			$db2->where('(username LIKE "%%"');
			$db2->orWhere('name LIKE "%%"');
			$db2->orWhere('lastname LIKE "%%")');
		endif;

		$results = $db->get("users", Array ($limitFrom, $pageLimit));

		//$db->echoQuery();

		$db2->withTotalCount()->get("users");
		//$db2->echoQuery();
		$total_users = $db2->totalCount;

		echo '<div class="total-number-customers" align="center"><span class="badge badge-success">'.$total_users.' users found!</span></div>';
		if($results):
			?>
			<table class="table-font-size table table-striped" id="dataTable">
				<thead>
		      <tr>
		        <th>#</th>
		        <th>Name</th>
		        <th>Lastname</th>
		        <th>Email</th>
		        <th>Username</th>
		        <th>Backend Login</th>
		        <th>Edit</th>
					</tr>
				</thead>
				<tbody>

			<?php
			//fa-minus-circle
			//fa-plus-circle
			$i=$limitFrom;
			foreach($results as $res):
	      $i++;
	    	$res['backend_login']==1 ? $backend_login = '<i title="Yes" alt="Yes" class="fa fa-plus-circle fa-sm"> &nbsp;</i>' : $backend_login='<i title="No" alt="No" class="fa fa-minus-circle fa-sm"> &nbsp;</i>';
	    ?>
					<tr>
						<td><?= $i; ?></td>
						<td><?= isempty($res['name']); ?></td>
			      <td><?= isempty($res['lastname']); ?></td>
			      <td><?= isempty($res['email']); ?></td>
						<td><?= $res['username']; ?></td>
						<td><div style="padding-left: 40px;"><?= $backend_login; ?></div></td>
						<td><a href="user/add/<?=$res['id'];?>" title="Edit" class="btn btn-primary btn-xs tooltip-test" data-toggle="tooltip" data-placement="top"><i class="fa fa-edit"></i></a></td>
					</tr>

				<?php
				endforeach;
				echo"<tr>
					<td colspan='5' style='background-color: #ffffff;'><div style='float:right;'>";
					$pager->byPage = $pageLimit;
					$pager->rows = $total_users;
					$from = $pager->fromPagination();
					$pages = $pager->pages();
					!isset($page) ? $page=1 : $page;
					if(isset($pages)){
						echo '<div class="pagination">';
							foreach ($pages as $key){
								if($key['p']==$page) {
									echo '<a href="javascript:void(0);" class="active"  onclick="update_users('.$key['p'].');">'.$key['page'].'</a>';
								} else {
									echo '<a href="javascript:void(0);" onclick="update_users('.$key['p'].');">'.$key['page'].'</a>';
								}
							}
						echo '</div>';
						}
					echo"</div></td>
				</tr>";


			else:
				echo'<div class="alert alert-danger">
							<strong>No users Found with these criterias!</strong> Change a few things up and try submitting again.
						</div>';

			endif;
			?>


				</tbody>
			</table>
		<?php
		break;

	default:
		# code...
		break;
}

?>
