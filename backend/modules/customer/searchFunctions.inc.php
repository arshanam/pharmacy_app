<?php
error_reporting(E_ALL);
session_start();
require_once '../../classes/class.mysqli.php';
require_once '../../includes/required.inc.php';
require_once '../../classes/class.encryption.php';
require_once '../../classes/class.log.php';
require_once '../../classes/class.user.php';
include_once('../../classes/class.form.php');
$form = new Form();
$log = new LogActivity();

isset($_REQUEST['page']) ? $currentPage=$_REQUEST['page'] : $currentPage=0;
$pageLimit = 100;
if ($currentPage == 0) $currentPage = 1;
$limitFrom = ($pageLimit * $currentPage) - $pageLimit;

switch ($_POST['f']) {

	//search by group code
	case 'search_group':
		echo "group";
		break;

	//search by region
	case 'fetch_customers':
		
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
		endif;

		if(isset($_POST['group_code']) && $_POST['group_code']!=null):
			$db->where('group_code="'.$_POST['group_code'].'"');
		else:
			$db->where('group_code LIKE "%%"');
		endif;

		if(isset($_POST['region']) && $_POST['region']!=null):
			$db->where('region="'.$_POST['region'].'"');
		else:
			$db->where('region LIKE "%%"');
		endif;		

		$results = $db->get("customer","200");
		$db->echoQuery();
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