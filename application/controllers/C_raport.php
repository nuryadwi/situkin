<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class C_raport extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->library('form_validation');
        $this->load->model('user_model');
        $this->load->model('c_kriteria_model');
        $this->load->model('bukupegawai_model');
        $this->load->model('c_smart_model');

    }

    function index()
    {   
        $idsess = $this->session->userdata('id_user');
        $row1 = $this->user_model->get_user_by_id($idsess);
        $row2 = $this->bukupegawai_model->get_ket($idsess);
        $data  = array(
            'header' => "Raport Pegawai",
            'nip'   => $row1->nip,
            'nama'   => $row1->full_name,
            'jabatan' => $row1->nama_jabatan,
            'bagian' => $row1->nama_bagian,
            'ket' => $row2->ket_alternatif,
            'kriteria' => $this->c_kriteria_model->get_kriteria(), 
        );
        $this->template->load('master', 'v_raport/raport_pegawai', $data);
    }

    public function cetak()
    {
        $id = $this->session->userdata('id_user');
        $get_user = $this->user_model->get_user_by_id($id);
        $get_nilai = $this->c_smart_model->get_nilai($id);

        $this->load->library('pdf_raport');
        $pdf= new PDF_Raport('P', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->SetMargins(30,10,20); //top, left, right
        $pdf->AddPage();
        $pdf->Content();

        $pdf->Cell(1, 7, 'STAFF YANG DINILAI', 0, 1);
        $pdf->Cell(1, 5, 'NIP                    :'.$get_user->nip, 0, 1);
        $pdf->Cell(1, 5, 'Nama                 :'.$get_user->full_name, 0, 1);
        $pdf->Cell(1, 5, 'Jabatan               :'.$get_user->nama_jabatan.' '.$get_user->nama_bagian, 0, 1);
        $pdf->Cell(1, 5, 'Unit Organisasi : Kantor Kelurahan Desa Sidomulyo', 0, 1);
        $pdf->Cell(1, 7, '', 0, 1);
        $pdf->Cell(1, 7, 'UNSUR YANG DINILAI', 0, 1);

        #konfigurasi tabel
        $pdf->SetWidths(Array(8,30,80,20,15));
        $pdf->SetLineHeight(6);
        $pdf->SetAligns(Array('C','','','C','C'));

        #tabel
        $pdf->Cell(8, 7, 'No.', 1, 0, 'C');
        $pdf->Cell(30, 7, 'Kriteria', 1, 0, 'C');
        $pdf->Cell(80, 7, 'Deskripsi', 1, 0, 'C');
        $pdf->Cell(20, 7, 'Penilaian', 1, 0, 'C');
        $pdf->Cell(15, 7, 'Nilai', 1, 1, 'C');

        #isi tabel
        $i = 1;
        foreach ($get_nilai as $nilai) {
            $pdf->Row(Array(
                $i++,
                $nilai->nama_kriteria,
                $nilai->deskripsi,
                $nilai->nilai_awal,
                round($nilai->nilai_alternatif_kriteria,2),
            ));
        }
        $pdf->Cell(1, 5, '', 0, 1);
        $pdf->Cell(1, 7, 'URAIAN PENILAIAN', 0, 1);

        #konfigurasi tabel
        $pdf->SetWidths(Array(8,50,30,30));
        $pdf->SetLineHeight(6);
        $pdf->SetAligns(Array('C','','C','C'));

        #tabel nilai
        $pdf->Cell(8, 7, 'No.', 1, 0, 'C');
        $pdf->Cell(50, 7, 'Kriteria', 1, 0, 'C');
        $pdf->Cell(30, 7, 'Bobot', 1, 0, 'C');
        $pdf->Cell(30, 7, 'Nilai', 1, 1, 'C');

        $i = 1;
        foreach($get_nilai as $nilai2) {
            $pdf->Row(Array(
                $i++,
                $nilai2->nama_kriteria,
                round($nilai2->bobot_rerata,3),
                round($nilai2->bobot_alternatif_kriteria,2),
            ));
        }
        $pdf->Cell(58, 9, 'Hasil Hitung Metode SMART', 1, 0, 'C');
        $pdf->Cell(30, 9, '', 1, 0, 'C');
        $pdf->Cell(30, 9, $nilai->hasil_alternatif, 1, 1, 'C');

        $pdf->SetFont('Arial','B', 10);
        $pdf->Cell(1, 5, '', 0, 1);
    
        $pdf->Cell(100, 15, 'KEPUTUSAN :'.$nilai->ket_alternatif, 1, 1, 'C');


        $pdf->SetFont('Times','', 9);
        $pdf->Cell(1, 7, '', 0, 1);
        $pdf->Cell(110);
        $pdf->Cell(48, 7, 'Bantul ,'.tgl_new('d-m-Y '), 0, 1);

        $filename = 'Raport Pegawai-'.$get_user->full_name.'-'.bulan(date('m')).'-'.date('Y').'.pdf';
        $pdf->Output($filename,'D');

    }
}
