<div class="x_panel">
  <div class="x_title">
      <h2><?=$header;?></h2>
      <div class="clearfix"></div>
  </div>
        <div class="x_content">
        <br />
          <form class="form-horizontal form-label-left" action="<?php echo $action; ?>" enctype="multipart/form-data" method="post">
              <input type="hidden" name="id_bagian" class="form-control col-md-7 col-xs-12" id="id_bagian" value="<?=$id_bagian?>">
                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Jabatan</label>
                      <div class="col-md-5 col-sm-5 col-xs-12">
                      <?php echo cmb_dinamis('id_jabatan', 't_jabatan', 'nama_jabatan', 'id_jabatan', $id_jabatan,'DESC') ?>
                      </div>
                      <?php echo form_error('id_jabatan'); ?>
                    </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nama Bagian</label>
                    <div class="col-md-5 col-sm-5 col-xs-12">
                      <input type="text" name="nama_bagian" class="form-control col-md-7" id="nama_bagian" Placeholder="Nama Bagian" value="<?=$nama_bagian; ?>">
                    </div>
                    <?php echo form_error('nama_bagian'); ?>
                  </div>
                  <div class="ln_solid"></div>

                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <a href="<?=base_url();?>bagian" class="btn btn-danger">Kembali</i></a>
                      <button type="submit"  class="btn btn-success"><?php echo $button ?></button>
                      
                    </div>
                  </div>

                </form>
              </div>
          </div>