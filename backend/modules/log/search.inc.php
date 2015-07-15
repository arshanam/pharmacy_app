<h3 class="headline m-top-md">
	<div class="float-left">Log Activity: </div>
  <div class="clear"></div>
	<span class="line"></span>
</h3>

<script type="text/javascript">
  $(document).ready(function(){
    fetch_logs();
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
    <td>
       <div class="form-group">
        <label for="user" class="col-lg-2 control-label padding-top-10">Users:</label>
        <div class="col-lg-6">
          <select id="user" name="user" class="form-control">
            <option value="">All </option>
            <?php
                $users = $db->get("users");
                foreach($users as $user):
                  echo'<option value="'.$user['id'].'">'.$user['name'].' '.$user['lastname'].'</option>';
                endforeach ?>
          </select>
        </div>
      </div>
    </td>
		<td><button class="btn btn-primary btn-sm" onclick="fetch_logs();">Search</button></td>
	</tr>
</table>

	 <div class="logs_fetched"></div>
  </div><!-- /.padding-md -->
</div><!-- /panel -->

<script src='js/scripts/logs_search.js'></script>
<?php include('js/scripts/list.php'); ?>