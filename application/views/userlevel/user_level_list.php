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
    <a href="<?=base_url();?>userlevel/create" class="btn btn-primary">Tamabah Data</i></a>
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
          foreach($data->result() as $level) :
        ?>
          <tr>
            <td style="vertical-align:middle"><?=$i++;?></td>
            <td style="vertical-align:middle"><?=$level->nama_role;?></td>
            <td style="vertical-align:middle">
                <a href="<?=base_url();?>userlevel/akses/<?=$level->id_role;?>" class="btn btn-primary"><i class="fa fa-unlock-alt"></i></a>
                <a href="<?=base_url();?>userlevel/update/<?=$level->id_role;?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>      
                <a href="<?=base_url();?>userlevel/delete/<?=$level->id_role;?>" class="btn btn-danger tombol-hapus" data-toggles="tooltip" title="Hapus"><i class="fa fa-trash-o"></i></a>
            </td>
          </tr>
          <?php endforeach;?>  
        </tbody>
      </table>
    </div>
  </div>
</div>