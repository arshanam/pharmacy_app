<h3 class="headline m-top-md">
	<div class="float-left">Search Customers: </div>
	 <div class="float-right margin-right-20"><a href="customer/add" class="btn btn-primary btn-sm">New Customer</a></div>
  <div class="clear"></div>
	<span class="line"></span>
</h3>

<?php
  if(isset($_SESSION['result']) && $_SESSION['result']!=''):
    check_for_notifications($_SESSION['result']['msg'],$_SESSION['result']['res']);
  endif;
?>

<script type="text/javascript">
  $(document).ready(function(){
    //fetch_customers();
  });
</script>


<table class="table-font-size table table-striped">
	<tr>
		<td colspan="2">
			<div class="form-group">
				<label for="search_term" class="col-lg-2 control-label padding-top-10">Search Term:</label>
    	  <div class="col-lg-10">
          <input type='hidden' name='pager__' class='pager__' value='1'>
	        <input class="form-control" id="search_term" name="search_term" type="text" value="">
        </div>
	    </div>
		</td>
  </tr>
  <tr>
		<td>
			 <div class="form-group">
        <label for="group_code" class="col-lg-2 control-label padding-top-10">Group:</label>
        <div class="col-lg-6">
          <select id="group_code" name="group_code" class="form-control">
            <option value="">All </option>
            <?php
                $groups = $db->get("groups");
                foreach($groups as $group):
                  echo'<option value="'.$group['group_code'].'">'.$group['group_name'].'</option>';
                endforeach ?>
          </select>
        </div>
    	</div>
		</td>
		<td>
			 <div class="form-group">
        <label class="col-lg-2 control-label padding-top-10" for="region">Region:</label>
        <div class="col-lg-6">
            <select id="region" name="region" class="form-control">
                <option value="">All </option>
                <?php
                    $regions = $db->get("region");
                    foreach($regions as $reg):
                      echo'<option value="'.$reg['id'].'">'.$reg['title'].'</option>';
                    endforeach ?>
            </select>
        </div>
    	</div><!-- /form-group -->
		</td>
		<td>
				<div class="form-group">
        <label class="col-lg-2 control-label padding-top-10" for="status">Status:</label>
        <div class="col-lg-6">
            <select id="status" name="status" class="form-control">
                <option value="">All </option>
                <option value="1">Enabled</option>
                <option value="0">Disabled</option>
            </select>
        </div>
    	</div><!-- /form-group -->
		</td>
		<td><button class="btn btn-primary btn-sm" onclick="fetch_customers();">Search</button></td>
	</tr>
</table>

			<div class="customers_fetched"></div>
		</div><!-- /.padding-md -->
	</div><!-- /panel -->

<script src='js/scripts/customer_search.js'></script>
<?php include('js/scripts/list.php'); ?>

