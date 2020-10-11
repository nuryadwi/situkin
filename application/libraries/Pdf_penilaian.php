<?php
//call main fpdf file
require_once(APPPATH.'third_party/fpdf/fpdf.php');
require_once(APPPATH.'libraries/Pdf_mc_table.php');
//create new class extending fpdf class
class PDF_Penilaian extends PDF_MC_Table {

	function Header(){
		$ci = get_instance();
		//Logo
		$this->Image('./assets/img_app/logo_instansi.png',50,10,30);
		//Arial bold 15
		$this->SetFont('Arial','B', 14);
		//pindah ke posisi ke tengah untuk membuat judul
		$this->Cell(65);
		//judul
		$this->cell(130, 6,'Laporan Penilaian Kinerja Bulan '.bulan(date('m')).' Tahun '.date('Y'),0,1,'C');
		$this->Cell(76);
		$this->cell(105, 6,'Pegawai Kantor Kelurahan Desa Sidomulyo',0,1,'C');
		$this->Cell(55);
		$this->SetFont('Arial','', 6);
		$this->cell(150, 3,'Alamat: Kantor Desa Sidomulyo Plebengan, Sidomulyo, Bambanglipuro, Bantul, Yogyakarta. Telp.: 0811-2651-333 E-mail: desa.sidomulyo@bantulkab.go.id ',0,1,'C');
		$this->SetFont('Arial','', 7);
		//$this->Cell(15);
		$this->Cell(1, 10, 'Tanggal cetak : '.tgl_new('d-m-Y'), 0, 0,'J');
		//pindah baris
		$this->Ln(10);
		//buat garis horisontal
		$this->Line(30,35,270,35);
		$this->Line(30,35.7,270,35.7);
		
	}

	function Content()
	{
		$this->SetFont('Times','',10);
		
	}

	function Footer()
	{
		//atur posisi 1.5 cm dari bawah
		$this->SetY(-15);
		//buat garis horizontal
		$this->Line(30,$this->GetY(),270,$this->GetY());
		//Arial italic 9
		$this->SetFont('Arial','I',9);
		//nomor halaman
		$this->Cell(0,10,'Halaman '.$this->PageNo().' dari {nb}',0,0,'R');
	}
}
?>