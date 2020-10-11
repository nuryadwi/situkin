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
                
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr >
                          <th width="8%"> No.</th>
                          <th width="20%">NIP</th>
                          <th width="20%">NIK</th>
                          <th width="30%">Nama Lengkap</th>
                          <th width="30%">Jabatan</th>
                          <th width="30%">email</th>
                          <th width="30%">Foto</th>
                          <th width="30%">Jenis Kelamin</th>
                          <th width="30%">Alamat</th>
                          <th width="30%">Tanggal daftar</th>
                          <th width="30%">Terakhir Login</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                          <?php
                          $i=1;
                          foreach ($pegawai as $pe) :
                            ?>
                            <tr>
                              <td style="vertical-align:middle"><?=$i++?></td>
                              <td style="vertical-align:middle"><?=$pe->nip?></td>
                              <td style="vertical-align:middle"><?=$pe->nik?></td>
                              <td style="vertical-align:middle"><?=$pe->full_name?></td>
                              <td style="vertical-align:middle"><?=$pe->nama_jabatan." ".$pe->nama_bagian?></td>
                              <td style="vertical-align:middle"><?=$pe->email?></td>
                              <td>
                              <img alt="images" src="<?php echo base_url()?>assets/foto_profil/<?=$pe->images?>"class="img-circle img-responsive">
                              </td>
                              <td style="vertical-align:middle"><?=$pe->gender?></td>
                              <td style="vertical-align:middle"><?=$pe->alamat?></td>
                              <td style="vertical-align:middle"><?=$pe->create_on?></td>
                              <td style="vertical-align:middle"><?=$pe->last_login?></td>
                            </tr>
                          <?php endforeach?>
                      </tbody>
                    </table>
					
					
                  </div>
                </div>
              </div>
    