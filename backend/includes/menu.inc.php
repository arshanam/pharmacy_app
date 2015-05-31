<?php
    $customer_count = $db->getValue ("customer", "count(*)");
    $product_count = $db->getValue ("product", "count(*)");
?>

    <div class="main-menu">
      <ul>
        <li>
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
						

						<!-- PHARMACIES -->
						<!--
						<li class="openable open">
							<a href="#">
								<span class="menu-icon">
									<i class="fa fa-plus-square fa-lg"></i> 
								</span>
								<span class="text">Pharmacies</span>
								<span class="menu-hover"></span>
							</a>  
							<ul class="submenu">
								<li><a href="pharmacy/list"><span class="submenu-label">List Pharmacies</span></a></li>
								<li><a href="pharmacy/add"><span class="submenu-label">Add Pharmacy</span></a></li>
							</ul>
						</li>
						-->
						<!-- /PHARMACIES -->

						<!-- Customers -->

						<li class="openable open">
							<a href="#">
                <span class="menu-icon"><i class="fa fa-user fa-lg">&nbsp;</i></span>
								<span class="text">Customers</span>
                <span class="badge badge-danger m-left-xs"><?=$customer_count;?></span>
                <span class="menu-hover"></span>
							</a>  
							<ul class="submenu">
                <li>
                  <a href="customer/search">
                    <span class="menu-icon"><i class="fa fa-search fa-lg"> &nbsp;</i></span>
                    <span class="submenu-label">Search Customer</span>
                  </a>
                </li>
                <li>
                  <a href="customer/add">
                    <span class="menu-icon"><i class="fa fa-plus fa-lg"> &nbsp;</i></span>
                    <span class="submenu-label">Add Customer</span>
                  </a>
                </li>
                <li>
                  <a href="customer/list">
                    <span class="menu-icon"><i class="fa fa-list fa-lg"> &nbsp;</i></span>
                    <span class="submenu-label">List ALL Customers</span>
                  </a>
                </li>
                <li>
                  <a href="customer/importCustomers">
                    <span class="menu-icon"><i class="fa fa-cloud-upload fa-lg"> &nbsp;</i></span>
                    <span class="submenu-label"> Import Customers</span>
                  </a>
                </li>
							</ul>
						</li>
						<!-- /Customers -->


						<!-- Products -->
						<li class="openable open">
							<a href="#">
								<span class="menu-icon">
									<i class="fa fa-file-text fa-lg"></i> 
								</span>
								<span class="text">Products</span>
                <span class="badge badge-danger m-left-xs"><?=$product_count;?></span>
								<span class="menu-hover"></span>
							</a>
							<ul class="submenu">
                <li>
                  <a href="product/list">
                    <span class="menu-icon"><i class="fa fa-list fa-lg"> &nbsp;</i></span>
                    <span class="submenu-label">List Products</span>
                  </a>
                </li>
								<li>
                  <a href="product/add">
                    <span class="menu-icon"><i class="fa fa-plus fa-lg"> &nbsp;</i></span>
                    <span class="submenu-label">Add Product</span>
                  </a>
                </li>
							</ul>
						</li>

						<!-- /Companies -->
						
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
										
					</ul>
</div>
