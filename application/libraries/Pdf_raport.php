<?php
//call main fpdf file
require_once(APPPATH.'third_party/fpdf/fpdf.php');
require_once(APPPATH.'libraries/Pdf_mc_table.php');
//create new class extending fpdf class
class PDF_Raport extends PDF_MC_Table {

	function Header(){
		$ci = get_instance();
		//Logo
		$this->Image('./assets/img_app/logo_instansi.png',30,10,18);
		//Arial bold 15
		$this->SetFont('Arial','B', 12);
		//pindah ke posisi ke tengah untuk membuat judul
		
		//judul
		$this->Cell(55);
		$this->cell(55, 7,'Penilaian Prestasi Kinerja',0,1,'C');
		$this->Cell(37);
		$this->cell(90, 6,'Pegawai Kantor Kelurahan Desa Sidomulyo',0,1,'C');
		$this->Cell(37);
		$this->SetFont('Arial','', 6);
		$this->cell(90, 3,'Alamat: Kantor Desa Sidomulyo Plebengan, Sidomulyo, Bambanglipuro, Bantul, Yogyakarta.',0,1,'C');
		$this->Cell(53);
		$this->cell(60, 3,'Telp.: 0811-2651-333 E-mail: desa.sidomulyo@bantulkab.go.id',0,1,'C');
		$this->SetFont('Arial','', 7);
		$this->Cell(1, 10, 'Tanggal cetak : '.tgl_new('d-m-Y'), 0, 0,'J');
		//pindah baris
		$this->Ln(10);
		//buat garis horisontal
		$this->Line(30,30,185,30);
		$this->Line(30,30.7,185,30.7);
		
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
		$this->Line(30,$this->GetY(),185,$this->GetY());
		//Arial italic 9
		$this->SetFont('Arial','I',9);
		//nomor halaman
		$this->Cell(0,10,'Halaman '.$this->PageNo().' dari {nb}',0,0,'R');
	}
}
?>