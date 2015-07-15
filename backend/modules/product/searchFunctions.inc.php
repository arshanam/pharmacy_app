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
	case 'fetch_products':
		
		//db2 is for getting total number of rows
		if(isset($_POST['search_term']) && $_POST['search_term']!=null):
			$db->where('(item_code LIKE "%'.$_POST['search_term'].'%"');
			$db->orWhere('barcode LIKE "%'.$_POST['search_term'].'%"');
			$db->orWhere('description LIKE "%'.$_POST['search_term'].'%")');
			
			$db2->where('(item_code LIKE "%'.$_POST['search_term'].'%"');
			$db2->orWhere('barcode LIKE "%'.$_POST['search_term'].'%"');
			$db2->orWhere('description LIKE "%'.$_POST['search_term'].'%")');
			
		else:
			$db->where('(item_code LIKE "%%"');
			$db->orWhere('barcode LIKE "%%"');
			$db->orWhere('description LIKE "%%")');			

			$db2->where('(item_code LIKE "%%"');
			$db2->orWhere('barcode LIKE "%%"');
			$db2->orWhere('description LIKE "%%")');
		endif;

		if(isset($_POST['supplier']) && $_POST['supplier']!=null):
			$db->where('supplier="'.$_POST['supplier'].'"');
			$db2->where('supplier="'.$_POST['supplier'].'"');
		else:
			$db->where('supplier LIKE "%%"');
			$db2->where('supplier LIKE "%%"');
		endif;

		if(isset($_POST['category']) && $_POST['category']!=null):
			$db->where('category="'.$_POST['category'].'"');
			$db2->where('category="'.$_POST['category'].'"');
		else:
			$db->where('category LIKE "%%"');
			$db2->where('category LIKE "%%"');
		endif;		

		if(isset($_POST['status']) && $_POST['status']!=null):
			$db->where('status="'.$_POST['status'].'"');
			$db2->where('status="'.$_POST['status'].'"');
		else:
			$db->where('status LIKE "%%"');
			$db2->where('status LIKE "%%"');
		endif;
		

		$results = $db->get("product", Array ($limitFrom, $pageLimit));

		//$db->echoQuery();

		$db2->withTotalCount()->get("product");
		//$db2->echoQuery();
		$total_products = $db2->totalCount;

		echo '<div class="total-number-customers" align="center"><span class="badge badge-success">'.$total_products.' products found!</span></div>';
		if($results):
			?>
			<table class="table-font-size table table-striped" id="dataTable">
				<thead>
		      <tr>
		        <th>#</th>
		        <th>Item Code</th>
		        <th>Barcode</th>
		        <th>Description</th>
		        <th>Supplier</th>
		        <th>Category</th>
		        <th>W/Sale</th>
		        <th>Retail</th>
		        <th>VAT</th>
		        <th>Edit</th>
					</tr>
				</thead>
				<tbody>

			<?php
			$i=$limitFrom;
			foreach($results as $res):
				$db->where('id', $res['supplier']);
				$supplier = $db->getOne("product_supplier");

	      $db->where('id', $res['category']);
	      $category = $db->getOne("product_category");

	      $i++;
	    ?>
					<tr>
						<td><?= $i; ?></td>
						<td><?= $res['item_code']; ?></td>
			      <td><?= $res['barcode']; ?></td>
			      <td><?= substr($res['description'],0,40);?>...</td>
						<td><?= $supplier['title']; ?></td>
						<td><?= $category['title']; ?></td>
						<td><?= $res['wsale']; ?></td>
						<td><?= $res['retail']; ?></td>
						<td><?= $res['vat']; ?></td>
			      <td><a href="product/add/<?=$res['id'];?>" title="Edit" class="btn btn-primary btn-xs tooltip-test" data-toggle="tooltip" data-placement="top"><i class="fa fa-edit"></i></a></td>
					</tr>

				<?php
				endforeach;
				echo"<tr>
					<td colspan='10' style='background-color: #ffffff;'><div style='float:right;'>";
					$pager->byPage = $pageLimit;
					$pager->rows = $total_products;
					$from = $pager->fromPagination();
					$pages = $pager->pages();
					!isset($page) ? $page=1 : $page;
					if(isset($pages)){
						echo '<div class="pagination">';
							foreach ($pages as $key){
								if($key['p']==$page) {
									echo '<a href="javascript:void(0);" class="active"  onclick="update_products('.$key['p'].');">'.$key['page'].'</a>';
								} else {
									echo '<a href="javascript:void(0);" onclick="update_products('.$key['p'].');">'.$key['page'].'</a>';
								}
							}
						echo '</div>';
						}
					echo"</div></td>
				</tr>";


			else:
				echo'<div class="alert alert-danger">
							<strong>No Products Found with these criterias!</strong> Change a few things up and try submitting again.
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
