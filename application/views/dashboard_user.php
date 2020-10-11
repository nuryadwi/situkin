<style media="screen" type="text/css">
  .scroll{
    width: 230px;
    background: white;
    padding: 2px;
    overflow: scroll;
    height: 400px;
    text-align: left;
  }
</style>

<div class="row top_tiles">
  <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="tile-stats">
      <div class="icon"><i class="fa fa-list-alt"></i></div>
      <div class="count">
        <?php if (!empty($jml_tugas)){ ?>
          <?=$jml_tugas?>
        <?php } else { ?>
              0
        <?php } ?> 
      </div>
      <h3>Tugas</h3>
      <p>Tugas yang anda kumpulkan bulan ini.</p>
    </div>
  </div>
  <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="tile-stats">
      <div class="icon"><i class="fa fa-graduation-cap"></i></div>
      <div class="count">
        <?php if (!empty($nilai)){ ?>
          <?=$nilai?>
        <?php } else { ?>
              0
        <?php } ?> 
      </div>
      <h3>Nilai</h3>
      <p>Nilai Kinerja Anda Bulan ini.</p>
    </div>
  </div>

  <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="tile-stats">
      <div class="icon"><i class="fa fa-user"></i></div>
      <div class="count">
        Aktif
      </div>
      <h3>Status</h3>
      <p>Status Pegawai</p>
    </div>
  </div>
   <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="tile-stats">
      <h3>Detail Login</h3>
      <br>
      <p>Username : <?=$this->session->userdata('full_name')?></p>
      <p>Level : <?=$level?> </p>
      <p>Login Terakhir : <?=$this->session->userdata('last_login')?></p>
    </div>
  </div>
</div>
<!-- isi tengan -->
<div class="row">
  <div class="col-md-12">
    <div class="x_panel">
      <div class="x_content">
        <div class="col-md-9 col-sm-12 col-xs-12">
            <div style="text-align: center;">
              <div>
                <!-- load logo image -->
                <img src="<?php echo base_url(); ?>assets/img_app/logo_bantul.png"
                style="width: 100px; height: 100px;">
              </div>
              <h4>
                <label>Sistem Penentuan Tunjangan Kinerja Pegawai</label>

                  <p><small>Alamat: Kantor Desa Sidomulyo Plebengan, Sidomulyo, Bambanglipuro, Bantul, Yogyakarta
                    <br>
                    <i class="fa fa-phone">&nbsp;0811-2651-333</i>&nbsp;<i class="fa fa-at">&nbsp;desa.sidomulyo@bantulkab.go.id</i></small></p>
              </h4>
            </div>
        </div>
        <!-- konten samping kanan -->
        <div class="scroll col-md-3 col-sm-12 col-xs-12">
          <div>
            <div class="x_title">
              <h2>Daftar Tugas</h2>
              <div class="clearfix"></div>
            </div>
            <?php foreach ($buku as $b) : ?>
            <article class="media event">
              <a class="pull-left date">
                <p class="month"><?=substr(moon($b->create_at),0,3)?></p>
                <p class="day"><?=tgl_angka($b->create_at)?></p>
              </a>
              <div class="media-body">
                <a class="title" href="#"><?=$b->tugas?></a>
                <p><?=substr($b->ket, 0,50)?></p>
              </div>
            </article>
            <?php endforeach?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>