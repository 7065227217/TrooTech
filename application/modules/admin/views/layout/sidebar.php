<?php
$urlSegment = $this->uri->segment(2);
 ?>

<aside class="main-sidebar"> 
    <div class="sidebar"> 
        <div class="user-panel">
            <div class="image text-center" style="color:#fff;font-size:25px;">
              Admin
            </div> 
        </div>
        <ul class="sidebar-menu" id="sidebarUl" data-widget="tree">
            <li class="<?php if ($urlSegment == "dashboard") { echo "active"; } ?>"> 
                <a href="<?php echo site_url('admin/dashboard'); ?>">  <img src="<?php echo site_url(); ?>assets/admin/images/sideimg/dashboard.png"  alt="dashboard"> <span>Dashboard</span></a>
            </li>

            <li class="<?php if ($urlSegment == "category-list") { echo "active"; } ?>"> 
                <a href="<?php echo site_url('admin/category-list'); ?>">  <img src="<?php echo site_url(); ?>assets/admin/images/sideimg/dashboard.png"  alt="dashboard"> <span>Category</span></a>
            </li>

            <li class="<?php if ($urlSegment == "product-list") { echo "active"; } ?>"> 
                <a href="<?php echo site_url('admin/product-list'); ?>">  <img src="<?php echo site_url(); ?>assets/admin/images/sideimg/dashboard.png"  alt="dashboard"> <span>Product</span></a>
            </li>
        </ul>
    </div>
</aside>