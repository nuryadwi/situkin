<div class="x_panel">
  <div class="x_title">
      <h2><?=$header;?><small><?=$subheader?></small></h2>
      
  <div class="clearfix"></div>
  <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
    </div>
        <div class="x_content">
        <br />
          <form autocomplete="off" class="form-horizontal form-label-left" action="<?php echo $action; ?>" enctype="multipart/form-data" method="post">
          
          <input type="hidden" name="id_bagian" class="form-control col-md-7 col-xs-12" id="id_bagian" value="<?=$id_bagian?>">
          <input type="hidden" name="id_user" class="form-control col-md-7 col-xs-12" id="id_user" value="<?=$id_user?>">


                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nama Tugas</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="tugas" class="form-control col-md-7 col-xs-12" id="tugas" Placeholder="Tugas" value="">
                        </div>
                        <?php echo form_error('tugas'); ?>
                      </div>

                      

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Jam</label>

                        <div class="col-md-2 col-sm-2 col-xs-5">
                        <input type="time" class="form-control left" id="waktu_mulai" name="waktu_mulai" value="<?=$waktu_mulai?>">
                        <?php echo form_error('waktu_mulai'); ?>
                        
                        </div>

                        <div class="col-md-2 col-sm-2 col-xs-5">

                          <input type="time" class="form-control right" id="waktu_selesai" name="waktu_selesai" value="<?=$waktu_selesai?>">
                          <?php echo form_error('waktu_selesai'); ?>
                          
                        </div>
                        
                      </div>

                      

                        <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal</label>
                          <div class="col-md-3 col-sm-3 col-xs-12">
                                <fieldset>
                                  <div class="control-group">
                                    <div class="controls">
                                      <div class="col-md-16 xdisplay_inputx form-group has-feedback">
                                        
                                        <input type="text" class="form-control has-feedback-left" name="tanggal" id="single_cal1" placeholder="Tanggal" aria-describedby="inputSuccess2Status" value="<?=$tanggal?>">
                                        
                                        <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                        <span id="inputSuccess2Status" class="sr-only">(success)</span>
                                      </div>
                                    </div>
                                  </div>
                                </fieldset>
                          </div>
                        <?php echo form_error('tanggal'); ?>
                        </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Pemberi Tugas</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="pemberi_tugas" class="form-control col-md-7 col-xs-12" id="pemberi_tugas" Placeholder="Pemberi Tugas" value="">
                        </div>
                        <?php echo form_error('pemberi_tugas'); ?>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">File Tambahan </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="file" name="files" id="files" class="form-control col-md-7 col-xs-12" value="<?=$files?>">
                          <span style="color:red;"><b>* </b>Lampirkan bila perlu</span>
                        </div>
                        <?php echo form_error('files'); ?>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Keterangan</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                             <textarea name="keterangan" id="keterangan" class="form-control" rows="6"></textarea>
                          </div>
                        <?php echo form_error('keterangan'); ?>
                      </div>
                      
                     
                      <div class="ln_solid"></div>

                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <a href="<?=base_url();?>bukupegawai" class="btn btn-danger">Kembali</i></a>
                          <button type="submit"  class="btn btn-success"><?php echo $button ?></button>
                          
                        </div>
                      </div>

                </form>
              </div>
          </div>
