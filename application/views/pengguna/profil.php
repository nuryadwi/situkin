<div class="col-md-12 col-sm-12 col-xs-12">
            <div class="page-title">
                <div class="title_left">
                  <h2><?=$header;?></h2>
                  <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Profil Pengguna</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                    
                  </div>
                  <div class="x_content">
                <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                  <div class="profile_img">
                        <div id="crop-avatar">
                          <!-- Current avatar -->
                          <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url('assets/foto_profil/'.$this->session->userdata('images')); ?>" alt="User profile picture">
                        </div>
                  </div>
                   <h4 class="profile-username"><?php echo strtoupper($this->session->userdata('full_name'))?></h4>
                  <ul class="list-unstyled user_data">
                        <li><i class="fa fa-credit-card user-profile-icon"></i>&nbsp;<?=$nip?>
                        </li>

                        <li>
                          <i class="fa fa-briefcase user-profile-icon"></i>&nbsp;<?=$jabatan?>
                        </li>

                        <li>
                          <b>Status Pegawai</b><span class="label label-success pull-right"><?=$status?></span> 
                        </li>

                        <li>
                          <b>Tanggal Daftar</b><span class="label label-success pull-right"><?=$create_on?></span> 
                        </li>

                        <li>
                          <b>Terakhir Login</b><span class="label label-success pull-right"><?=$last_login?></span> 
                        </li>

                      </ul>
                  </div>
          
                    <!-- form data profil -->
                    <div class="col-md-8 col-xs-12">
                      <form autocomplete="off" class="form-horizontal form-label-left" action="<?php echo $action; ?>" enctype="multipart/form-data" method="post">

                      <input type="hidden" name="id_user" value="<?php echo $id_user; ?>" /> 
                      
                      <div class="form-group">
                        <label class="control-label col-sm-3 col-xs-8">NIP</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input type="text" id="nip" name="nip" class="form-control" placeholder="NIP" value="<?=$nip?>">
                        </div>
                        <?php echo form_error('nip'); ?>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-sm-3 col-xs-8">NIK</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input type="text" id="nik" name="nik" class="form-control" placeholder="NIK" value="<?=$nik?>">
                        </div>
                        <?php echo form_error('nik'); ?>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-sm-3 col-xs-8">Nama Lengkap</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input type="text" id="full_name" name="full_name" class="form-control" placeholder="Nama Lengkap" value="<?=$full_name?>">
                        </div>
                        <?php echo form_error('full_name'); ?>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-sm-3 col-xs-8">Email</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input type="text" id="email" name="email" class="form-control" placeholder="Email" value="<?=$email?>">
                        </div>
                        <?php echo form_error('email'); ?>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-sm-3 col-xs-8">No. Telepon</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input type="text" id="phone" name="phone" class="form-control" placeholder="No. Telepon" value="<?=$phone?>">
                        </div>
                        <?php echo form_error('phone'); ?>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Kelamin</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <select name="gender" class="form-control" id="gender" value="<?=$gender?>">
                          <option disabled selected>--Pilih Jenis Kelamin--</option>
                          <option value="laki-Laki"<?php if($gender == 'laki-Laki') { echo "selected";}?>>Laki-Laki</option>
                          <option value="perempuan"<?php if($gender == 'perempuan') { echo "selected";}?>>Perempuan</option>
                          </select>
                        </div>
                        <?php echo form_error('gender'); ?>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-sm-3 col-xs-8">Foto Profil</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input type="file" name="images" class="form-control-file <?php echo form_error('images') ? 'is-invalid':''?>" />
                          <input type="hidden"  name="old_images" class="form-control-file" value="<?=$images?>" />
                        </div>
                        <?php echo form_error('images') ?>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-sm-3 col-xs-8">Alamat</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input type="text" id="alamat" name="alamat" class="form-control" placeholder="Alamat Lengkap" value="<?=$alamat?>">
                        </div>
                        <?php echo form_error('alamat'); ?>
                      </div>
                      

                      <div class="ln_solid"></div>

                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <button type="submit"  class="btn btn-success"><?php echo $button ?></button>
                        </div>
                      </div>
                      
                      </form>
                    </div>
          
    </div>
  </div>
</div>
