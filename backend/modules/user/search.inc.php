<h3 class="headline m-top-md">
	<div class="float-left">Search Users: </div>
	 <div class="float-right margin-right-20"><a href="user/add" class="btn btn-primary btn-sm">New User</a></div>
  <div class="clear"></div>
	<span class="line"></span>
</h3>

<script type="text/javascript">
  $(document).ready(function(){
    fetch_users();
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
		<td><button class="btn btn-primary btn-sm" onclick="fetch_users();">Search</button></td>
	</tr>
</table>

	 <div class="users_fetched"></div>
  </div><!-- /.padding-md -->
</div><!-- /panel -->

<script src='js/scripts/user_search.js'></script>
<?php include('js/scripts/list.php'); ?>