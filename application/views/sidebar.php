<div class="menu_section">
                <ul class="nav side-menu">
                  <h3>Menu</h3>
                  <li><a href="<?php echo base_url('home')?>"><i class="fa fa-home"></i>BERANDA</a></li>
                <!-- area menu dinamis -->
                  <?php
                  //cek settingan tampilan menu
                  $setting = $this->db->get_where('t_setting',array('id_setting'=>1))->row_array();
                  if($setting['value']=='ya'){
                      // cari level user
                      $id_role = $this->session->userdata('id_role');
                      $sql_menu = "SELECT * 
                      FROM t_menu 
                      WHERE id_menu in(select id_menu from t_hak_akses where id_role=$id_role) and is_main_menu=0 and is_aktif='y'";
                  }else{
                      $sql_menu = "select * from t_menu where is_aktif='y' and is_main_menu=0";
                  }

                  $main_menu = $this->db->query($sql_menu)->result();
                  foreach ($main_menu as $menu){
                        //cek sub menu
                    $this->db->where('is_main_menu',$menu->id_menu);
                    $this->db->where('is_aktif','y');
                    $submenu = $this->db->get('t_menu');
                    // $submenu = $this->db->get_where('t_menu', array('is_main_menu'=>$menu->id_menu));
                    if($submenu->num_rows()>0){
                      //tampilkan sub menu
                      echo "<li>
                            <a href='javascript:void(0)'>
                            <i class='".$menu->icon."'></i> <span>".strtoupper($menu->title)."</span>
                            <span class='fa fa-chevron-down'></span>
                            </a>
                            <ul class='nav child_menu'>";
                            
                        foreach($submenu->result() as $sub){
                        echo "<li>".anchor($sub->url,"<i class='".$sub->icon."'></i>".strtoupper($sub->title))."</li>";
                      }
                      echo "</ul>
                            </li>";
                    }else{
                      //tampilkan main menu
                      echo "<li>".anchor($menu->url,"<i class='".$menu->icon."'></i>".strtoupper($menu->title))."</li>";
                    }
                  }
                  ?>
                  
                  <li><?php echo anchor('auth/logout',"<i class='fa fa-sign-out'></i> LOGOUT");?></li>
                </ul>

              </div> 