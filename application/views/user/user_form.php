<div class="x_panel">
  <div class="x_title">
      <h2><?=$header;?></h2>
  <div class="clearfix"></div>
    </div>
        <div class="x_content">
        <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
        <br />
          <form autocomplete="off"class="form-horizontal form-label-left" action="<?php echo $action; ?>" enctype="multipart/form-data" method="post">
          <input type="hidden" name="id_user" value="<?php echo $id_user; ?>" />
          <?php  if ($this->uri->segment(2) == 'create'){ ?>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nama Pegawai</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="full_name" class="form-control col-md-7 col-xs-12" Placeholder="Nama Pegawai" value="<?= $fullname; ?>">
              </div>
              <?php echo form_error('full_name'); ?>
            </div>
          <?php } ?>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">NIP</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="nip" class="form-control col-md-7 col-xs-12" id="nip" Placeholder="NIP" value="<?= $nip; ?>">
              </div>
              <?php echo form_error('nip'); ?>
            </div> 
            
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Username</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="username" class="form-control col-md-7 col-xs-12" Placeholder="Username tidak boleh dipisah" value="<?= $username; ?>">
              </div>
              <?php echo form_error('username'); ?>
            </div> 
              
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">User Level</label>
              <div class="col-md-3 col-sm-3 col-xs-12">
              <?php echo cmb_dinamis('id_role', 't_role', 'nama_role', 'id_role', $id_role,'DESC') ?>
              </div>
              <?php echo form_error('id_role'); ?>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Jabatan</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
              <select class="form-control" name="id_jabatan" id="id_jabatan">
                <option value="">--Please Select--</option>
                <?php
                foreach ($jabatan as $j):
                  ?>
                  <option <?php echo $jabatan_selected == $j->id_jabatan ? 'selected="selected"': ''?> value="<?php echo $j->id_jabatan?>"><?php echo $j->nama_jabatan?></option>
                <?php endforeach?>

              </select>
              </div>
            </div>

            <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Bagian</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select class="form-control" name="id_bagian" id="id_bagian">
                <option value="">--Please Select--</option>
                <?php
                foreach ($bagian as $b):
                  ?>
                  <option <?php echo $bagian_selected == $b->id_bagian ? 'selected="selected"' :''?>
                    class="<?php echo $b->id_jabatan?>"
                    value="<?php echo $b->id_bagian?>">
                  <?php echo $b->nama_bagian ?>
                  </option>
                <?php endforeach?>
                
              </select>
            </div>
        </div>

          <?php 
            if ($this->uri->segment(2) == 'update'){ ?>
              <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
              <div class="col-md-3 col-sm-3 col-xs-12">
                <select name="status" class="form-control" id="status" value="<?=$status?>">
                <option disabled selected>--Pilih Status--</option>
                <option value="1"<?php if($status == 1) { echo "selected";}?>>Aktif</option>
                <option value="2"<?php if($status == 2) { echo "selected";}?>>Non Aktif</option>
                </select>
              </div>
              <?php echo form_error('status'); ?>
            </div>
            <?php } ?>
      
            <div class="ln_solid"></div>

            <div class="form-group"  style="text-align:right">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <a href="<?=base_url();?>user" class="btn btn-danger">Kembali</i></a>
              <button type="submit"  class="btn btn-success"><?php echo $button ?></button>
              </div>
            </div>
      </form>
    </div>
    <div class="clearfix"></div>
    <?php 
    if ($this->uri->segment(2) == 'create'){ ?>
    <div class="box" style="width: 400px; height: 70px">
      <p style="color: red;">(*)<small>Password untuk pertama kali default sama dengan username, untuk login akun gunakan username sebagai password</small></p>
    </div>
    <?php } ?>
</div>

<script src="<?php echo base_url() ;?>assets/js/jquery-1.10.2.min.js"></script>
<script src="<?php echo base_url() ;?>assets/js/jquery.chained.min.js"></script>

<script>
  $("#id_bagian").chained("#id_jabatan");
</script>
