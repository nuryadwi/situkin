<?php
//call main fpdf file
require_once(APPPATH.'third_party/fpdf/fpdf.php');
require_once(APPPATH.'libraries/Pdf_mc_table.php');
//require('/libraries/pdf_mc_table.php');
//create new class extending fpdf class
class PDF_Tugas extends PDF_MC_Table {


	function Header(){
		$ci = get_instance();
		//$get = konfigurasi('');
		//$logo = $get['logo'];
		//Logo
		$this->Image('./assets/img_app/logo_instansi.png',40,5,30);
		//Arial bold 15
		$this->SetFont('Arial','B', 14);
		//pindah ke posisi ke tengah untuk membuat judul
		
		//judul
		$this->Cell(90);
		$this->cell(60, 7,'Laporan Tugas Pegawai',0,1,'C');
		$this->Cell(77);
		$this->cell(85, 6,'Kantor Kelurahan Desa Sidomulyo',0,1,'C');
		$this->Cell(45);
		$this->SetFont('Arial','', 6);
		$this->cell(150, 3,'Alamat: Kantor Desa Sidomulyo Plebengan, Sidomulyo, Bambanglipuro, Bantul, Yogyakarta. Telp.: 0811-2651-333 E-mail: desa.sidomulyo@bantulkab.go.id ',0,1,'C');
		//pindah baris
		$this->Ln(10);
		//buat garis horisontal
		$this->Line(30,30,272,30);
		$this->Line(30,30.7,272,30.7);
		
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
		$this->Line(30,$this->GetY(),272,$this->GetY());
		//Arial italic 9
		$this->SetFont('Arial','I',9);
		//nomor halaman
		$this->Cell(0,10,'Halaman '.$this->PageNo().' dari {nb}',0,0,'R');
	}
}
?>