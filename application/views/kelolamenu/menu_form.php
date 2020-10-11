<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2><?=$header?></h2>
              <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                  <li><a class="close-link"><i class="fa fa-close"></i></a></li>
              </ul>
              <div class="clearfix"></div>
              <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
          </div>
              <div class="x_content">
                 <form autocomplete="off" class="form-horizontal form-label-left" action="<?php echo $action; ?>" enctype="multipart/form-data" method="post">
                    <input type="hidden" name="id_menu" value="<?php echo $id_menu; ?>" /> 
                      <div class="form-group">
                        <label for="menu" class="control-label col-md-3 col-sm-3 col-xs-12">Title</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="title" id="title" Placeholder="Title" value="<?= $title; ?>" class="form-control col-md-7 col-xs-12">
                        </div>
                        <?php echo form_error('title'); ?>
                      </div>
                      <div class="form-group">
                        <label for="url" class="control-label col-md-3 col-sm-3 col-xs-12">Url</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="url" id="url" Placeholder="Url" value="<?= $url; ?>" class="form-control col-md-7 col-xs-12">
                        </div>
                        <?php echo form_error('url'); ?>
                      </div>
                      <div class="form-group">
                        <label for="icon" class="control-label col-md-3 col-sm-3 col-xs-12">Icon</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="icon" id="icon" Placeholder="Icon" value="<?= $icon; ?>" class="form-control col-md-7 col-xs-12">
                        </div>
                        <?php echo form_error('icon'); ?>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Main Menu</label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                        <?php echo cmb_dinamis('is_main_menu', 't_menu', 'title', 'id_menu', $is_main_menu,'DESC') ?>
                        </div>
                        <?php echo form_error('is_main_menu'); ?>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <select name="is_aktif" class="form-control" id="is_aktif" value="<?=$id_aktif?>">
                          <option disabled selected>--Pilih Status--</option>
                          <option value="y"<?php if($is_aktif == 'y') { echo "selected";}?>>Aktif</option>
                          <option value="n"<?php if($is_aktif == 'n') { echo "selected";}?>>Tidak Aktif</option>
                          </select>
                        </div>
                        <?php echo form_error('is_aktif'); ?>
                      </div>

                      <div class="ln_solid"></div>

                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <a href="<?=base_url();?>kelolamenu" class="btn btn-danger">Kembali</i></a>
                          <button type="submit"  class="btn btn-success"><?php echo $button ?></button>
                          
                        </div>
                      </div>

                 </form>
              </div>
    </div>
</div>

