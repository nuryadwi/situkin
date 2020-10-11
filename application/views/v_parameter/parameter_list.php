<div class="col-md-12 col-sm-12 col-xs-12">
<div class="x_panel">
  <div class="x_title">
    <h2><?=$header;?></h2>
    <ul class="nav navbar-right panel_toolbox">
      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
      </li>
    </ul>
    <div class="clearfix"></div>
      <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>              
  </div>
    <div class="clearfix"></div>
  <br>
  <br>
    <div class="x-content">
      <div class="box" style="width: 400px;height: 90px;">
        <p style="color: red;">(*)<small><br>
              Cost Criteria = Kriteria untuk nilai yg lebih diinginkan lebih kecil. <br>
              Benefit Criteria = Kriteria untuk nilai yang diinginkan lebih besar.
              </small></p>
      </div>
      <br>
      <div class="clearfix"></div>
      <table id="datatable" class="table table-striped jambo_table table-bordered">
        <thead>
          <tr>
            <th width="2%">No.</th>
            <th width="25%">Nama Kriteria</th>
            <th width="10%">Nilai Minimal</th>
            <th width="10%">Nilai Maksimal</th>
            <th width="10%">Tipe</th>
            <th width="15%">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i=1;

          foreach ($data2 as $p) :
          ?>
          <tr>
            <th scope="row"><?=$i++?></th>
            <td><?=$p->kriteria.': '.$p->nama_kriteria?></td>
            <td><?=$p->min?></td>
            <td><?=$p->maks?></td>
            <td><?=rename_string_tipe($p->type)?></td>
            <td>
              <a data-toggle="modal" data-target="#modal_edit<?=$p->id_kriteria?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
              <a href="<?=base_url();?>c_parameter/delete/<?=$p->id_kriteria;?>" onclick="return confirm('Apakah kamu yakin mau menghapus ini?');" class="btn btn-danger"><i class="fa fa-trash-o"></i></a>
            </td>
          </tr>
        <?php endforeach?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php foreach ($data2 as $p) : ?>
<div class="modal fade" id="modal_edit<?=$p->id_kriteria?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">

        <div class="modal-header" style="background:#2A3F54;" >
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="myModalLabel2">Edit Data Parameter</h4>
        </div>
        <form autocomplete="off" class="form-horizontal form-label-left" action="<?=$action?>" enctype="multipart/form-data" method="post">
        <div class="modal-body">
        	<input type="hidden" name="id_kriteria"value="<?=$p->id_kriteria?>">

        	<div class="form-group">
	            <label>Nama Kriteria</label>
	            <div class="col-md-9 col-sm-9 col-xs-12">
	              <input class="form-control col-md-7 col-xs-12" type="text" name="kriteria" value="<?=$p->nama_kriteria?>" disabled>
	            </div>
	          </div>

	          <div class="form-group">
	            <label>Nilai Minimal</label>
	            <div class="col-md-9 col-sm-9 col-xs-12">
	              <input class="form-control col-md-7 col-xs-12" type="number" name="min" min="0" max="100" value="<?=$p->min?>">
	            </div>
	            <?php echo form_error('min'); ?>
	          </div>
	          <div class="form-group">
	            <label>Nilai Maksimal</label>
	            <div class="col-md-9 col-sm-9 col-xs-12">
	              <input class="form-control col-md-7 col-xs-12" type="number" name="maks" min="0" max="100" value="<?=$p->maks?>">
	            </div>
	            <?php echo form_error('maks'); ?>
	          </div>

            <div class="form-group col-md-9 col-xs-12">
            <label>Tipe</label>
              <select name="type" class="form-control" value="<?=$p->type?>">
              <option disabled selected>--Pilih Tipe--</option>
              <option value="1"<?php if($p->type == 1) { echo "selected";}?>>Benefit Criteria</option>
              <option value="2"<?php if($p->type == 2) { echo "selected";}?>>Cost Criteria</option>
              </select>
            <?php echo form_error('type'); ?>
          </div>

        </div>

        <div class="clearfix"></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary"><?=$button?></button>
        </div>
    	</form>
      </div>
    </div>
  </div>
  <?php endforeach?>