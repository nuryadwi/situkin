<div class="x_panel">
  <div class="x_title">
  <h2><?=$header;?></h2>
  <div class="clearfix"></div>
    </div>
        <div class="x_content">
          <div class="x_content">
        <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
        <br />
        <br />
          <form class="form-horizontal form-label-left" action="<?php echo $action; ?>" enctype="multipart/form-data" method="post">
          <input type="hidden" name="id_user" value="<?php echo $id_user; ?>" />
                      <div class="form-group">
                        <label for="nip" class="control-label col-md-3 col-sm-3 col-xs-12">Username</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="username" class="form-control col-md-7 col-xs-12" id="username" Placeholder="Username" value="<?=$username?>">
                          <span><small style="color: red;">(*)ganti username bila perlu</small></span>
                        </div>

                      </div>

                      <input type="checkbox" name="clickme" id="clickme">Reset Password
                        <div id="showhide">
                          
                          <div class="form-group">
                            <label for="password" class="control-label col-md-3 col-sm-3 col-xs-12">Password Baru</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="password" name="password" id="password" Placeholder="Password" class="form-control col-md-7 col-xs-12" data-toggle="password" >
                              
                            </div>
                            <?php echo form_error('password'); ?>
                          </div>

                          <div class="form-group">
                            <label for="passconf" class="control-label col-md-3 col-sm-3 col-xs-12">Ketik Ulang Password</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="password" name="passconf" id="passconf" Placeholder="Ketik Ulang Password" class="form-control col-md-7 col-xs-12" data-toggle="password" >
                            </div>
                            <?php echo form_error('passconf'); ?>
                          </div>

                        </div>

                
                      <div class="ln_solid"></div>

                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <a href="<?=base_url();?>profil" class="btn btn-danger">Kembali</i></a>
                      <button type="submit"  class="btn btn-success"><?php echo $button ?></button>
                        </div>
                      </div>
                </form>
              </div>
            </div>
          </div>


          <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> 
          <script type="text/javascript">
	          $("#password").password('toggle');
          </script>
          
          <script type='text/javascript'>
            $(window).load(function(){
              $("#showhide").css("display","none");
             
            $('#clickme').change(function(){
              if (this.checked) {
                $('#showhide').fadeIn('slow');
              } 
              else {
                $('#showhide').fadeOut('slow');
              }  
            });
            });
          </script>

