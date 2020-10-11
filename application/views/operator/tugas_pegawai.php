<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Laporan Tugas</h2>
            <div class="clearfix"></div>
            <br> 
              <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
              </ul>
              <div class="clearfix"></div>
              <?= validation_errors('<p style="color:red">','</p>'); ?>
              
        <form class="form-horizontal row"action="" method="post">

         <div class="form-group col-md-3 col-sm-12">
            <select class="form-control" name="bln">
               <option value="01" <?php if ($bln == '01') { echo 'selected'; } ?>>Januari</option>
               <option value="02" <?php if ($bln == '02') { echo 'selected'; } ?>>Februari</option>
               <option value="03" <?php if ($bln == '03') { echo 'selected'; } ?>>Maret</option>
               <option value="04" <?php if ($bln == '04') { echo 'selected'; } ?>>April</option>
               <option value="05" <?php if ($bln == '05') { echo 'selected'; } ?>>Mei</option>
               <option value="06" <?php if ($bln == '06') { echo 'selected'; } ?>>Juni</option>
               <option value="07" <?php if ($bln == '07') { echo 'selected'; } ?>>Juli</option>
               <option value="08" <?php if ($bln == '08') { echo 'selected'; } ?>>Agustus</option>
               <option value="09" <?php if ($bln == '09') { echo 'selected'; } ?>>September</option>
               <option value="10" <?php if ($bln == '10') { echo 'selected'; } ?>>Oktober</option>
               <option value="11" <?php if ($bln == '11') { echo 'selected'; } ?>>November</option>
               <option value="12" <?php if ($bln == '12') { echo 'selected'; } ?>>Desember</option>
            </select>
         </div>

         <div class="form-group col-md-3 col-sm-12">
            <select class="form-control" name="thn">
               <?php for ($i = 2019; $i <= date('Y')+5; $i++) { ?>
                  <option value="<?=$i;?>" <?php if ($thn == $i) { echo 'selected'; } ?>>
                     <?=$i;?>
                  </option>
               <?php } ?>
            </select>
         </div>

         <button type="submit" class="btn btn-primary" name="cari"><i class="fa fa-search"></i> Cari</button>
      </form>
          </div>

              <div class="x_content">
                <div class="row">
                  <?php
                   switch ($bln) {
                      case '01':
                         $Bulan = 'Januari';
                         break;
                      case '02':
                         $Bulan = 'Februari';
                         break;
                      case '03':
                         $Bulan = 'Maret';
                         break;
                      case '04':
                         $Bulan = 'April';
                         break;
                      case '05':
                         $Bulan = 'Mei';
                         break;
                      case '06':
                         $Bulan = 'Juni';
                         break;
                      case '07':
                         $Bulan = 'Juli';
                         break;
                      case '08':
                         $Bulan = 'Agustus';
                         break;
                      case '09':
                         $Bulan = 'September';
                         break;
                      case '10':
                         $Bulan = 'Oktober';
                         break;
                      case '11':
                         $Bulan = 'November';
                         break;
                      case '12':
                         $Bulan = 'Desember';
                         break;
                   }

                   ?>

                  <div class="col-md-10 col-sm-12">
                     <h2>Laporan Bulan <?= $Bulan;?> Tahun <?=$thn;?></h2>
                  </div>
                  <div class="col-md-1 col-sm-12 col-md-offset-1">
                  <a href="<?=base_url('tugas/cetak/').$bln.'/'.$thn;?>" target="_blank" class="btn btn-success"><i class="fa fa-print"></i> Pdf</a>
                  </div>
               
                     
                     <table id="datatable" class="table table-striped jambo_table table-bordered">
                     <thead>
                        <th width="2%">No.</th>
                        <th width="20%">Pegawai</th>
                        <th width="10%">Tugas</th>
                        <th width="5%">Jam Mulai</th>
                        <th width="5%">Jam Selesai</th>
                        <th width="5%">Hari</th>
                        <th width="15%">Tanggal</th>
                        <th width="10%">Pemberi Tugas</th>
                        <th width="15%">Keterangan</th>

                     </thead>
                     <tbody>
                        <?php 
                        $no=1;
                           foreach ($tugas as $t) :
                        ?>
                        <tr>
                           <td style="vertical-align:middle"><?=$no++;?></td>
                           <td style="vertical-align:middle"><?=$t->full_name; ?></td>
                           <td style="vertical-align:middle"><?=$t->tugas; ?></td>
                           <td style="vertical-align:middle"><?=$t->waktu_mulai;?></td>
                           <td style="vertical-align:middle"><?=$t->waktu_selesai;?></td>
                           <td style="vertical-align:middle"><?=hari($t->tanggal);?></td>
                           <td style="vertical-align:middle"><?=date_indo($t->tanggal);?></td>
                           <td style="vertical-align:middle"><?=$t->pemberi_tugas;?></td>
                           <td style="vertical-align:middle"><?=$t->ket;?></td>

                        </tr>
                     <?php endforeach;?>
                     </tbody>
                     </table>

                  <div class="col-md-6 col-sm-6">
                     <a href="#" class="btn btn-danger" onclick="window.history.go(-1)">Kembali</a>
                  </div>
               </div>
            </div> 
    </div>
</div>