<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2><?=$header?></h2>
              <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                  <li><a class="close-link"><i class="fa fa-close"></i></a></li>
              </ul>
              <div class="clearfix"></div>
              <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
          </div>
              <div class="x_content">
                   <form class="form-horizontal form-label-left" action="<?php echo $action; ?>" enctype="mutlipart/form-data" method="post">
                     
                    <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12">Tampilkan Menu Berdasarkan Level</label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <?php
                            echo form_dropdown('tampil_menu', array('ya' => 'YA', 'tidak' => 'TIDAK'), $setting['value'], array('class'=> 'form-control'));
                          ?>
                        </div>
                        
                        </div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit"  class="btn btn-success"><?php echo $button ?></button> 
                        </div>
                      </div>
                    <div class="ln_solid"></div>
                   </form>
              </div>
            <div class="x-content">
                <a href="<?=base_url();?>kelolamenu/create" class="btn btn-primary">Tambah Menu</i></a>
                <table id="datatable" class="table table-striped jambo_table table-bordered">
                  <thead>
                    <tr>
                      <th width="2%">No.</th>
                      <th width="25%">Title</th>
                      <th width="15%">Url</th>
                      <th width="15%">Icon</th>
                      <th width="15%">Is Main Menu</th>
                      <th width="10%">Is Aktif</th>
                      <th width="15%">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no=1;
                      foreach($menu as $m) :
                     ?>
                    <tr>
                      <td style="vertical-align:middle"><?=$no++;?></td>
                      <td style="vertical-align:middle"><?=$m->title;?></td>
                      <td style="vertical-align:middle"><?=$m->url;?></td>
                      <td style="vertical-align:middle"><?=$m->icon;?></td>
                      <td style="vertical-align:middle"><?=$m->is_main_menu;?></td>
                      <td style="vertical-align:middle"><?=rename_string_is_aktif($m->is_aktif);?></td>
                      <td style="vertical-align:middle">
                        <a href="<?=base_url();?>kelolamenu/update/<?=$m->id_menu;?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                        <a href="<?=base_url();?>kelolamenu/delete/<?=$m->id_menu;?>" class="btn btn-danger tombol-hapus" data-toggles="tooltip" title="Hapus"><i class="fa fa-trash-o"></i></a>
                      </td>
                    </tr>
                  <?php endforeach;?>
                  </tbody>
                </table>
            </div>
    </div>
</div>

