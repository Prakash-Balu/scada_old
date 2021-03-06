<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$region_list = $this->Common_model->get_region_site_list();
foreach($region_list as $list)
{
  $menu[$list['Region']][$list['Site_Location']][] = $list['Device_Name'];
}
//echo '<pre>';print_r($menu);exit;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="<?php echo base_url();?>assets/images/favicon.ico" type="image/ico" />

    <title>SCADA </title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url();?>assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url();?>assets/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo base_url();?>assets/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
	
    <!-- bootstrap-progressbar -->
    <link href="<?php echo base_url();?>assets/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="<?php echo base_url();?>assets/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-datetimepicker -->
    <link href="<?php echo base_url();?>assets/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo base_url();?>assets/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Datatables -->
    <link href="<?php echo base_url();?>assets/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url();?>assets/build/css/custom.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <!-- <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Versatile Scada</span></a>
            </div> -->

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="<?php echo base_url();?>assets/images/user.png" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php echo $this->session->userdata('username'); ?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <ul class="nav side-menu">
                  <li><a href="<?php echo base_url().'dashboard';?>"><i class="fa fa-home"></i> Dashboard</a></li>
                  <li><a href="<?php echo base_url().'dashboard/park_view';?>"><i class="fa fa-edit"></i> ParkView </a></li>
                  <li><a><i class="fa fa-sitemap"></i> Region Wise <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <?php if(!empty($menu)) {
                              foreach($menu as $key=>$sub) {
                            ?>
                        <li><a><?php echo $key;?><span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <?php foreach($sub as $key => $val){ ?>
                            <li class="sub_menu"><a href="#"> <span class="fa fa-chevron-down"></span><?php echo $key;?></a>
                              <ul class="nav child_menu">
                              <?php foreach($val as $device){ ?>
                                <li class="sub_menu"><a href="#"><?php echo $device;?></a>
                                </li>
                              <?php } ?> 
                            </ul>
                            </li>
                          <?php } ?> 
                          </ul>
                        </li>
                              <?php } } ?>
                        </li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-bar-chart-o"></i> Analytics <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li class="sub_menu"><a href="<?php echo base_url().'dashboard/temp_analysis';?>"></span>Temperature</a>
                      </li>
                      <li class="sub_menu"><a href="<?php echo base_url().'dashboard/powercurve_analysis';?>"></span>Power Curve</a>
                      </li>
                      <li class="sub_menu"><a href="<?php echo base_url().'dashboard/performance_analysis';?>"></span>Performance</a>
                      </li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-clone"></i>Reports</a></li>
                  <li><a><i class="fa fa-clone"></i>Avg Wind Speed: <?php echo $this->session->userdata('avgWindSpeedSum').'m/s';?></a></li>
                  <li><a><i class="fa fa-clone"></i>Total Power: <?php echo $this->session->userdata('powerSpeedSum').'MW';?></a></li>
                  <li><a><i class="fa fa-clone"></i>Total Export Today: <?php echo $this->session->userdata('patGenSum').'Kwh';?></a></li>
                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <!--<div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>-->
            <!-- /menu footer buttons -->
          </div>
        </div>
        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="images/img.jpg" alt=""><?php echo $this->session->userdata('username'); ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                   <!-- <li><a href="javascript:;"> Profile</a></li>
                    <li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a>
                    </li>
                    <li><a href="javascript:;">Help</a></li>-->
                    <li><a href="<?php echo base_url().'logout';?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

               
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->
