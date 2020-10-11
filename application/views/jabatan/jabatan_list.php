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
      <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
    </div>
    <div class="x_content">
    <button class="btn btn-primary" data-toggle="modal" data-target="#add_jabatan">Tamabah Data</button>

      <table id="datatable" class="table table-striped jambo_table table-bordered">
        <thead>
          <tr>
            <th width="2%">No.</th>
            <th width="50%">Nama Level</th>
            <th width="15%">Action</th>
          </tr>
        </thead>
        <tbody>
        <?php 
          $i =1;
          foreach($jabatan->result() as $jab) :
        ?>
          <tr>
            <td style="vertical-align:middle"><?=$i++;?></td>
            <td style="vertical-align:middle"><?=$jab->nama_jabatan;?></td>
            <td style="vertical-align:middle">
                <a href="<?=base_url();?>jabatan/update/<?=$jab->id_jabatan;?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                <a href="<?=base_url();?>jabatan/delete/<?=$jab->id_jabatan;?>" class="btn btn-danger tombol-hapus" data-toggles="tooltip" title="Hapus"><i class="fa fa-trash-o"></i></a>
            </td>
          </tr>
          <?php endforeach;?>  
        </tbody>
      </table>
    </div>
  </div>
</div>


<!-- modal add -->
<div class="modal fade" id="add_jabatan" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">

      <div class="modal-header" style="background:#2A3F54;" >
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel2">Tambah Jabatan</h4>
      </div>
      <div class="modal-body">

        <form class="form-horizontal form-label-left" action="<?php echo $action; ?>" enctype="multipart/form-data" method="post">

          <input type="hidden" name="id_jabatan" class="form-control col-md-7 col-xs-12" id="id_jabatan" value="<?=$id_jabatan?>">

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Jabatan</label>
            <div class="col-md9 col-sm-9 col-xs-12">
              <input type="text" name="nama_jabatan" class="form-control col-md-7 col-xs-12" id="nama_jabatan" Placeholder="Nama Jabatan" value="<?= $nama_jabatan; ?>">
            </div>
            <?php echo form_error('nama_jabatan'); ?>
          </div>     
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        <button type="submit"  class="btn btn-primary">Simpan</button>
      </div>
      </form>

    </div>
  </div>
</div>