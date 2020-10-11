<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SI-TUKIN | <?=$header;?></title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url() ;?>assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url() ;?>assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url() ;?>assets/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="<?php echo base_url();?>assets/vendors/select2/dist/css/select2.min.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo base_url() ;?>assets/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-wysiwyg -->
    <link href="<?php echo base_url() ;?>assets/vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
    <!-- Switchery -->
    <link href="<?php echo base_url() ;?>assets/vendors/switchery/dist/switchery.min.css" rel="stylesheet">
    <!-- starrr -->
    <link href="<?php echo base_url() ;?>assets/vendors/starrr/dist/starrr.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo base_url() ;?>assets/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="<?php echo base_url() ;?>assets/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ;?>assets/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ;?>assets/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ;?>assets/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ;?>assets/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="<?php echo base_url() ;?>assets/build/css/custom.min.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo base_url() ;?>assets/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <script src="<?php echo base_url() ;?>assets/js/jquery-3.2.1.min.js"></script>
    
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="<?php echo base_url()?>home" class="site_title"><i class="fa fa-stumbleupon"></i> <span>SI-TUKIN</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
            <div class="profile_pic">
            <img src="<?php echo base_url() ?>assets/foto_profil/<?php echo $this->session->userdata('images'); ?>" alt="images" class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Selamat datang,</span>
                <h2><?php echo strtoupper($this->session->userdata('full_name')); ?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />
            <div class="profile clearfix">
            <?php if($this->session->userdata('id_role')==='2'){?>
            <div style="text-align: center;">
              <a href="<?=base_url();?>bukupegawai/create" class="btn btn-success">Tulis Tugas</a>
            </div>
            <?php }?>
            </div>
            

            <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <?php $this->load->view('sidebar')?>

          </div>
            <!-- /sidebar menu -->
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
                  <img src="<?php echo base_url() ?>assets/foto_profil/<?php echo $this->session->userdata('images'); ?>" alt="images">
                                    <span class="hidden-xs"><?php echo strtoupper($this->session->userdata('full_name')); ?></span>
                  </a>

                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                  <li><a href="<?php echo base_url().'profil'?>"> Profile</a></li>
                  <li><a href="<?php echo base_url().'profil/ganti_password'?>"> Ganti Password</a></li>
                    <li>
                    <li><a href="<?php echo base_url().'auth/logout';?> "><i class="fa fa-sign-out pull-right" ></i> Log Out</a></li>
                  </ul>
                </li>

               
              </ul>
            </nav>
          </div>
        </div>


        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">
            <!-- Alert -->
              <div class="col-lg-12">
                <div class="flash-welcome" data-flashdata="<?= $this->session->flashdata('message-welcome'); ?>"></div>
                <div class="flash-success" data-flashdata="<?= $this->session->flashdata('message-success'); ?>"></div>
                <div class="flash-failed" data-flashdata="<?= $this->session->flashdata('message-failed'); ?>"></div>
              </div>
            <!-- End Alert -->
                <?php echo $contents; ?>
            </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Sistem Tunjangan Kinerja create by <a href="#">Dwi Nuryadi</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo base_url() ;?>assets/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url() ;?>assets/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url() ;?>assets/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url() ;?>assets/vendors/nprogress/nprogress.js"></script>
    <!-- validator -->
    <script src="<?php echo base_url() ;?>assets/vendors/validator/validator.js"></script>
    <!-- bootstrap-wysiwyg -->
    <script src="<?php echo base_url() ;?>assets/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
    <script src="<?php echo base_url() ;?>assets/vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
    <script src="<?php echo base_url() ;?>assets/vendors/google-code-prettify/src/prettify.js"></script>
    <!-- jQuery Tags Input -->
    <script src="<?php echo base_url() ;?>assets/vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
    <!-- Switchery -->
    <script src="<?php echo base_url() ;?>assets/vendors/switchery/dist/switchery.min.js"></script>
    <!-- Select2 -->
    <script src="<?php echo base_url() ;?>assets/vendors/select2/dist/js/select2.full.min.js"></script>
    <!-- Parsley -->
    <script src="<?php echo base_url() ;?>assets/vendors/parsleyjs/dist/parsley.min.js"></script>
    <!-- Autosize -->
    <script src="<?php echo base_url() ;?>assets/vendors/autosize/dist/autosize.min.js"></script>
    <!-- jQuery autocomplete -->
    <script src="<?php echo base_url() ;?>assets/vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
    <!-- starrr -->
    <script src="<?php echo base_url() ;?>assets/vendors/starrr/dist/starrr.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url() ;?>assets/build/js/custom.min.js"></script>
    <!-- Js show password -->
    <script src="<?php echo base_url() ;?>assets/js/bootstrap-show-password.min.js"></script>
    <!-- Datatables -->
    <script src="<?php echo base_url() ;?>assets/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url() ;?>assets/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url() ;?>assets/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url() ;?>assets/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="<?php echo base_url() ;?>assets/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="<?php echo base_url() ;?>assets/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="<?php echo base_url() ;?>assets/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="<?php echo base_url() ;?>assets/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="<?php echo base_url() ;?>assets/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="<?php echo base_url() ;?>assets/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo base_url() ;?>assets/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="<?php echo base_url() ;?>assets/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="<?php echo base_url() ;?>assets/vendors/jszip/dist/jszip.min.js"></script>
    <script src="<?php echo base_url() ;?>assets/vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="<?php echo base_url() ;?>assets/vendors/pdfmake/build/vfs_fonts.js"></script>
    <script src="<?php echo base_url() ;?>assets/vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js"></script>
    
    <!-- SweetAlert2 -->
    <script src="<?php echo base_url()?>assets/vendors/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="<?php echo base_url()?>assets/src/js/alert.js"></script>
    <!-- End SweetAlert2 -->

    <!-- bootstrap-daterangepicker -->
    <script src="<?php echo base_url() ;?>assets/vendors/moment/min/moment.min.js"></script>
    <script src="<?php echo base_url() ;?>assets/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- Chart.js -->
    <script src="<?php echo base_url() ;?>assets/vendors/Chart.js/dist/Chart.min.js"></script>
    <script src="<?php echo base_url() ;?>assets/vendors/Chart.js/dist/Chart.js"></script>
 
    
  </body>
</html>