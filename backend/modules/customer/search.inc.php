<h3 class="headline m-top-md">
	<div class="float-left">Search Customers: </div>
	 <div class="float-right margin-right-20"><a href="customer/add" class="btn btn-primary btn-sm">New Customer</a></div>
  <div class="clear"></div>
	<span class="line"></span>
</h3>

<script type="text/javascript">
  $(document).ready(function(){
    fetch_customers();
  });
</script>


<table class="table-font-size table table-striped">
	<tr>
		<td colspan="2">
			<div class="form-group">
				<label for="search_term" class="col-lg-2 control-label">Search Term:</label>
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
        <label for="group_code" class="col-lg-2 control-label">Group:</label>
        <div class="col-lg-6">
          <select id="group_code" name="group_code" class="form-control">
            <option value="">All </option>
            <?php
                $groups = $db->get("groups");
                foreach($groups as $group):
                 // $group['group_code']==$customer['group_code'] ? $selected='selected' : $selected='';
                  echo'<option value="'.$group['group_code'].'">'.$group['group_name'].'</option>';
                endforeach ?>
          </select>
        </div>
    	</div>
		</td>
		<td>
			 <div class="form-group">
        <label class="col-lg-2 control-label" for="region">Region:</label>
        <div class="col-lg-6">
            <select id="region" name="region" class="form-control">
                <option value="">All </option>
                <?php
                    $regions = $db->get("region");
                    foreach($regions as $reg):
                   //   $reg['id']==$customer['region'] ? $region_selected='selected' : $region_selected='';
                      echo'<option value="'.$reg['id'].'">'.$reg['title'].'</option>';
                    endforeach ?>
            </select>
        </div>
        <div class="col-lg-5"></div>
    	</div><!-- /form-group -->
		</td>
		<td><button class="btn btn-primary btn-sm" onclick="fetch_customers();">Search</button></td>
	</tr>
</table>

<!--
	<div class="panel panel-default table-responsive">
		<div class="padding-md clearfix">
			<div>Number of Results:
				<select name="pageLimit">
				<option value="10">10</option>
				<option value="100">100</option>
				<option value="200">200</option>
				</select>
			</div>
-->
			<div class="customers_fetched"></div>
		</div><!-- /.padding-md -->
	</div><!-- /panel -->

<script src='js/scripts/customer_search.js'></script>

