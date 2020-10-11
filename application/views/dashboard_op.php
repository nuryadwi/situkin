<style media="screen" type="text/css">
  .scroll{
    width: 310px;
    background: white;
    padding: 2px;
    overflow: scroll;
    height: 420px;
    text-align: left;
  }
</style>
<!-- top -->
<div class="row top_tiles">
  <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="tile-stats">
      <div class="icon"><i class="fa fa-users"></i></div>
      <div class="count"><?=$jml1->pegawai?></div>
      <h3>Pegawai</h3>
      <p>Jumlah pegawai.</p>
    </div>
  </div>
  <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="tile-stats">
      <div class="icon"><i class="fa fa-suitcase"></i></div>
      <div class="count"><?=$jml3->tugas1?></div>
      <h3>Tugas</h3>
      <p>Jumlah tugas terkumpul bulan ini.</p>
    </div>
  </div>
  <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="tile-stats">
      <div class="icon"><i class="fa fa-sort-amount-desc"></i></div>
      <div class="count"><?=$jml3->tugas2?></div>
      <h3>Tugas Masuk</h3>
      <p>Jumlah tugas masuk bulan ini.</p>
    </div>
  </div>
  <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="tile-stats">
      <div class="icon"><i class="fa fa-check-square-o"></i></div>
      <div class="count"><?=$jml2->pegawai?></div>
      <h3>Pegawai</h3>
      <p>Jumlah Pegawai yang telah dinilai</p>
    </div>
  </div>
  <!-- MID -->
<div class="row">
  <div class="col-md-12">
    <div class="x_panel">
      <div class="x_content">
        <div class="col-md-8 col-sm-12 col-xs-12">
            <div style="text-align: center;">
              <div>
                <!-- load logo image -->
                <img src="<?php echo base_url(); ?>assets/img_app/logo_bantul.png"
                style="width: 100px; height: 100px;">
              </div>
              <h4>
              <label>Sistem Penentuan Tunjangan Kinerja Pegawai</label>

                  <br>
                  <p>Kantor Kelurahan Desa Sidomulyo</p>
                  <p><small>Alamat: Kantor Desa Sidomulyo Plebengan, Sidomulyo, Bambanglipuro, Bantul, Yogyakarta
                    <br>
                    <i class="fa fa-phone">&nbsp;0811-2651-333</i>&nbsp;<i class="fa fa-at">&nbsp;desa.sidomulyo@bantulkab.go.id</i></small></p>
              </h4>
            </div>
        </div>
        <!-- side -->
        <div class="scroll col-md-3 col-sm-12 col-xs-12">
          <div>
            <div class="x_title">
              <h2>Tugas Masuk</h2>
              <div class="clearfix"></div>
            </div>
            
            <ul class="list-unstyled top_profiles scroll-view">
              <?php
              foreach ($recent as $re) :?>
              <li class="media event">
                <a class="pull-left">
                  <img src="<?php echo base_url()?>assets/foto_profil/<?=$re->images?>" class="profile_thumb" style="width: 60px;height: 60px" alt="images">
                </a>
                <div class="media-body">
                  <a class="title"><?=$re->full_name?></a>
                  <p><strong><?=$re->tugas?></strong></p>
                  <p><?=$re->ket?></p>
                  <p style="color: green"> <small><?=date_indo($re->create_at)?></small>
                  </p>
                  <?php if ($re->file_tambahan != 'kosong') {?>
                  <p class="url">
                    <span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
                    <a href="<?php echo base_url().'tugas/download/'.$re->id_tugas; ?>" class="btn btn-success btn-sm"><i class="fa fa-paperclip"></i><?=$re->file_tambahan?></a>
                  </p>
                  <?php }?>  
                  <a href="<?=base_url();?>tugas/jml/1/<?=$re->id_tugas;?>" class="btn btn-primary btn-xs pull-right">Approve</a>
                </div>
                <br>
              </li>
              <?php endforeach?>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- end -->
</div>