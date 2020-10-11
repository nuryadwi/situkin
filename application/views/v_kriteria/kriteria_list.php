<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2><?=$header?></h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
        </ul>
        <div class="clearfix"></div>
        <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
      </div>
      <div class="x_content">
          <form class="form-horizontal form-label-left" action="<?php echo $action; ?>" enctype="multipart/form-data" method="post">
            <div class="col-md-2 col-sm-2 col-xs-12 form-group">
              <label class="col-md-16 col-sm-16 col-xs-16 form-group">Kode Kriteria</label>
              <input type="text" placeholder="Kode Kriteria" name="kriteria" class="form-control">
              <br>
              <?php echo form_error('kriteria'); ?>
            </div>
            <div class="col-md-3 col-sm-12 col-xs-12 form-group">
              <label class="col-md-16 col-sm-16 col-xs-16 form-group">Nama Kriteria</label>
              <input type="text" placeholder="Nama Kriteria" name="nama_kriteria" class="form-control">
              <br>
              <?php echo form_error('nama_kriteria'); ?>
            </div>
            <div class="col-md-3 col-sm-12 col-xs-12 form-group">
              <label class="col-md-16 col-sm-16 col-xs-16 form-group">Deskripsi Kriteria</label>
              <textarea name="deskripsi" class="form-control" rows="3" placeholder='Deskripsi'></textarea>
              <br>
              <?php echo form_error('deskripsi'); ?>
            </div>
            
            <label class="col-md-16 col-sm-16 col-xs-16 form-group">Nilai Untuk Kepentingan Pertama</label>
            <div class="col-md-2 col-sm-2 col-xs-12 form-group">   
              <input type="number" name="bobot1" min="1" max="100" class="form-control">
              <label style="color: red;"><small>(*) Angka</small></label><br>
              <?php echo form_error('bobot1'); ?>
            </div>

            <label class="col-md-16 col-sm-16 col-xs-16 form-group">Nilai Untuk Kepentingan Kedua</label>
            <div class="col-md-2 col-sm-2 col-xs-12 form-group"> 
              <input type="number" name="bobot2" min="1" max="100" class="form-control">
              <label style="color: red;"><small>(*) Angka</small></label><br>
              <?php echo form_error('bobot2'); ?>
            </div>
            
            <div class="clearfix"></div>
            <div class="col-md-3 col-sm-12 col-xs-12 form-group">
              <button type="submit"  class="btn btn-primary"><?php echo $button ?></button>
            </div>
          </form>
      </div>
      <div class="clearfix"></div>
      <br>
      <br>
      <label><i style="color: red;">(*)</i><u>Kosongkan normalisasi relatif dulu jika ingin mengubah data kriteria</u></label>
      <div class="clearfix"></div>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <label>Tabel 1.Normalisasi Bobot Kriteria dari Paling Penting</label>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <table class="table table-striped jambo_table table-bordered">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Kriteria</th>
                  <th>Bobot</th>
                  <th>Bobot Relatif 1</th>
                  <th>Hapus Kriteria</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $i=1;
                foreach ($krit as $k1):
                ?>
                <tr>
                  <th scope="row"><?=$i++; ?></th>
                  <td><?=$k1->kriteria; ?></td>
                  <td><?=$k1->bobot1; ?></td>
                  <td><?=round($k1->norm1,3); ?></td>
                  <td style="text-align: center;">
                
                  <a href="<?=base_url();?>c_kriteria/delete/<?=$k1->id_kriteria;?>" class="tombol-hapus" data-toggles="tooltip" title="Hapus"><i class="fa fa-close" style="color:red;"></i></a>
                  </td>
                </tr>
              <?php endforeach;?>
              <tr> 
                <td colspan="2" style="background:#2A3F54; color:white;">Jumlah</td>
                <td><b><?=$jml1->bobot_norm_1?></b></td>                      
                <td colspan="4" style="background: #2A3F54;"></td>
              </tr>
              </tbody>
            </table>
            <a href="<?=base_url();?>c_kriteria/norm1" class="btn btn-primary"><i class="fa fa-gear"></i> Normalisasi</a>
            <a href="<?=base_url();?>c_kriteria/delete_norm" class="btn btn-danger pull-right"><i class="fa fa-trash-o"></i> Kosongkan Relatif 1</a>
          </div>
        </div>
      </div>

      <!-- tampil tabel 2 -->
      <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <label>Tabel 2.Normalisasi Bobot Kriteria dari Tidak Penting</label>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <table class="table table-striped jambo_table table-bordered">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Kriteria</th>
                  <th>Bobot</th>
                  <th>Bobot Relatif 2</th>
                  <th>Hapus Kriteria</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $i=1;
                foreach ($krit as $k2):
                ?>
                <tr>
                  <th scope="row"><?=$i++; ?></th>
                  <td><?=$k2->kriteria; ?></td>
                  <td><?=$k2->bobot2; ?></td>
                  <td><?=round($k2->norm2,3); ?></td>
                  <td style="text-align: center">     
                    <a href="<?=base_url();?>c_kriteria/delete/<?=$k2->id_kriteria;?>" class="tombol-hapus" data-toggles="tooltip" title="Hapus"><i class="fa fa-close" style="color:red;"></i></a>
                  </td>
                </tr>
              <?php endforeach;?>
              <tr> 
                <td colspan="2" style="background:#2A3F54; color:white;">Jumlah</td>
                <td><b><?=$jml2->bobot_norm_2?></b></td>
                <td colspan="4" style="background: #2A3F54;"></td>
              </tr>
              </tbody>
            </table>
            <a href="<?=base_url();?>c_kriteria/norm2" class="btn btn-primary"><i class="fa fa-gear"></i> Normalisasi</a>
              <a href="<?=base_url();?>c_kriteria/delete_norm2" 
            class="btn btn-danger pull-right"><i class="fa fa-trash-o"></i> Kosongkan Relatif 2</a>
          </div>
        </div>
      </div>

      <!-- tampil tabel bobot rata rata -->
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <label>Tabel Normalisasi Bobot Kriteria Rata-rata</label>
            <div class="clearfix"></div>
          </div>
          <a href="<?=base_url();?>c_kriteria/rerata" class="btn btn-primary"><i class="fa fa-gear"></i> Get Rata-rata</a>
          <div class="x_content">
            <table id="datatable" class="table table-striped jambo_table table-bordered">
              <thead style="background: #2A3F54; color: white;">
                <tr>
                  <th width="2%">No.</th>
                  <th width="5%">Kode</th>
                  <th width="15%">Nama Kriteria</th>
                  <th width="10%">Bobot Rerata</th>
                  <td width="20%">Deskripsi</td>
                  <td width="5%">Aksi</td>
                </tr>
              </thead>
              <tbody>
                <?php
                $i=1;
                foreach ($rata as $r) :
                ?>
                <tr>
                  <th scope="row"><?=$i++;?></th>
                  <td><?=$r->kriteria;?></td>
                  <td><?=$r->nama_kriteria?></td>
                  <td><?=round($r->bobot_rerata,3);?></td>   
                  <td><?=$r->deskripsi?></td>
                  <td>
                    <a data-toggle="modal" data-target="#modal_edit<?=$r->id_kriteria?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                  </td>
                </tr>
              <?php endforeach;?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php foreach ($rata as $r) : ?>
<div class="modal fade" id="modal_edit<?=$r->id_kriteria?>" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">

      <div class="modal-header" style="background:#2A3F54;" >
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel2">Edit Data Kriteria</h4>
      </div>
      <form autocomplete="off" class="form-horizontal form-label-left" action="<?php echo base_url()?>c_kriteria/update" enctype="multipart/form-data" method="post">
      <div class="modal-body">
        <input type="hidden" name="id_kriteria"value="<?=$r->id_kriteria?>">
          <label>Nama Kriteria</label>
          <div class="form-group">        
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input class="form-control col-md-7 col-xs-12" type="text" name="nama_kriteria" value="<?=$r->nama_kriteria?>">
            </div>
          </div>

          <label>Deskripsi</label>
          <div class="form-group">   
            <div class="col-md-9 col-sm-9 col-xs-12">
              <textarea name="deskripsi" class="form-control" rows="3" placeholder='Deskripsi'><?=$r->deskripsi?></textarea>
            </div>
          </div>
          <div class="clearfix"></div>
          <small>(*)tarik bagian pojok kanan bawah untuk memperbesar form</small>
      </div>

      <div class="clearfix"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
    </form>
    </div>
  </div>
</div>
<?php endforeach?>