<div class="x_panel">
<?php echo alert('alert-info', 'Perhatian', 'Silahkan Cheklist Pada Menu Yang Akan Diberikan Akses') ?>
  <div class="x_title">
  <h2><?=$header;?> : <b><?php echo $level['nama_role'] ?></b></h2>
    <ul class="nav navbar-right panel_toolbox">
    
      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
      </li>

      <li><a class="close-link"><i class="fa fa-close"></i></a>
      </li>
    </ul>
    <div class="clearfix"></div>
  </div>
  <div class="x_content">
    <div class="table-responsive">
      <table class="table table-striped jambo_table bulk_action">
        <thead>
          <tr class="headings">
            <th width="15px">No</th>
            <th>Nama Modul</th>
            <th width="100px">Beri Akses</th>
          </tr>
        </thead>

        <tbody>
        <?php
          $no = 1;
          foreach ($menu as $m) {
              echo "<tr>
              <td>$no</td>
              <td>$m->title</td>
              <td align='center'><input type='checkbox' ".  checked_akses($this->uri->segment(3), $m->id_menu)." onClick='kasi_akses($m->id_menu)'></td>
              </tr>";
              $no++;
          }
          ?>
          
        </tbody>
      </table>
    </div>
    <a href="<?=base_url();?>userlevel" class="btn btn-success pull-right">Selesai</i></a>
  </div>
</div>

<script type="text/javascript">
    function kasi_akses(id_menu){
        //alert(id_menu);
        var id_menu = id_menu;
        var level = '<?php echo $this->uri->segment(3); ?>';
        //alert(level);
        $.ajax({
            url:"<?php echo base_url()?>userlevel/kasi_akses_ajax",
            data:"id_menu=" + id_menu + "&level="+ level ,
            success: function(html)
            { 
              alertSuccess('sukses');
            }
        });
    }    
</script>