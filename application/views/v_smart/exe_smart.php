<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2><?=$header?></h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>
        <li><a class="close-link"><i class="fa fa-close"></i></a>
        </li>
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">  
    <a href="<?=base_url();?>c_smart/cetak" target="_blank" class="btn btn-success"><i class="fa fa-print"></i> pdf</i></a>                
    <div class="pull-right">
      <a href="<?=base_url();?>c_smart" class="btn btn-danger">Kembali</i></a>
    </div>
      <table id="datatable" class="table table-striped jambo_table table-bordered">
        <thead>
          <tr>
            <th width="2%">No.</th>
            <th width="20%">Pegawai</th>
            <?php
            foreach($kriteria as $krit) :
            ?>
            <th width="5%"><?=$krit->kriteria;?></th>
            <?php endforeach;?>
            <th width="5%">Hasil</th>
            <th width="15%">Keterangan</th>
          </tr>
        </thead>
          <tbody>
            <tr>
              <td>-</td>
              <td><b>Bobot Normalisasi</b></td>
              <?php foreach ($kriteria as $kri) {?>
                <td><b><?=round($kri->bobot_rerata,3)?></b></td>
              <?php }?>
              <td>-</td>
              <td>-</td>
            </tr>
            
              <?php
              $i=1;
              foreach ($alter as $alt) :
              ?>
              <tr>
                <td><?=$i++?></td>
                <td><?=$alt->full_name?></td>
                <?php foreach ($kriteria as $krit) :?>
                  <td>
                    <?php
                      $query = $this->db->query("select * from tbl_alternatif_kriteria where id_kriteria='".$krit->id_kriteria."' and id_alternatif='".$alt->id_alternatif."'");
                        $altkri = $query->result();
                        foreach ($altkri as $utl) {
                          echo round($utl->bobot_alternatif_kriteria,2);
                        }
                    ?>
                  </td>
                <?php endforeach?>
                <td>
                  <?php
                    $query = $this->db->query("SELECT CAST(SUM(bobot_alternatif_kriteria) AS DECIMAL(12,2)) AS bobot_alternatif_kriteria FROM tbl_alternatif_kriteria WHERE id_alternatif='".$alt->id_alternatif."'");
                    $utl2 = $query->row();
                    $ida = $alt->id_alternatif;

                    echo"<b>".round($hsl = $utl2->bobot_alternatif_kriteria,2);
                    
                    if ($hsl>=70.00) {
                      $ket = "Mendapat Tunjangan";
                    }else{
                      $ket = "Tidak Mendapat Tunjangan";
                    }
                    //input hasil ke tbl_alternatif
                    $data = array(
                          'hasil_alternatif' => $hsl,
                          'ket_alternatif' => $ket,
                          'id_alternatif' => $ida,
                    );
                    $this->db->set('hasil_alternatif', 'ket_alternatif');
                    $this->db->where('id_alternatif', $ida);
                    $this->db->update('tbl_alternatif', $data);
                  ?>
                </td>
                <td>
                  <?php
                    if ($hsl>=70.00) {
                      $ket2 = "<span class='label label-success'>Mendapat Tunjangan</span>"; 
                    }else{
                      $ket2 = "<span class='label label-danger'>Tidak Dapat Tunjangan</span>";
                    }
                    echo $ket2;
                  ?>
                </td>
              <?php endforeach?>
              </tr>
          </tbody>
      </table>
    </div>
    <div class="clearfix"></div>
      <br>
      <div class="box" style="width: 200px;height: 300px">
        <p>Keterangan</p>
        <p>
          <small>
            <?php 
            $i=1;
            foreach ($kriteria as $k) :?>
            <ul>
              <li><?=$k->kriteria.': '.$k->nama_kriteria?></li>
            </ul>
          <?php endforeach?>
          </small>
          
        </p>
      </div>
  </div>
</div>