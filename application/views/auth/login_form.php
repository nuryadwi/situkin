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
    <!-- Animate.css -->
    <link href="<?php echo base_url() ;?>assets/vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url() ;?>assets/build/css/custom.min.css" rel="stylesheet">
    <style media="screen" type="text/css">
         body{
            background: #004049;

         }
         .well {
            border-radius: 10px;
            margin-top: 10%;
            color: #616161;
            text-align: justify;
         }
         .well hr{
            margin: 5px;
            border-color:#0077a3;

         }
         .header {
            font-size: 40px;
            color: #f7f7f7;
         }
         .header .fa {
            border: 2px solid #fcfcfc;
            border-radius: 50%;
            padding: 5px;
         }
         .container {
            padding-top: 5%;
         }
         .form-control {
            font-size: 15px;
         }
         .btn {
            padding: 5px 20px;
            font-size: 18px;
            border-radius: 5px;
         }
      </style>
  </head>

  
 <body>
      <div class="container">
         <center>
            <span class="header"><i class="fa fa-stumbleupon"></i> SI-TUKIN</span>
         </center>
         <div class="col-md-4 col-sm-12 col-md-offset-4">
           <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
            
            <form class="well" action="<?php echo base_url()?>auth/ceklogin" method="post">

               <h3 style="text-align:center;"><i class="fa fa-user"></i> Login</h3>
               <hr />
               <br />

               <div class="form-group">
                  <label>Username</label>
                  <input type="text" class="form-control" placeholder="Username" name="username">
               </div>
                <?php echo form_error('username'); ?>

               <div class="form-group">
                <label>Password</label>
                  <input type="password" class="form-control" placeholder="Password" name="password">
               </div>
                <?php echo form_error('password'); ?>
               <div class="clearfix"></div>
               <div class="form-group" style="text-align:right">
                  <button type="submit" class="btn btn-primary" name="submit" value="Submit"><i class="fa fa-sign-in"></i> Login</button>
               </div>
               <br>
               <div class="form-group">
                  <p><b style="color: red;">(*)</b><small>Jika lupa password silahkan hubungi bagian admin.</small></p>
               </div>
             </form>
               <div class="clearfix"></div>
               <div>
                  <center>
                    <p>Sistem Informasi Penentuan Penerima Tunjangan Kinerja Pegawai Kelurahan Desa Sidomulyo</p>
                  <p><small><b>©2019 All Rights Reserved.</b> Privacy and Terms</small></center></p>
                </div>
            
         </div>
      </div>
      <!-- jQuery -->
      <script src="<?= base_url(); ?>admin_assets/js/jquery.min.js"></script>
      <!-- Bootstrap -->
      <script src="<?= base_url(); ?>admin_assets/js/bootstrap.min.js"></script>

      <script type="text/javascript">
         $('.alert-message').alert().delay(3000).slideUp('slow');
      </script>
   </body>
</html>
