<?php
	error_reporting(0);
	include_once 'classes/class.mysql.php';
	include_once 'includes/config.php';
	include_once 'classes/class.pager.php';
	$db = new mysql();
	$pager= new paginator();
	mysql_query("SET NAMES 'utf8'");

	$currentPage = $_REQUEST["page"];
	$pageLimit = 200;
	if ($currentPage == 0) $currentPage = 1;
	$limitFrom = ($pageLimit * $currentPage) - $pageLimit;

	switch ($_REQUEST['f']) {


		//Save category function
		case 'save_category':
			$save_category=$db->insert_sql("INSERT INTO categories (title) VALUES ('".$_REQUEST['category_title']."')");
			echo"<option value=''>Select Category</option>";
				$category_sql=$db->select("SELECT title FROM categories ORDER BY title ASC");
				while ($category=mysql_fetch_object($category_sql)){
				    echo"<option value='".$category->title."'>".$category->title."</option>";
				}
			break;


		//Save location function
		case 'save_location':
			$location=array();
			$location['location']=$_REQUEST['location_title'];
			$location['city']=$_REQUEST['city_title'];
			$db->insert_array("locations",$location);
			echo "<span class='location_res'></span>";
			break;



		//Get locations based on the city
		case 'get_locations':
				$location_sql=$db->select("SELECT location FROM locations WHERE city='".$_REQUEST['city']."' ORDER BY location ASC");
				echo"<select name='location' class='dropdown location_selected'  onchange='load_customers()'>
				<option value=''>All Locations</option>";
				while ($row=mysql_fetch_object($location_sql)){
			    echo"<option value='".$row->location."'>".$row->location."</option>";
				}
				echo"</select>";

			break;



		//get customers based variables
		case 'load_customers':

			if($_REQUEST['location']=='' || $_REQUEST['location']=='undefined'){
				if($_REQUEST['city']=="" || $_REQUEST['city']=='undefined') $where='WHERE';
				else $where="WHERE city='".$_REQUEST['city']."' AND";
			}
			else $where=" WHERE location='".$_REQUEST['location']."' AND city='".$_REQUEST['city']."' AND";

			if($_REQUEST['category']=='') $and_sql=" category LIKE '%%'";
			else $and_sql="category='".$_REQUEST['category']."'";

			if($_REQUEST['spoke_customer']=='all' or $_REQUEST['spoke_customer']=='') $spoke_customer_sql=" AND contact_client LIKE '%%'";
			elseif($_REQUEST['spoke_customer']=='1') $spoke_customer_sql=" AND contact_client = '1' ";
			else $spoke_customer_sql=" AND contact_client = '0' ";

			if($_REQUEST['climauto_customer']=='all' or $_REQUEST['climauto_customer']=='') $climauto_customer_sql=" AND climauto_customer LIKE '%%'";
			elseif($_REQUEST['climauto_customer']=='1') $climauto_customer_sql=" AND climauto_customer = '1' ";
			else $climauto_customer_sql=" AND climauto_customer = '0' ";

			if($_REQUEST['calibrated']=='all' or $_REQUEST['calibrated']=='') $calibrated_sql=" AND interested LIKE '%%'";
			elseif($_REQUEST['calibrated']=='1') $calibrated_sql=" AND interested = '1' ";
			else $calibrated_sql=" AND interested = '0' ";

			$total_customers=$db->select_one("SELECT COUNT(id) FROM customers $where $and_sql $spoke_customer_sql $climauto_customer_sql $calibrated_sql ORDER BY title ASC");

			$customers_sql=$db->select("SELECT * FROM customers $where $and_sql $spoke_customer_sql $climauto_customer_sql $calibrated_sql ORDER BY title ASC LIMIT ".$limitFrom.", ".$pageLimit);
			echo ("SELECT * FROM customers $where $and_sql $spoke_customer_sql $climauto_customer_sql $calibrated_sql ORDER BY title ASC LIMIT ".$limitFrom.", ".$pageLimit);
			if(mysql_num_rows($customers_sql)){
				while ($row=mysql_fetch_object($customers_sql)){

	    		if($row->contact_client==1) $contact_client="<img src='img/enabled.png' />"; else $contact_client="<img src='img/disabled.png' />";
					if($row->climauto_customer==1) $climauto_customer="<img src='img/enabled.png' />"; else $climauto_customer="<img src='img/disabled.png' />";
					if($row->interested==1) $calibrated="<img src='img/enabled.png' />"; else $calibrated="<img src='img/disabled.png' />";

	    		echo"<tr>
						<td class='align-left'><a href='index.php?select=16&id=".$row->id."&page=".$_REQUEST['page']."'>".$row->title."</a></td>
						<td class='align-left'>".$row->location.", ".$row->city."</td>
						<td class='align-center'>".$contact_client."</td>
						<td class='align-center'>".$calibrated."</td>
						<td class='align-center'>".$climauto_customer."</td>
						<td class='align-center'><a href='index.php?select=13&page=".$_REQUEST['page']."&id=".$row->id."' class='table-icon edit' title='Edit'></a></td>
						<td class='align-center'><a href='index.php?select=15&page=".$_REQUEST['page']."&id=".$row->id."' onclick=\"return askForDelete(this);\" class='table-icon delete' title='Delete'></a></td>
					</tr>";
				}
			}else{
				echo"<tr><td colspan='5' align='center'><div class='n_warning'><p>No customers found with these criterias!</p></div></td></tr>";
			}

			echo"<tr>
				<td colspan='5' style='background-color: #ffffff;'><div style='float:right;'>";
				$pager->byPage = $pageLimit;
				$pager->rows = $total_customers;
				$from = $pager->fromPagination();
				$pages = $pager->pages();
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
			break;



		default:
			return false;
			break;
	}

?>