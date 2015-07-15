<?php
  if(isset($_SESSION['result']) && $_SESSION['result']!=''):
    check_for_notifications($_SESSION['result']['msg'],$_SESSION['result']['res']);
  endif;
?>

<?php
    $customer_count = $db->getValue ("customer", "count(*)");
    $product_count = $db->getValue ("product", "count(*)");

?>

    <div class="main-menu">
      <ul>
       	<li class="<?=(!isset($_REQUEST['module'])) || (isset($_REQUEST['module']) && $_REQUEST['module']=='dashboard')  ? 'active' : '';?>">
            <a href="dashboard">
              <span class="menu-icon">
                  <i class="fa fa-desktop fa-lg"></i>
              </span>
              <span class="text">
                  Dashboard
              </span>
              <span class="menu-hover"></span>
          </a>
        </li>


			<!-- Customers -->
			<li class="openable open <?=isset($_REQUEST['module']) && $_REQUEST['module']=='customer' ? 'active' : '';?>">
				<a href="#">
          <span class="menu-icon"><i class="fa fa-user fa-lg">&nbsp;</i></span>
					<span class="text">Customers</span>
          <!--<span class="badge badge-danger m-left-xs"><?=$customer_count;?></span>-->
          <span class="menu-hover"></span>
				</a>  
				<ul class="submenu">
          <li class="<?=isset($_REQUEST['action']) && $_REQUEST['action']=='search' ? 'active' : '';?>">
            <a href="customer/search">
              <span class="menu-icon"><i class="fa fa-search fa-lg"> &nbsp;</i></span>
              <span class="submenu-label">Search Customer</span>
            </a>
          </li>


				</ul>
			</li>
			<!-- /Customers -->

			<!-- Products -->
			<li class="openable open <?=isset($_REQUEST['module']) && $_REQUEST['module']=='product' ? 'active' : '';?>">
				<a href="#">
          <span class="menu-icon"><i class="fa fa-file-text fa-lg">&nbsp;</i></span>
					<span class="text">Products</span>
          <span class="menu-hover"></span>
				</a>  
				<ul class="submenu">
          <li class="<?=isset($_REQUEST['action']) && $_REQUEST['action']=='search' ? 'active' : '';?>">
            <a href="product/search">
              <span class="menu-icon"><i class="fa fa-search fa-lg"> &nbsp;</i></span>
              <span class="submenu-label">Search Products</span>
            </a>
          </li>
				</ul>
			</li>





			<!-- Seetings -->
        <!--
			<li class="openable open">
				<a href="#">
					<span class="menu-icon">
						<i class="fa fa-cogs fa-lg"></i> 
					</span>
					<span class="text">Settings</span>
					<span class="menu-hover"></span>
				</a>
				<ul class="submenu">
          <li>
            <a href="settings/groups">
              <span class="menu-icon"><i class="fa fa-cog fa-lg"> &nbsp;</i></span>
              <span class="submenu-label">Customer Groups</span>
            </a>
          </li>
          <li>
            <a href="settings/region">
              <span class="menu-icon"><i class="fa fa-cog fa-lg"> &nbsp;</i></span>
              <span class="submenu-label">Customer Regions</span>
            </a>
          </li>
				</ul>
			</li>
			-->
			<!-- /Settings -->
<!--
						<li class="openable">
							<a href="#">
								<span class="menu-icon">
									<i class="fa fa-tag fa-lg"></i> 
								</span>
								<span class="text">
									Component
								</span>
								<span class="badge badge-success bounceIn animation-delay5">9</span>
								<span class="menu-hover"></span>
							</a>
							<ul class="submenu">
								<li><a href="ui_element.html"><span class="submenu-label">UI Features</span></a></li>
								<li><a href="button.html"><span class="submenu-label">Button & Icons</span></a></li>
								<li><a href="form_wizard.html"><span class="submenu-label">Form Wizard</span></a></li>
							</ul>
						</li>
	-->								
					</ul>
</div>
