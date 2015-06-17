<?php
error_reporting(E_ALL);
session_start();
require_once '../../classes/class.mysqli.php';
require_once '../../includes/required.inc.php';
require_once '../../classes/class.encryption.php';
require_once '../../classes/class.log.php';
require_once '../../classes/class.user.php';
include_once('../../classes/class.form.php');
include_once '../../classes/class.pager.php';
$pager= new paginator();
$form = new Form();
$log = new LogActivity();

$db2 = new MysqliDb (DBHOST, DBUSER, DBPASS, DBNAME);


isset($_POST['page']) ? $currentPage=$_POST['page'] : $currentPage=0;
$pageLimit = 10;
if ($currentPage == 0) $currentPage = 1;
$limitFrom = ($pageLimit * $currentPage) - $pageLimit;

switch ($_POST['f']) {

	//search by region
	case 'fetch_customers':
		
		//db2 is for getting total number of rows
		if(isset($_POST['search_term']) && $_POST['search_term']!=null):
			$db->where('(card_code LIKE "%'.$_POST['search_term'].'%"');
			$db->orWhere('card_name LIKE "%'.$_POST['search_term'].'%"');
			$db->orWhere('address LIKE "%'.$_POST['search_term'].'%"');
			$db->orWhere('city LIKE "%'.$_POST['search_term'].'%"');
			$db->orWhere('phone1 LIKE "%'.$_POST['search_term'].'%"');
			$db->orWhere('phone2 LIKE "%'.$_POST['search_term'].'%"');
			$db->orWhere('cellular LIKE "%'.$_POST['search_term'].'%"');
			$db->orWhere('fax LIKE "%'.$_POST['search_term'].'%"');
			$db->orWhere('contact_person LIKE "%'.$_POST['search_term'].'%"');
			$db->orWhere('country LIKE "%'.$_POST['search_term'].'%"');
			$db->orWhere('email LIKE "%'.$_POST['search_term'].'%")');
			
			$db2->where('(card_code LIKE "%'.$_POST['search_term'].'%"');
			$db2->orWhere('card_name LIKE "%'.$_POST['search_term'].'%"');
			$db2->orWhere('address LIKE "%'.$_POST['search_term'].'%"');
			$db2->orWhere('city LIKE "%'.$_POST['search_term'].'%"');
			$db2->orWhere('phone1 LIKE "%'.$_POST['search_term'].'%"');
			$db2->orWhere('phone2 LIKE "%'.$_POST['search_term'].'%"');
			$db2->orWhere('cellular LIKE "%'.$_POST['search_term'].'%"');
			$db2->orWhere('fax LIKE "%'.$_POST['search_term'].'%"');
			$db2->orWhere('contact_person LIKE "%'.$_POST['search_term'].'%"');
			$db2->orWhere('country LIKE "%'.$_POST['search_term'].'%"');
			$db2->orWhere('email LIKE "%'.$_POST['search_term'].'%")');

		else:
			$db->where('(card_code LIKE "%%"');
			$db->orWhere('card_name LIKE "%%"');
			$db->orWhere('address LIKE "%%"');
			$db->orWhere('city LIKE "%%"');
			$db->orWhere('phone1 LIKE "%%"');
			$db->orWhere('phone2 LIKE "%%"');
			$db->orWhere('cellular LIKE "%%"');
			$db->orWhere('fax LIKE "%%"');
			$db->orWhere('contact_person LIKE "%%"');
			$db->orWhere('country LIKE "%%"');
			$db->orWhere('email LIKE "%%")');

			$db2->where('(card_code LIKE "%%"');
			$db2->orWhere('card_name LIKE "%%"');
			$db2->orWhere('address LIKE "%%"');
			$db2->orWhere('city LIKE "%%"');
			$db2->orWhere('phone1 LIKE "%%"');
			$db2->orWhere('phone2 LIKE "%%"');
			$db2->orWhere('cellular LIKE "%%"');
			$db2->orWhere('fax LIKE "%%"');
			$db2->orWhere('contact_person LIKE "%%"');
			$db2->orWhere('country LIKE "%%"');
			$db2->orWhere('email LIKE "%%")');
		endif;

		if(isset($_POST['group_code']) && $_POST['group_code']!=null):
			$db->where('group_code="'.$_POST['group_code'].'"');
			$db2->where('group_code="'.$_POST['group_code'].'"');
		else:
			$db->where('group_code LIKE "%%"');
			$db2->where('group_code LIKE "%%"');
		endif;

		if(isset($_POST['region']) && $_POST['region']!=null):
			$db->where('region="'.$_POST['region'].'"');
			$db2->where('region="'.$_POST['region'].'"');
		else:
			$db->where('region LIKE "%%"');
			$db2->where('region LIKE "%%"');
		endif;		

		$results = $db->get("customer", Array ($limitFrom, $pageLimit));

		$db->echoQuery();

		$db2->withTotalCount()->get("customer");
		$db2->echoQuery();
		$total_customers = $db2->totalCount;

		echo '<div class="total-number-customers"><span class="badge badge-success">'.$total_customers.' customers found!</span></div>';

		if($results):
			?>
			<table class="table-font-size table table-striped">
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
			      <td><a href="customer/add/<?=$res['id'];?>" title="Edit" class="btn btn-primary btn-sm tooltip-test" data-toggle="tooltip" data-placement="top"><i class="fa fa-edit"></i></a></td>
					</tr>

				<?php
				endforeach;
				echo"<tr>
					<td colspan='5' style='background-color: #ffffff;'><div style='float:right;'>";
					$pager->byPage = $pageLimit;
					$pager->rows = $total_customers;
					$from = $pager->fromPagination();
					$pages = $pager->pages();
					!isset($page) ? $page=1 : $page;
					if(isset($pages)){
						echo '<div class="pagination">';
							foreach ($pages as $key){
								if($key['p']==$page) {
									echo '<a href="javascript:void(0);" class="active"  onclick="update_customers('.$key['p'].');">'.$key['page'].'</a>';
								} else {
									echo '<a href="javascript:void(0);" onclick="update_customers('.$key['p'].');">'.$key['page'].'</a>';
								}
							}
						echo '</div>';
						}
					echo"</div></td>
				</tr>";


			else:
				echo'<div class="alert alert-danger">
							<strong>No Customers Found with these criterias!</strong> Change a few things up and try submitting again.
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