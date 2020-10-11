<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
      <div class="x_title">
          <h2><?=$header?></h2>
          <div class="clearfix"></div>
          <br> 
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                <li><a class="close-link"><i class="fa fa-close"></i></a></li>
            </ul>
            <div class="clearfix"></div>
            <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
      </div>
            <div class="x_content">
            
            <table id="datatable" class="table table-striped jambo_table table-bordered">
              <thead>
                  <tr>
                      <th width="2%">No.</th>
                      <th width="20%">Nama Pegawai</th>
                      <?php 
                      foreach ($kriteria as $krit) :
                      ?>
                      <th width="3%"><?=$krit->kriteria?></th>
                    <?php endforeach; ?>
                      <th width="10%">Aksi</th>
                  </tr>
              </thead>
              <tbody>
                  <?php
                  $i=1;
                  foreach ($alter as $alt):
                  ?>
                    <tr>
                      <td style="vertical-align:middle"><?=$i++?></td>
                      <td style="vertical-align:middle"><?=$alt->full_name;?></td>
                      <?php
                      foreach ($kriteria as $krit) :
                      ?>
                      <td style="vertical-align:middle">
                          <?php
                            $query = $this->db->query("select * from tbl_alternatif_kriteria where id_kriteria='".$krit->id_kriteria."' and id_alternatif='".$alt->id_alternatif."'");
                            $altkri = $query->result();
                            
                            foreach ($altkri as $altkrit) :
                            ?>
                            <?=round($altkrit->nilai_alternatif_kriteria,1);?>
                            <?php endforeach;?>
                      </td>
                      <?php endforeach?>

                      <td style="vertical-align:middle">
                        <?php
                          $query = $this->db->query("SELECT *
                                                    FROM tbl_alternatif
                                                    JOIN tbl_alternatif_kriteria ON tbl_alternatif.`id_alternatif`=tbl_alternatif_kriteria.`id_alternatif`
                                                    WHERE tbl_alternatif_kriteria.`id_alternatif` = '".$alt->id_alternatif."'");
                          $alternatif = $query->row();

                          if (!empty($alternatif)){ 
                          ?>
                          <a href="<?=base_url();?>c_smart/delete/<?=$alt->id_alternatif;?>" class="btn btn-danger tombol-hapus" data-toggles="tooltip" title="Hapus"><i class="fa fa-trash-o"></i></a>
                        <?php }else{ ?>
                          <a href="<?=base_url();?>c_smart/create/<?=$alt->id_alternatif;?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                        <?php } ?>
                      </td>
                    </tr>
                  <?php endforeach?>
              </tbody>
            </table>
            </div>
                <?php 
                if(!empty($altkrit->nilai_alternatif_kriteria) == '0' || !empty($altkrit->nilai_alternatif_kriteria)) :?>
                <div class="pull-right">
                  <button onclick="location.href='<?php echo base_url();?>c_smart/generate'" class="btn btn-primary">Generate Penilaian</button>
                </div>
                <?php endif?>
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