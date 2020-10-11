<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Smart_report extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('c_smart_model');
        $this->load->model('c_kriteria_model');
    }

    public function index()
    {
        $data['header'] = "Laporan Data Penilaian Pegawai";
        $data['kriteria'] = $this->c_kriteria_model->get_all('tbl_kriteria')->result();
        $data['alter'] = $this->c_smart_model->get_alter();

        $this->template->load('master','v_smart/exe_smart', $data);
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