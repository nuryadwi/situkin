<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2><?=$header?></h2>
      <div class="clearfix"></div>
      <br> 
      <div class="box" style="width: 350px; height: 70px;">
      <p>Tugas Anda yang telah di approve bulan ini:</p><strong><?php echo $jml_tugas;?> Tugas</strong> 
      </div>
        <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
            <li><a class="close-link"><i class="fa fa-close"></i></a></li>
        </ul>
        <div class="clearfix"></div>
        <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
    </div>
    <div class="x_content">
    <a href="<?=base_url();?>bukupegawai/create" class="btn btn-primary">Tulis Tugas</i></a>
    <table id="datatable" class="table table-striped jambo_table table-bordered">
      <thead>
          <tr>
              <th width="2%">No.</th>
              <th width="20%">Tugas</th>
              <th width="5%">Waktu Mulai</th>
              <th width="5%">Waktu Selesai</th>
              <th width="5%">Hari</th>
              <th width="15%">Tanggal</th>
              <th width="10%">Pemberi Tugas</th>
              <th width="15%">Keterangan</th>
                <th width="5%">Status</th>

          </tr>
      </thead>
      <tbody>
          <?php
          $i=1;
          foreach ($buku as $b) :
          ?>
            <tr>
              <td style="vertical-align:middle"><?=$i++;?></td>
              <td style="vertical-align:middle"><?=$b->tugas;?></td>
              <td style="vertical-align:middle"><?=$b->waktu_mulai;?></td>
              <td style="vertical-align:middle"><?=$b->waktu_selesai;?></td>
              <td style="vertical-align:middle"><?=hari($b->tanggal);?></td>
              <td style="vertical-align:middle"><?=date_indo($b->tanggal);?></td>
              <td style="vertical-align:middle"><?=$b->pemberi_tugas;?></td>
              <td style="vertical-align:middle"><?=$b->ket;?></td>
              <td style="vertical-align:middle">
                <?php if ($b->jml ==='0') { ?>
                  <span class="label label-danger">belum di approve</span> 
                <?php } else { ?>
                  <span class="label label-success">approve</span> 
                <?php } ?>                   
              </td>
            </tr>
          <?php endforeach?>
      </tbody>
    </table>
    </div>
  </div>
</div>