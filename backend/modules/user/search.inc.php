<h3 class="headline m-top-md">
	<div class="float-left">Search Products: </div>
	 <div class="float-right margin-right-20"><a href="product/add" class="btn btn-primary btn-sm">New Product</a></div>
  <div class="clear"></div>
	<span class="line"></span>
</h3>

<script type="text/javascript">
  $(document).ready(function(){
    fetch_products();
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
        <label for="supplier" class="col-lg-2 control-label padding-top-10">Suppliers:</label>
        <div class="col-lg-6">
          <select id="supplier" name="supplier" class="form-control">
            <option value="">All </option>
            <?php
                $suppliers = $db->get("product_supplier");
                foreach($suppliers as $supplier):
                  echo'<option value="'.$supplier['id'].'">'.$supplier['title'].'</option>';
                endforeach ?>
          </select>
        </div>
    	</div>
		</td>
		<td>
			 <div class="form-group">
        <label class="col-lg-2 control-label padding-top-10" for="category">Categories:</label>
        <div class="col-lg-6">
            <select id="category" name="category" class="form-control">
                <option value="">All </option>
                <?php
                    $categories = $db->get("product_category");
                    foreach($categories as $cat):
                      echo'<option value="'.$cat['id'].'">'.$cat['title'].'</option>';
                    endforeach ?>
            </select>
        </div>
        <div class="col-lg-5"></div>
    	</div><!-- /form-group -->
		</td>
		<td><button class="btn btn-primary btn-sm" onclick="fetch_products();">Search</button></td>
	</tr>
</table>

	 <div class="products_fetched"></div>
  </div><!-- /.padding-md -->
</div><!-- /panel -->

<script src='js/scripts/product_search.js'></script>
<?php include('js/scripts/list.php'); ?>