<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->library('form_validation');
        $this->load->model('user_model');
		
	}

    public function index() 
    {
        $idsess = $this->session->userdata('id_user');
        $row =  $this->user_model->get_user_by_id($idsess);
        $jab = $row->nama_jabatan." ".$row->nama_bagian;
             $data = array(
            'header' =>  "Profil",
            'button' => "Update Profil",
            'action' => site_url('profil/update_action'),
            'jabatan' => $jab,
            'status' => rename_string_status($row->status),
            'create_on' => $row->create_on,
            'last_login' => $row->last_login,
        'id_user'   => set_value('id_user',$row->id_user),
        'nip'       => set_value('nip', $row->nip),
        'nik'       => set_value('nik', $row->nik),
        'full_name'     => set_value('full_name', $row->full_name),
        'email'     => set_value('email', $row->email),
        'phone'     => set_value('phone', $row->phone),
        'gender'    => set_value('gender', $row->gender),
        'alamat'    => set_value('alamat', $row->alamat),
        'images'     => set_value('images', $row->images),
        );

        $this->template->load('master', 'pengguna/profil', $data);
    }


    function update_action()
    {
        $this->rules();
        $foto = $this->upload_foto();
        if($this->form_validation->run() == FALSE) {
            
            $this->index();
        }else{
            if(!empty($_FILES["images"]["name"])){
                $data = array(
                'id_user'       => $this->input->post('id_user', TRUE),
                'nip'           => $this->input->post('nip', TRUE),
                'nik'           => $this->input->post('nik', TRUE),
                'full_name'     => $this->input->post('full_name', TRUE),
                'email'         => $this->input->post('email', TRUE) ,
                'phone'         => $this->input->post('phone', TRUE),
                'gender'        => $this->input->post('gender', TRUE),
                'alamat'        => $this->input->post('alamat', TRUE),
                'images'        => $foto['file_name'],
            );
            }else{
                $data = array(
                'id_user'       => $this->input->post('id_user', TRUE),
                'nip'           => $this->input->post('nip', TRUE),
                'nik'           => $this->input->post('nik', TRUE),
                'full_name'     => $this->input->post('full_name', TRUE),
                'email'         => $this->input->post('email', TRUE) ,
                'phone'         => $this->input->post('phone', TRUE),
                'gender'        => $this->input->post('gender', TRUE),
                'alamat'        => $this->input->post('alamat', TRUE),
                'images'     => $_POST["old_images"],
            );  

            }
            //print_r($data);
            $this->user_model->update($this->session->userdata('id_user'),$data);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Data Berhasil Dirubah Silahkan login ulang jika Foto tidak muncul atau berubah
            </div>');
            redirect(site_url('profil'));
        } 
    }


    /*-- form_validation rules --*/
    public function rules()
    {
        $this->form_validation->set_rules('nik', 'NIK', 'trim|required');
        $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
        $this->form_validation->set_rules('phone', 'No. Telp', 'trim|required');
        $this->form_validation->set_rules('gender', 'Jenis Kelamin', 'trim|required');
        $this->form_validation->set_message('required', '{field} wajib diisi');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    /*-- Upload image config --*/
    private function upload_foto(){
        $config['upload_path']          = './assets/foto_profil';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['file_name']            = $_POST['id_user'];
        $config['overwrite']            = 'true';
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('images')) {
            $gbr = $this->upload->data();
            //compress
            $config['image_library'] ='gd2';
            $config['source_image'] = './assets/foto_profil/'.$gbr['file_name'];
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = FALSE;
            $config['quality'] = '50%';
            $config['width'] = '250';
            $config['height'] = '250';
            $config['new_image'] = './assets/foto_profil/'.$gbr['file_name'];
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
            return $gbr;

        }

        return "user.png";
        
    }

 /* Edit Password */
    public function ganti_password()
    {   
        $id = $this->session->userdata('id_user');
        $userSession =  $this->user_model->get_by_id($id);
        if($userSession){
            $data = array(
                    'button' => 'Ganti',
                    'action' => site_url('profil/do_ganti_password'),
                'header'    => "Ganti Password",
                'id_user'   => set_value('id_user', $userSession->id_user),
                'username' => set_value('username', $userSession->username),
            );
            $this->template->load('master','pengguna/ganti_password',$data);
        }else{
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert">Password tidak cocok</div>');
			redirect(site_url('profil'));
			
		}
    }

    public function do_ganti_password()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_message('required', '{field} wajib diisi');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
        
        if($this->form_validation->run()== FALSE) {
            $this->ganti_password($this->session->userdata('id_user', TRUE));
        }else{
            $id = $this->session->userdata('id_user');
            $password = $this->input->post('password', TRUE);
            $options = array("cost" => 4);
            $hashPassword = password_hash($password, PASSWORD_BCRYPT, $options);
            
            if (!empty($this->input->post('password'))) {
                $data = array(
                'username' => $this->input->post('username'),
                'password' => $hashPassword,
            );
            }else{
                $data = array(
                'username' => $this->input->post('username'), 
                );
            }
            
            $this->user_model->update_pass($data, $id);
            $this->session->set_flashdata('message', '<div class="alert alert-info">Password Berhasil Diganti
					</div>');  
			redirect(site_url('auth/logout'));
        }
    }

    
}
