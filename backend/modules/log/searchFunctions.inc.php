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
	case 'fetch_logs':
		
		//db2 is for getting total number of rows
		if(isset($_POST['search_term']) && $_POST['search_term']!=null):
			$db->where('action LIKE "%'.$_POST['search_term'].'%"');
			$db2->where('action LIKE "%'.$_POST['search_term'].'%"');			
		else:
			$db->where('action LIKE "%%"');
			$db2->where('action LIKE "%%"');
		endif;

		if(isset($_POST['user']) && $_POST['user']!=null):
			$db->where('user_id="'.$_POST['user'].'"');
			$db2->where('user_id="'.$_POST['user'].'"');
		else:
			$db->where('user_id LIKE "%%"');
			$db2->where('user_id LIKE "%%"');
		endif;

		$db->orderBy ("date_time","DESC");
		$results = $db->get("log_activity", Array ($limitFrom, $pageLimit));

		//$db->echoQuery();

		$db2->withTotalCount()->get("log_activity");
		$total_log = $db2->totalCount;

		echo '<div class="total-number-customers" align="center"><span class="badge badge-success">'.$total_log.' logs found!</span></div>';
		if($results):
			?>
			<table class="table-font-size table table-striped" id="dataTable">
				<thead>
		      <tr>
		        <th>#</th>
		        <th>Action</th>
		        <th>User</th>
		        <th>Date Time</th>
					</tr>
				</thead>
				<tbody>

			<?php
			$i=$limitFrom;
			foreach($results as $res):
	      $i++;
	    	$db->where('id', $res['user_id']);
	      $user = $db->getOne("users");

	    ?>
					<tr>
						<td><?= $i; ?></td>
						<td><?= isempty($res['action']); ?></td>
			      <td><?= $user['name'].' '.$user['lastname']; ?></td>
			      <td><?= dateTimeUStoEU($res['date_time']); ?></td>
					</tr>

				<?php
				endforeach;
				echo"<tr>
					<td colspan='7' style='background-color: #ffffff;'><div style='float:right;'>";
					$pager->byPage = $pageLimit;
					$pager->rows = $total_log;
					$from = $pager->fromPagination();
					$pages = $pager->pages();
					!isset($page) ? $page=1 : $page;
					if(isset($pages)){
						echo '<div class="pagination">';
							foreach ($pages as $key){
								if($key['p']==$page) {
									echo '<a href="javascript:void(0);" class="active"  onclick="update_logs('.$key['p'].');">'.$key['page'].'</a>';
								} else {
									echo '<a href="javascript:void(0);" onclick="update_logs('.$key['p'].');">'.$key['page'].'</a>';
								}
							}
						echo '</div>';
						}
					echo"</div></td>
				</tr>";


			else:
				echo'<div class="alert alert-danger">
							<strong>No logs Found with these criterias!</strong> Change a few things up and try submitting again.
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
