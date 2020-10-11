<div class="x_content">
<?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>

<!-- Tampilan Dashboard Admin --> 
<?php if($this->session->userdata('id_role')==='1'){?>
  <?php $this->load->view('dashboard_admin')?>
<!-- end admin --> 

<!-- Tampilan Dashboard Operator -->  
<?php } else if($this->session->userdata('id_role')==='6') {?>

  <?php $this->load->view('dashboard_op')?>
<!-- end operator -->

<!-- Tampilan Dashboard User -->  
<?php }else{ ?>
  <?php $this->load->view('dashboard_user')?>
<!-- end admin -->
<?php }?>
</div>
