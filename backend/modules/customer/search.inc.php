<h3 class="headline m-top-md">
	<div class="float-left">Search Customers: </div>
  <div class="clear"></div>
	<span class="line"></span>
</h3>


<table class="table-font-size table table-striped">
	<tr>
		<td>
			<div class="form-group">
				<label for="search_term" class="col-lg-2 control-label">Search Term:</label>
    	  <div class="col-lg-10">
	        <input class="form-control" id="search_term" name="search_term" type="text" value="">
        </div>
	    </div>
		</td>
		<td>
			 <div class="form-group">
        <label for="group_code" class="col-lg-2 control-label">Group:</label>
        <div class="col-lg-6">
          <select id="group_code" name="group_code" class="form-control">
            <option value="">Select: </option>
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
                <option value="">Select: </option>
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

	<div class="panel panel-default table-responsive">
		<div class="padding-md clearfix">
			
				<table class="table-font-size table table-striped" id="">
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
					<tbody class="customers_fetched">
					</tbody>
				</table>
		</div><!-- /.padding-md -->
	</div><!-- /panel -->

	 

<!-- Script Files -->
<?php include('js/scripts/list.php'); ?>
<script src='js/scripts/customer_search.js'></script>

