<div class="x_panel">
    <div class="x_title">
      <h2><?=$header?></h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>
        </li>
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <div class="row">
          <div class="col-sm-2">
                <address>
                    <strong>Personal Data</strong>
                    <br>
                    <br>NIP
                    <br>Nama
                    <br>Jabatan
                    <br>Staff
                </address>
              </div>
              <!-- /.col -->
              <div class="col-sm-2">
                <address>
                    <br>
                    <br>: <?=$nip?>
                    <br>: <?=$nama?>
                    <br>: <?=$jabatan?>
                    <br>: <?=$bagian?>

                </address>
              </div>   
      </div>
    </div>
    <div class="clearfix"></div>
    <hr>
    <div class="x-content">
      <label>Input Nilai<small style="color:red;">(*) Masukkan nilai angka di setiap kriteria</small></label>
      <br>
      <div class="box" style="height: 60px;width: 700px;">
        <p>Jumlah tugas harian terkumpul bulan ini: <?=$tugas?></p>
      </div>
      
      <div class="clearfix"></div>
      <br>
      <form autocomplete="on" class="form-horizontal form-label-left" action="<?php echo $action; ?>" enctype="multipart/form-data" method="post">
        
          <input type="hidden" name="alt" id="alt" value="<?=$alt;?>"/>
          <?php foreach ($kriteria as $krit): ?>
             <input type="hidden" name="kri[<?=$krit->id_kriteria?>]" value="<?=$krit->id_kriteria?>">  
            <div class="form-group">
              <label class="control-label col-md-4 col-xs-12" for="first-name"><?=$krit->deskripsi?></label>
              <div class="col-md-2 col-sm-2 col-xs-12">
                <input type="number" name="altkri[<?=$krit->id_kriteria?>]" min="<?=$krit->min?>" max="<?=$krit->maks?>" class="form-control col-md-2 col-xs-12">
              </div>
              <div class="box pull-right" style="width: 200px;height: 70px">
                <p><small>Jumlah Minimal: <?=$krit->min?><br>
                  Jumlah Maksimal: <?=$krit->maks?>
                  
                  </small></p>
              </div>
            </div>
            <?php endforeach ?>
          <div class="clearfix"></div>
          <br>
          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
            <a href="<?=base_url();?>c_smart" class="btn btn-danger">Kembali</i></a>
            <button type="submit"  class="btn btn-success"><?php echo $button ?></button>
          </div>
      </form>
    </div>
</div>