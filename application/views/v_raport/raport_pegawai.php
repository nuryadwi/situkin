<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2><?=$header?></h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <section class="content invoice">
          <!-- title row -->
          <div class="row">
            <div style="text-align: center;">
              <div>
                <!-- load logo image -->
                <img src="<?php echo base_url(); ?>assets/img_app/logo_bantul.png"
                style="width: 100px; height: 100px;">
              </div>
              <h4>
                  <label>Penilaian Prestasi Kerja</label>
                  <br>
                  <p>Pegawai Kantor Kelurahan Desa Sidomulyo</p>
                  <p><small>Alamat: Kantor Desa Sidomulyo Plebengan, Sidomulyo, Bambanglipuro, Bantul, Yogyakarta
                    <br>
                    <i class="fa fa-phone">&nbsp;0811-2651-333</i>&nbsp;<i class="fa fa-at">&nbsp;desa.sidomulyo@bantulkab.go.id</i></small></p>
              </h4>
            </div>
            <br>
            <br>
            <!-- /.col -->
          </div>
          <!-- info row -->
          <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
              <h4><strong>STAFF YANG DINILAI</strong></h4>
              <address>
                  <br>NIP
                  <br>Nama
                  <br>Jabatan
                  <br>Bagian
                  <br>Unit Organisasi
              </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
              <h4><strong>&nbsp;</strong></h4>
              <address>
                <br>:&nbsp;<?=$nip;?>
                <br>:&nbsp;<?=$nama;?>
                <br>:&nbsp;<?=$jabatan;?>
                <br>:&nbsp;<?=$bagian;?>
                <br>:&nbsp;Kelurahan Desa Sidomulyo
              </address>
            </div>
          </div>
          <!-- /.row -->
          <!-- Table row -->
          <div class="row">
            <div class="col-xs-12 table">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th width="80%" colspan="5" style="text-align: center;">Unsur yang dinilai</th>
                    <th colspan="6">Hasil</th>
                  </tr>
                </thead>

                <thead>
                  <tr>          
                    <th width="5%">No.</th>
                    <th style="width: 20%">Kriteria</th>
                    <th style="width: 40%">Deskripsi</th>
                    <th width="10%">Penilaian</th>
                    <th style="width: 10%">Nilai</th>
                    <th style="background: grey;"></th>
                   
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $i=1;
                  foreach ($kriteria as $krit) :
                  ?>
                  <tr>
                  
                    <td><?=$i++;?></td>
                    <td><?=$krit->nama_kriteria;?></td>
                    <td><?=$krit->deskripsi?></td>
                    <?php
                     $id = $this->session->userdata('id_user');
                     $this->db->select('*');
                     $this->db->from('tbl_alternatif');
                     $this->db->join('t_users', 'tbl_alternatif.id_user=t_users.id_user');
                     $this->db->join('tbl_alternatif_kriteria', 'tbl_alternatif.id_alternatif=tbl_alternatif_kriteria.id_alternatif');
                     $this->db->join('tbl_kriteria', 'tbl_alternatif_kriteria.id_kriteria=tbl_kriteria.id_kriteria');
                     $this->db->join('tbl_nilai', 'tbl_kriteria.id_kriteria=tbl_nilai.id_kriteria');
                     $this->db->where('tbl_alternatif.id_user', $id);
                     $this->db->where('tbl_alternatif_kriteria.id_kriteria', $krit->id_kriteria);
                     
                     $query = $this->db->get();
                     $nilai = $query->result();

                     foreach ($nilai as $n) :
                    ?>
                    <td><?=$n->nilai_awal?></td>
                    <td><?=round($n->nilai_alternatif_kriteria,2)?></td>
                  <?php endforeach?>

                  <?php if (empty($nilai)): ?>
                    <td>-</td>
                    <td>-</td>
                  <?php endif ?>

                    <td style="background: grey;"></td>
                  <?php endforeach;?>
                  
                  </tr>
                
                </tbody>
                <thead>
                  <tr>
                    <th colspan="5"width="80%" style="text-align: center;">Nilai setelah dihitung menggunakan Metode SMART</th>
                    
                    <!-- dilakukan if jika hasilnya kosong maka nilai tidak tampil -->
                    <?php if (!empty($nilai)) { ?>
                      <td colspan="5"><?=$n->hasil_alternatif?></td>
                    <?php }else{ ?>
                      <td>-</td>
                    <?php }?>
         
                    
                  </tr>
                </thead>
              </table>
              <div class="box">
                <strong>KEPUTUSAN:</strong>
                <br>
                <h4><?=$ket?></h4>
              </div>
              
            </div>
            <!-- /.col -->
          </div>
          <!-- this row will not appear when printing -->
          <div class="row no-print">
            <div class="col-xs-12">
              <?php if (!empty($nilai)): ?>
                <a href="<?php echo base_url()?>c_raport/cetak" target="_blank" class="btn btn-primary pull-right"><i class="fa fa-download"></i> Cetak ke PDF</a>
              <?php endif ?>
              
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
</div>