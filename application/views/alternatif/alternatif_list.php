<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel" >
    <div class="x_title">
      <h2><?=$header?></h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>
        <li><a class="close-link"><i class="fa fa-close"></i></a>
        </li>
      </ul>
      <div class="clearfix"></div>
      <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
    </div>
    <div class="x_content">
      <table id="datatable" class="table table-striped jambo_table table-bordered">
        <thead>
          <tr>
            <th width="2%">No.</th>
            <th width="10%">Jabatan</th>
            <th width="10%">Tambah Pegawai</th>
            <th width="20%">Alternatif</th>
            <th width="5%">Action</th>
          </tr>
        </thead>
        <tbody>
        
        <?php 
          $i =1;
          foreach($jabatan as $jab) :
        ?>
          <tr>
            <td style="vertical-align:middle"><?=$i++;?></td>
            <td style="vertical-align:middle"><?=$jab->nama_jabatan.' '.$jab->nama_bagian?></td>
            <td style="vertical-align:middle">   
              <a data-toggle="modal" data-target="#modal_add<?=$jab->id_bagian?>" style="color:yellow;" class="btn btn-primary"><i class="fa fa-edit"></i></a>
            </td>
            <td style="vertical-align:middle">
              <?php 
            $query = $this->db->query("select * 
                                      from tbl_alternatif 
                                      join t_users on t_users.id_user=tbl_alternatif.id_user
                                      where tbl_alternatif.id_bagian='".$jab->id_bagian."'");
            $alternatif = $query->result();
            foreach ($alternatif as $alt) :
            ?>
            <?=$alt->full_name;?>
            </td>  
            <td style="vertical-align:middle">
              <a href="<?= base_url();?>alternatif/delete/<?=$alt->id_alternatif; ?>" style="color:red;" onclick="return confirm('Apakah kamu yakin mau menghapus ini?');">
              <span class="glyphicon glyphicon-remove"></span></a>
            </td>
            <?php endforeach?>
          </tr>
          <?php endforeach;?>  
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php foreach ($pegawai as $p) :?>

  <div class="modal fade" id="modal_add<?=$p->id_bagian?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">

        <div class="modal-header" style="background:#2A3F54;">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="myModalLabel2" >Tambah Pegawai</h4>
        </div>
        <form autocomplete="off" class="form-horizontal form-label-left" action="<?=$action; ?>" enctype="multipart/form-data" method="post">

        <div class="modal-body">
          <p><?=$p->nama_jabatan." ".$p->nama_bagian?></p>
        </div>
        <input type="hidden" name="bagian" id="bagian" value="<?=$p->id_bagian;?>"/>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Pegawai</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <select class="form-control" name="id_user" id="id_user">
                <option value="" disabled selected>--Pilih Pegawai--</option>
                <?php
                $query = $this->db->query("SELECT *
                        FROM t_users
                        JOIN t_bagian ON t_users.`id_bagian`=t_bagian.`id_bagian`
                        JOIN t_jabatan ON t_bagian.`id_jabatan`=t_jabatan.`id_jabatan`
                        WHERE t_users.`id_bagian`='".$p->id_bagian."'");

                $peg = $query->result(); 

                foreach ($peg as $pe):
                  ?>
                  <option <?php echo $pegawai_selected == $pe->id_user ? 'selected="selected"' :''?>

                    value="<?php echo $pe->id_user?>">
                  <?php echo $pe->full_name ?>
                  </option>
                <?php endforeach?>
                
              </select>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <?php endforeach?>
