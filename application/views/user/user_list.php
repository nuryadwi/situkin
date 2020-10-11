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
        <a href="<?=base_url();?>user/create" class="btn btn-primary">Tambah User</i></a>
        <table id="datatable" class="table table-striped jambo_table table-bordered">
          <thead>
            <tr>
              <th width="2%">No.</th>
              <th width="10%">nip</th>
              <th width="10%">username</th>
              <th width="13%">Nama</th>
              <th width="3%">Level</th> 
              <th width="12%">Jabatan</th>
              <th width="5%">Status</th>
              <th width="10%">Reset</th>
              <th width="10%">Opsi</th>
            </tr>
          </thead>
          <tbody>
              <?php 
              $i =1;
              foreach($data as $user) :
              ?>
            <tr>
                <td style="vertical-align:middle"><?=$i++;?></td>            
                <td style="vertical-align:middle"><?=$user->nip;?></td>
                <td style="vertical-align:middle"><?=$user->username;?></td>
                <td style="vertical-align:middle"><?=$user->full_name;?></td>
                <td style="vertical-align:middle"><?=$user->nama_role;?></td>
                <td style="vertical-align:middle"><?=$user->nama_jabatan.' '.$user->nama_bagian;?></td>
                <td style="vertical-align:middle">
                <?php if($user->status == 1) {?>
                    <a href="<?=base_url();?>user/status/2/<?=$user->id_user;?>" class="btn btn-success" onclick="return confirm('Apakah kamu yakin akan menonaktifkan akun ini?');">Aktif</a>
                <?php } else { ?>
                    <a href="<?=base_url();?>user/status/1/<?=$user->id_user;?>" class="btn btn-danger" onclick="return confirm('Apakah kamu yakin akan mengaktifkan akun ini kembali?');">Non Aktif</a>
                <?php }?>
                </td>

                <td style="vertical-align:middle">
                  <?php if ($user->id_user !== '1') { ?>
                    <a href="<?=base_url();?>user/reset_pass/<?=$user->id_user;?>" class="btn btn-primary"><i class="fa fa-key" onclick="return confirm('Apakah kamu yakin akan mereset password akun ini?');"></i></a>
                  <?php } ?>
                </td>

                <td style="vertical-align:middle">
                    <a href="<?=base_url();?>user/update/<?=$user->id_user;?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                    
                    <a href="<?=base_url();?>user/delete/<?=$user->id_user;?>" class="btn btn-danger" onclick="return confirm('Apakah kamu yakin mau menghapus ini?');"><i class="fa fa-trash-o"></i></a>
                </td>
            </tr>
              <?php endforeach;?>      
          </tbody>
        </table>
      </div>
  </div>
  <div class="box" style="width: 400px; height: 70px">
  <p style="color: red;">(*)<small>Reset password: password akan di reset sama seperti dengan username akun tesebut</small></p>
  </div>
</div>
    