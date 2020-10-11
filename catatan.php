<?php
//-- konfigurasi database 
$dbhost = 'localhost'; 
$dbuser = 'root'; 
$dbpass = ''; 
$dbname = 'db_dss'; 
//-- koneksi ke database server dengan extension mysqli 
$db = new mysqli($dbhost,$dbuser,$dbpass,$dbname); 
//-- hentikan program dan tampilkan pesan kesalahan jika koneksi gagal 
if ($db->connect_error) { 
    die('Connect Error ('.$db->connect_errno.')'.$db->connect_error); 
} 


//-- query untuk mendapatkan semua data kriteria di tabel smt_kriteria 
$sql = 'SELECT * FROM smt_kriteria'; 
$result = $db->query($sql); 
//-- menyiapkan variable penampung berupa array 
$kriteria=array(); 
//-- melakukan iterasi pengisian array untuk tiap record data yang didapat 
while ($row = $result->fetch_assoc()) { 
    $kriteria[$row['id_kriteria']]=array($row['kriteria'],$row['bobot'],$row['tipe']); 
} 


//-- query untuk mendapatkan semua data kriteria di tabel smt_alternatif 
$sql = 'SELECT * FROM smt_alternatif'; 
$result = $db->query($sql); 
//-- menyiapkan variable penampung berupa array 
$alternatif=array(); 
//-- melakukan iterasi pengisian array untuk tiap record data yang didapat 
while($row=$result->fetch_assoc()) { 
    $alternatif[$row['id_alternatif']]=$row['alternatif']; 
} 
?>;<?php 
//-- query untuk mendapatkan semua data sample penilaian di tabel smt_data 
$sql = 'SELECT * FROM smt_data ORDER BY id_alternatif,id_kriteria'; 
$result = $db->query($sql); 
//-- menyiapkan variable penampung berupa array 
$sample=array(); 
//-- melakukan iterasi pengisian array untuk tiap record data yang didapat 
while($row=result->fetch_assoc()) { 
    //-- jika array $sample[$row['id_alternatif']] belum ada maka buat baru 
    //-- $row['id_alternatif'] adalah id kandidat/alternatif 
    if (!isset($sample[$row['id_alternatif']])) { 
        $sample[$row['id_alternatif']] = array(); 
    } 
    $sample[$row['id_alternatif']][$row['id_kriteria']] = $row['nilai']; 
} 


//-- inisialisasi variabel array bobot 
$bobot=array(); 
foreach($kriteria as $k=>$vk){ 
    $bobot[$k]=$vk[1]; 
} 
//-- menghitung nilai total bobot 
$jml_bobot=array_sum($bobot); 
//-- inisialisasi variabel array w (bobot ternormalisasi) 
$w=array(); 
//-- normalisasi bobot 
foreach($bobot as $k=>$b){ 
    $w[$k]=$b/$jml_bobot; 
} 


//-- inisialisasi variabel array tranpose_d untuk menyimpan data tranpose dari data sample 
$tranpose_d=array(); 
foreach($alternatif as $a=>$v){ 
    foreach($kriteria as $k=>$v_k){ 
        if(!isset($tranpose_d[$k]))$tranpose_d[$k]=array(); 
        $tranpose_d[$k][$a]=$sample[$a][$k]; 
    } 
} 
//-- inisialisasi variabel array c_max dan c_min  
$c_max=array(); 
$c_min=array(); 
//-- mencari nilai max dan min utk tiap-tiap kriteria 
foreach($kriteria as $k=>$v){ 
    $c_max[$k]=max($tranpose_d[$k]); 
    $c_min[$k]=min($tranpose_d[$k]); 
} 
//-- inisialisasi variabel array U 
$U=array(); 
//-- menghitung nilai utility utk masing-masing alternatif dan kriteria 
// menggunakan rumus ui(ai) = (cout-cmin)/(cmax-cmin) benefit kriteria
foreach($kriteria as $k=>$v){ 
    foreach($alternatif as $a=>$a_v){ 
        if(!isset($U[$a])) $U[$a]=array(); 
        if($kriteria[$k]['tipe']=='max'){ 
            //-- perhitungan nilai utility untuk benefit criteria 
            $U[$a][$k]=($sample[$a][$k]-$c_min[$k])/($c_max[$k]-$c_min[$k]); 
        }else{ 
            //-- perhitungan nilai utility untuk cost criteria 
            $U[$a][$k]=($c_max[$k]-$sample[$a][$k])/($c_max[$k]-$c_min[$k]); 
        } 
    } 
} 


//-- inisialisasi variabel array V 
$V=array(); 
//-- melakukan iterasi utk setiap alternatif  
foreach($U as $a=>$a_u){ 
    $V[$a]=0; 
    //-- perhitungan nilai Preferensi V untuk tiap-tiap kriteria 
    foreach($a_u as $k=>$u){ 
        $V[$a]+=$u*$w[$k]; //nilai utility*bobot_normalisasi
        //$V[$a] +    = $u*bbt;
    } 
} 


//--mengurutkan data secara descending dengan tetap mempertahankan key/index array-nya  
arsort($V);  
//-- mendapatkan key/index item array yang pertama  
$index=key($V);  
//-- menampilkan hasil akhir:  
echo "Hasilnya adalah alternatif <b>{$alternatif[$index]}</b> ";  
echo "dengan nilai akhir <b>{$V[$index]}</b> yang terpilih";  
?>