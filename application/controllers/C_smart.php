<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_smart extends CI_Controller {

    function __construct()
    {
        parent::__construct();
            is_login();
            $this->load->library('form_validation');
            $this->load->model('c_smart_model');
            $this->load->model('c_kriteria_model');
    }

    function index()
    {
    	$data = array(
    		'header' => "Data Penilain Pegawai",
    		'kriteria' =>  $this->c_kriteria_model->get_all('tbl_kriteria')->result(),
    		'alter' => $this->c_smart_model->get_alter(),
    		);
    	$this->template->load('master','v_smart/smart_list', $data);
    }


    function create($id)
    {	
        $row = $this->c_smart_model->get_alter_by_id($id);
        //get jumlah tugas bulan ini
        $bln = date('m');
        $thn = date('Y');
        $awal = $thn.'-'.$bln.'-01';
        $akhir = $thn.'-'.$bln.'-31';
        $where = ['tanggal >=' => $awal, 'tanggal <=' => $akhir, 't_tugas.id_user' => $row->id_user];
        $this->db->select_sum('jml','jumlah');
        $this->db->from('t_tugas');
        $this->db->where($where);
        $jml = $this->db->get()->row();
        
	   	$data = array(
    		'header' => "Form Penilaian Pegawai",
    		'action' => site_url('c_smart/simpan'),
    		'button' => "Simpan",
    		'alter' => $this->c_smart_model->get_alter(),
    		//'kriteria' => $this->c_kriteria_model->get_all('tbl_kriteria')->result(),
            'kriteria' => $this->c_kriteria_model->get_kriteria_param(),
    		'nip' => $row->nip,
    		'nama' => $row->full_name,
    		'jabatan' => $row->nama_jabatan,
    		'bagian' => $row->nama_bagian,
            'tugas' => $jml->jumlah,
            //isi form
    		'alt' => set_value('alt', $row->id_alternatif),
    		'kri' => set_value('kri'),
    		'altkri' => set_value('altkri'),

    	);
    	$this->template->load('master','v_smart/smart_form', $data);
    }

    function simpan()
    {
    	//id_altrtnatif
    	$alt = $_POST['alt'];
    	$stmtx1 = $this->c_kriteria_model->get_all('tbl_kriteria')->result();
    	foreach ($stmtx1 as $rowx1) {
    		if ($rowx1->id_kriteria == true) {
    			//id_kriteria
    			$idkri = $rowx1->id_kriteria;
    		      //array kriteria
    			$kri = $_POST['kri'][$idkri];
    			//get c_max
    			$param = $this->c_smart_model->get_param($kri);
    			$c_max = $param->maks;
    			$c_min = $param->min;
    			//c_out
    			$altkri = $_POST['altkri'][$idkri];
    		}
    		$c_out = $altkri;
    		$ida = $alt;

    		if ($param->type == '2') { //cost
    			$utl = (($c_max-$c_out)/($c_max-$c_min)*100);
    		}else{
    			$utl = (($c_out-$c_min)/($c_max-$c_min)*100);
    		}
            $hsl = $utl*$rowx1->bobot_rerata;	

    		$data[] = array(
    			'id_alternatif' => $alt,
    			'id_kriteria'  => $kri,
    			'nilai_alternatif_kriteria' => $utl,
                'bobot_alternatif_kriteria' => $hsl,
    		);
            //data nilai awal
            $data2[] = array(
                'id_alternatif' =>$alt,
                'id_kriteria' => $kri,
                'nilai_awal' => $c_out,
            );
    	}
    	$this->c_smart_model->insert($data);
        //insert data nilai awal utk raport
        $this->c_smart_model->insert2($data2);
        $this->session->set_flashdata('message', '<div class="alert alert-info">Data Berhasil disimpan</div>');  
        redirect(site_url('c_smart'));
    }

    function generate()
    {
        $data = array(
            'header' => "Hasil Penilaian",
            'kriteria' => $this->c_kriteria_model->get_all('tbl_kriteria')->result(),
            'alter' => $this->c_smart_model->get_alter(),
        );

        $this->template->load('master', 'v_smart/exe_smart', $data);
    }

    public function delete() 
    {
		$id = $this->uri->segment(3);
		$this->c_smart_model->destroy($id);
        $this->c_smart_model->destroy2($id);
		$this->session->set_flashdata('message', '<div class="alert alert-success">Data Berhasil dihapus</div>');		
        redirect('c_smart');
    }

    public function cetak()
    {
        $get_kriteria = $this->c_kriteria_model->get_all('tbl_kriteria')->result();
        $get_alternatif = $this->c_smart_model->get_alter();
       
        $this->load->library('pdf_penilaian');
        $pdf= new PDF_Penilaian('L', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->SetMargins(30,18,20); //top, left, right
        $pdf->AddPage();
        $pdf->Content();
        $pdf->Cell(1, 7, 'NILAI DASAR', 0, 1);
        $pdf->Cell(7, 7, 'No.', 1, 0,'C');
        $pdf->Cell(42, 7, 'Pegawai', 1, 0, 'C');
        $pdf->Cell(45, 7, 'Jabatan', 1, 0, 'C');
        foreach ($get_kriteria as $k) {
            $pdf->Cell(15, 7, $k->kriteria, 1, 0, 'C');
        }
        $pdf->Cell(27, 7, 'Tugas Terkumpul', 1, 1,'C');
        $i = 1;
        foreach($get_alternatif as $a) {
            $pdf->Cell(7, 7, $i++, 1, 0,'C');
            $pdf->Cell(42, 7, $a->full_name, 1, 0);
            $pdf->Cell(45, 7, $a->nama_jabatan." ".$a->nama_bagian, 1, 0);
            foreach ($get_kriteria as $k) {
                $alt_kri = $this->c_smart_model->get_nilai_awal($k->id_kriteria, $a->id_alternatif)->result();
                if(!empty($alt_kri)) {
                    foreach($alt_kri as $alt_kri) {
                        $pdf->Cell(15, 7, round($alt_kri->nilai_alternatif_kriteria,3), 1, 0, 'C');
                    }
                }else{
                    $pdf->Cell(15, 7,'-', 1, 0, 'C');
                }
                
            }
            $bln = date('m');
            $thn = date('Y');
            $awal = $thn.'-'.$bln.'-01';
            $akhir = $thn.'-'.$bln.'-31';
            $where = ['tanggal >=' => $awal, 'tanggal <=' => $akhir, 't_tugas.id_user' => $a->id_user];
            $this->db->select_sum('jml','jumlah');
            $this->db->from('t_tugas');
            $this->db->where($where);
            $jml = $this->db->get()->row();

            $pdf->Cell(27, 7, $jml->jumlah, 1, 1, 'C');
        }
        
        $pdf->Cell(1, 10, '', 0, 1);
        $pdf->Cell(1, 7, 'URAIAN PENILAIAN', 0, 1);
        $pdf->Cell(7, 7, 'No.', 1, 0,'C');
        $pdf->Cell(53, 7, 'Pegawai', 1, 0, 'C');
        foreach ($get_kriteria as $k) {
            $pdf->Cell(15, 7, $k->kriteria, 1, 0, 'C');
        }
        $pdf->Cell(15, 7, 'Hasil', 1, 0,'C');
        $pdf->Cell(45, 7, 'Keterangan', 1, 1,'C');
        #tampil baris bobot
        $pdf->Cell(7, 7, '-', 1, 0,'C');
        $pdf->Cell(53, 7, 'Bobot Normalisasi', 1, 0, 'C');
        foreach ($get_kriteria as $k2) {
            $pdf->Cell(15, 7, round($k2->bobot_rerata,3), 1, 0, 'C'); 
        }
        $pdf->Cell(15, 7, '-', 1, 0,'C');
        $pdf->Cell(45, 7, '-', 1, 1,'C');
        #tampil hasil
        $i = 1;
        foreach ($get_alternatif as $alt) {
            $pdf->Cell(7,7,$i++,1,0,'C');
            $pdf->Cell(53,7, $alt->full_name, 1, 0);
            foreach ($get_kriteria as $k ) {
                $alt_kri2 = $this->c_smart_model->get_nilai_awal($k->id_kriteria, $alt->id_alternatif)->result();
                if(!empty($alt_kri2)) {
                    foreach($alt_kri2 as $alt_k2) {
                        $pdf->Cell(15, 7, round($alt_k2->bobot_alternatif_kriteria,3), 1, 0, 'C'); 
                    }
                }else{
                    $pdf->Cell(15,7,'-',1,0,'C');
                }
            }

            //if nilai kosong
            if (!empty($alt_kri2)) {
                $pdf->Cell(15, 7, $alt->hasil_alternatif, 1, 0,'C');
            }else{
                $pdf->Cell(15, 7, '-', 1, 0,'C');
            }
            //tampil keterangan
            $pdf->Cell(45, 7, $alt->ket_alternatif, 1, 1,'C');
        }

         //keterangan
        $pdf->Cell(30, 10, '', 0, 1);
        $pdf->Cell(30, 7, 'KETERANGAN KRITERIA', 0, 0,'J');
        $pdf->Cell(30, 7, '', 0, 1);

        $pdf->SetWidths(Array(7,15,70));
        $pdf->SetLineHeight(5);
        $pdf->SetAligns(Array('C','C','L'));
        $pdf->Cell(7, 7, 'No.', 1, 0,'C');
        $pdf->Cell(15, 7, 'Kode', 1, 0,'C');
        $pdf->Cell(70, 7, 'Deskripsi', 1, 1, 'C');
        
        $pdf->SetFont('Arial', '',10);
        //isi
        $i=1;
        foreach ($get_kriteria as $k3) {
            $pdf->Row(Array(
                $i++,
                $k3->kriteria,
                $k3->deskripsi,
            ));
        }
        //catatan kaki
        $pdf->Cell(1, 20,'', 0, 1);
        $pdf->Cell(175);
        $pdf->Cell(55, 5, 'Bantul, '.tgl_new('d-m-Y '), 0, 1);
        $pdf->Cell(175);
        $pdf->Cell(47, 5, 'Pimpinan', 0, 1);
        $pdf->Cell(1, 30, '', 0, 1);
        $pdf->Cell(175);
        $pdf->Cell(47, 5, 'Lurah', 0, 1, 'C');

        $filename = 'Laporan Penilaian Pegawai-'.date('d-m-Y').'.pdf';
        $pdf->Output($filename,'D');
    }
}