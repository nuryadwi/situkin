/*
SQLyog Ultimate v10.42 
MySQL - 5.5.5-10.4.14-MariaDB : Database - db_sipentukin
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_sipentukin` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `db_sipentukin`;

/*Table structure for table `t_bagian` */

DROP TABLE IF EXISTS `t_bagian`;

CREATE TABLE `t_bagian` (
  `id_bagian` int(11) NOT NULL AUTO_INCREMENT,
  `id_jabatan` int(11) NOT NULL,
  `nama_bagian` varchar(50) NOT NULL,
  PRIMARY KEY (`id_bagian`),
  KEY `id_jabatan` (`id_jabatan`),
  CONSTRAINT `t_bagian_ibfk_1` FOREIGN KEY (`id_jabatan`) REFERENCES `t_jabatan` (`id_jabatan`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

/*Data for the table `t_bagian` */

insert  into `t_bagian`(`id_bagian`,`id_jabatan`,`nama_bagian`) values (4,2,'Pelayanan'),(5,2,'Pemerintahan'),(6,5,'Pemerintahan'),(7,2,'Kesejahteraan'),(8,2,'Keuangan'),(9,2,'Tata Usaha dan Umum'),(10,2,'Perencanaan'),(11,5,'Pelayanan'),(12,5,'Kesejahteraan'),(13,5,'Keuangan'),(14,5,'Tata Usaha dan Umum'),(15,5,'Perencanaan');

/*Table structure for table `t_hak_akses` */

DROP TABLE IF EXISTS `t_hak_akses`;

CREATE TABLE `t_hak_akses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_role` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_role` (`id_role`),
  KEY `id_menu` (`id_menu`),
  CONSTRAINT `t_hak_akses_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `t_role` (`id_role`),
  CONSTRAINT `t_hak_akses_ibfk_2` FOREIGN KEY (`id_menu`) REFERENCES `t_menu` (`id_menu`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

/*Data for the table `t_hak_akses` */

insert  into `t_hak_akses`(`id`,`id_role`,`id_menu`) values (1,1,1),(2,1,2),(3,1,31),(4,1,32),(5,1,40),(6,1,6),(7,1,7),(8,1,35),(9,2,1),(10,6,1),(11,6,48),(12,6,10),(13,6,39),(14,6,52),(15,6,53),(16,6,44),(17,6,50),(18,6,4),(19,6,54),(20,6,38),(21,6,35),(22,2,5),(23,2,49),(24,2,51),(25,2,35);

/*Table structure for table `t_jabatan` */

DROP TABLE IF EXISTS `t_jabatan`;

CREATE TABLE `t_jabatan` (
  `id_jabatan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jabatan` varchar(50) NOT NULL,
  PRIMARY KEY (`id_jabatan`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `t_jabatan` */

insert  into `t_jabatan`(`id_jabatan`,`nama_jabatan`) values (1,'Lurah'),(2,'Staff'),(5,'Ka.Sie'),(6,'Carik'),(8,'Pamong');

/*Table structure for table `t_menu` */

DROP TABLE IF EXISTS `t_menu`;

CREATE TABLE `t_menu` (
  `id_menu` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `url` varchar(50) NOT NULL,
  `icon` varchar(20) NOT NULL,
  `is_main_menu` int(11) NOT NULL DEFAULT 0,
  `is_aktif` enum('y','n') NOT NULL DEFAULT 'y',
  PRIMARY KEY (`id_menu`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;

/*Data for the table `t_menu` */

insert  into `t_menu`(`id_menu`,`title`,`url`,`icon`,`is_main_menu`,`is_aktif`) values (1,'Beranda','home','fa fa-home',0,'n'),(2,'Master Data','#','fa fa-archive',0,'y'),(4,'Data Penilaian','#','fa fa-edit',0,'y'),(5,'Buku Harian','#','fa fa-book',0,'y'),(6,'Kelola Pengguna','user','fa fa-user',0,'y'),(7,'Level Pengguna','userlevel','fa fa-unlock-alt',0,'y'),(8,'Pengaturan','#','fa fa-gear',0,'y'),(10,'Data Pegawai','pegawai','',48,'y'),(31,'Data Jabatan','jabatan','',2,'y'),(32,'Data Departemen','bagian','',2,'y'),(35,'Edit Profil','profil','fa fa-user',0,'y'),(38,'Penilaian','c_smart','',4,'y'),(39,'Kelola Data Alternatif','alternatif','',48,'y'),(40,'Kelola Menu','kelolamenu','',2,'y'),(44,'Data Tugas','#','fa fa-tasks',0,'y'),(48,'Master Data Penilaian','#','fa fa-desktop',0,'y'),(49,'Buku Pegawai','bukupegawai','',5,'y'),(50,'Laporan Tugas Pegawai','tugas','',44,'y'),(51,'Raport','c_raport','fa fa-file-text',0,'y'),(52,'Data Kriteria','c_kriteria','',48,'y'),(53,'Data Parameter','c_parameter','',48,'y'),(54,'Laporan Penilaian','smart_report','',4,'y'),(55,'test','test','fa fa-user',49,'y');

/*Table structure for table `t_role` */

DROP TABLE IF EXISTS `t_role`;

CREATE TABLE `t_role` (
  `id_role` int(11) NOT NULL AUTO_INCREMENT,
  `nama_role` varchar(50) NOT NULL,
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `t_role` */

insert  into `t_role`(`id_role`,`nama_role`) values (1,'Admin'),(2,'User'),(6,'Penilai');

/*Table structure for table `t_setting` */

DROP TABLE IF EXISTS `t_setting`;

CREATE TABLE `t_setting` (
  `id_setting` int(11) NOT NULL AUTO_INCREMENT,
  `nama_setting` varchar(50) NOT NULL,
  `value` varchar(5) NOT NULL,
  PRIMARY KEY (`id_setting`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `t_setting` */

insert  into `t_setting`(`id_setting`,`nama_setting`,`value`) values (1,'Tampil Menu','ya');

/*Table structure for table `t_tugas` */

DROP TABLE IF EXISTS `t_tugas`;

CREATE TABLE `t_tugas` (
  `id_tugas` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_bagian` int(11) NOT NULL,
  `tugas` varchar(100) DEFAULT NULL,
  `waktu_mulai` varchar(10) DEFAULT NULL,
  `waktu_selesai` varchar(10) DEFAULT NULL,
  `tanggal` varchar(20) NOT NULL,
  `pemberi_tugas` varchar(200) NOT NULL,
  `file_tambahan` varchar(250) DEFAULT NULL,
  `ket` text NOT NULL,
  `jml` int(1) DEFAULT NULL,
  `create_at` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_tugas`),
  KEY `id_user` (`id_user`),
  KEY `id_bagian` (`id_bagian`),
  CONSTRAINT `t_tugas_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `t_users` (`id_user`),
  CONSTRAINT `t_tugas_ibfk_2` FOREIGN KEY (`id_bagian`) REFERENCES `t_bagian` (`id_bagian`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `t_tugas` */

insert  into `t_tugas`(`id_tugas`,`id_user`,`id_bagian`,`tugas`,`waktu_mulai`,`waktu_selesai`,`tanggal`,`pemberi_tugas`,`file_tambahan`,`ket`,`jml`,`create_at`) values (1,54,4,'Penyuluhan KB di dusun selo','08:00','09:00','2020-09-07','Dinkes Bantul','Penyuluhan_KB_di_dusun_selo_541.docx','Penyuluhan program KB serentak Di desa',1,'2020-09-07'),(2,54,4,'Penyuluhan Air Bersih','08:30','11:00','2020-09-11','Pemda DIY','kosong','Penyuluhan untuk desa desa',1,'2020-09-11'),(3,58,5,'Rapat Kinerja di Pemda Bantul','10:00','12:00','2020-09-04','Pemda Bantul','kosong','Rapat Kinerja Pelayanan Desa',1,'2020-09-04'),(4,54,4,'Menghadiri senam sehat dusun Turi','06:00','08:00','2020-09-11','Dukuh Turi','kosong','Senam sehat bersama mendampingi Lurah',1,'2020-09-11'),(5,54,4,'Kumpulan Ibu Ibu PKK dusun selo','16:00','17:30','2020-09-10','PKK dusun Selo','kosong','Pelatihan Pembuatan Nugget',1,'2020-09-10'),(6,54,4,'Menghadiri acara Pagelaran wayang di dusun selo','20:00','22:00','2020-09-07','Dukuh Dusun Selo','kosong','Pagelaran wayang kulit di dusun selo mendampingi Lurah',0,'2020-09-07'),(9,58,5,'Apel pagi hari senin','07:30','08:00','2020-09-08','Lurah','kosong','Apel pagi membahas kedisiplinan dan etos kerja',1,'2020-09-08 ');

/*Table structure for table `t_users` */

DROP TABLE IF EXISTS `t_users`;

CREATE TABLE `t_users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `nip` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `id_role` int(11) NOT NULL,
  `id_bagian` int(11) DEFAULT NULL,
  `id_jabatan` int(11) DEFAULT NULL,
  `create_on` datetime DEFAULT NULL,
  `nik` int(25) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `images` varchar(200) DEFAULT NULL,
  `phone` varchar(13) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `full_name` varchar(200) DEFAULT NULL,
  `online` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  KEY `id_role` (`id_role`),
  KEY `id_bagian` (`id_bagian`),
  KEY `id_jabatan` (`id_jabatan`),
  CONSTRAINT `t_users_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `t_role` (`id_role`),
  CONSTRAINT `t_users_ibfk_2` FOREIGN KEY (`id_bagian`) REFERENCES `t_bagian` (`id_bagian`),
  CONSTRAINT `t_users_ibfk_3` FOREIGN KEY (`id_jabatan`) REFERENCES `t_jabatan` (`id_jabatan`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=latin1;

/*Data for the table `t_users` */

insert  into `t_users`(`id_user`,`username`,`password`,`nip`,`status`,`id_role`,`id_bagian`,`id_jabatan`,`create_on`,`nik`,`email`,`images`,`phone`,`gender`,`alamat`,`last_login`,`full_name`,`online`) values (1,'admin','$2y$04$2tmnLndJXW9nfGi0XVlrduCuiFd7APvdWUAW8MxiKFRXmef2aOJiy','admin',1,1,NULL,NULL,NULL,NULL,NULL,'user.png',NULL,NULL,NULL,'2020-10-05 14:33:09','admin',0),(2,'penilai','$2y$04$agThWgc.LwBRylR/X2dl9.0Vy/OaTEVsg..IMx6o2c9pQK6zuxNdm','penilai',1,6,NULL,NULL,'2019-09-02 14:13:35',NULL,NULL,'user.png',NULL,NULL,NULL,'2020-10-05 14:35:17','penilai',1),(54,'kuncoro','$2y$04$DN4mUWmFfPRKZqbRbp8NA.Q41YWHoVSk8ywV.QulTy76YjtPGe6p.','1300016056',1,2,4,2,'2019-09-16 14:12:59',2147483647,'anung21@gmail.com','541.jpg','087667553445','laki-Laki','Jl. Samas Km.21, Bambanglipuro','2019-10-08 09:31:07','Kuncoro Anung',0),(58,'sujiman','$2y$04$gkfFx4HOpmzckdglgFsNHeVIOFtr4Ab7JUFwoQKLe0vRl72iwFLD2','1300016058',1,2,5,2,'2019-09-18 12:54:32',2147483647,'sujiman@gmail.com','58.jpg','08566776655','laki-Laki','Jl. Kenari No.35, Yogyakarta','2020-09-15 01:16:58','Sujiman Kuntoto',1),(59,'wibowo','$2y$04$o43lauIx0awrjaabHMSWCudGf5QyHo6f9vU9gfeYvBosS6xYK2bQe','1234567',1,2,6,5,'2020-08-24 14:39:48',NULL,NULL,'user.png',NULL,NULL,NULL,NULL,'Wibowo',NULL);

/*Table structure for table `tbl_alternatif` */

DROP TABLE IF EXISTS `tbl_alternatif`;

CREATE TABLE `tbl_alternatif` (
  `id_alternatif` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_bagian` int(11) DEFAULT NULL,
  `hasil_alternatif` double DEFAULT NULL,
  `ket_alternatif` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_alternatif`),
  KEY `id_user` (`id_user`),
  KEY `id_bagian` (`id_bagian`),
  CONSTRAINT `tbl_alternatif_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `t_users` (`id_user`),
  CONSTRAINT `tbl_alternatif_ibfk_2` FOREIGN KEY (`id_bagian`) REFERENCES `t_bagian` (`id_bagian`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_alternatif` */

insert  into `tbl_alternatif`(`id_alternatif`,`id_user`,`id_bagian`,`hasil_alternatif`,`ket_alternatif`) values (2,58,5,72,'Mendapat Tunjangan'),(3,54,4,57.62,'Tidak Mendapat Tunjangan'),(4,59,6,NULL,'Tidak Mendapat Tunjangan');

/*Table structure for table `tbl_alternatif_kriteria` */

DROP TABLE IF EXISTS `tbl_alternatif_kriteria`;

CREATE TABLE `tbl_alternatif_kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `id_alternatif` int(11) NOT NULL,
  `nilai_alternatif_kriteria` double DEFAULT NULL,
  `bobot_alternatif_kriteria` double DEFAULT NULL,
  KEY `id_kriteria` (`id_kriteria`),
  KEY `id_alternatif` (`id_alternatif`),
  CONSTRAINT `tbl_alternatif_kriteria_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `tbl_kriteria` (`id_kriteria`),
  CONSTRAINT `tbl_alternatif_kriteria_ibfk_2` FOREIGN KEY (`id_alternatif`) REFERENCES `tbl_alternatif` (`id_alternatif`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_alternatif_kriteria` */

insert  into `tbl_alternatif_kriteria`(`id_kriteria`,`id_alternatif`,`nilai_alternatif_kriteria`,`bobot_alternatif_kriteria`) values (46,2,75,15.180288461538),(47,2,85,15.324519230769),(48,2,85,13.444711538462),(49,2,80,10.884615384615),(50,2,60,6.8365384615386),(51,2,80,7.3461538461538),(52,2,20,1.3942307692308),(53,2,33.333333333333,1.5865384615385),(46,3,0,0),(47,3,50,9.014423076923),(48,3,50,7.908653846154),(49,3,61.666666666667,8.3902243589742),(50,3,100,11.394230769231),(51,3,100,9.1826923076923),(52,3,100,6.9711538461538),(53,3,100,4.7596153846154);

/*Table structure for table `tbl_bobot1` */

DROP TABLE IF EXISTS `tbl_bobot1`;

CREATE TABLE `tbl_bobot1` (
  `id_kriteria` int(11) NOT NULL,
  `bobot1` varchar(50) NOT NULL,
  `norm1` double DEFAULT NULL,
  PRIMARY KEY (`id_kriteria`),
  CONSTRAINT `tbl_bobot1_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `tbl_kriteria` (`id_kriteria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_bobot1` */

insert  into `tbl_bobot1`(`id_kriteria`,`bobot1`,`norm1`) values (46,'100',0.19230769230769),(47,'90',0.17307692307692),(48,'80',0.15384615384615),(49,'70',0.13461538461538),(50,'60',0.11538461538462),(51,'50',0.096153846153846),(52,'40',0.076923076923077),(53,'30',0.057692307692308);

/*Table structure for table `tbl_bobot2` */

DROP TABLE IF EXISTS `tbl_bobot2`;

CREATE TABLE `tbl_bobot2` (
  `id_kriteria` int(11) NOT NULL,
  `bobot2` varchar(50) NOT NULL,
  `norm2` double DEFAULT NULL,
  PRIMARY KEY (`id_kriteria`),
  CONSTRAINT `tbl_bobot2_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `tbl_kriteria` (`id_kriteria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_bobot2` */

insert  into `tbl_bobot2`(`id_kriteria`,`bobot2`,`norm2`) values (46,'85',0.2125),(47,'75',0.1875),(48,'65',0.1625),(49,'55',0.1375),(50,'45',0.1125),(51,'35',0.0875),(52,'25',0.0625),(53,'15',0.0375);

/*Table structure for table `tbl_kriteria` */

DROP TABLE IF EXISTS `tbl_kriteria`;

CREATE TABLE `tbl_kriteria` (
  `id_kriteria` int(11) NOT NULL AUTO_INCREMENT,
  `kriteria` varchar(100) NOT NULL,
  `nama_kriteria` varchar(100) DEFAULT NULL,
  `bobot_rerata` double DEFAULT NULL,
  `deskripsi` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_kriteria`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_kriteria` */

insert  into `tbl_kriteria`(`id_kriteria`,`kriteria`,`nama_kriteria`,`bobot_rerata`,`deskripsi`) values (46,'K1','Pelanggaran',0.20240384615384,'Jumlah pelanggaran kinerja selama satu bulan'),(47,'k2','Kehadiran',0.18028846153846,'Jumlah Ketidakhadiran/absen selama satu bulan'),(48,'k3','Nilai SKI',0.15817307692308,'Nilai Sasaran Kinerja Individu Pegawai yang di dapatkan'),(49,'K4','Nilai Perilaku Kerja',0.13605769230769,'Nilai Perilaku Kerja Pegawai yang di dapat'),(50,'K5','Tugas Harian Pegawai',0.11394230769231,'Jumlah tugas tambahan yang dikirimkan pegawai dalam satu bulan ini'),(51,'K6','Pelayanan Masyarakat',0.091826923076923,'Nilai Sikap atau perilaku pegawai dalam memberikan pelayanani'),(52,'K7','Lembur',0.069711538461538,'Jumlah lemburan pegawai'),(53,'K8','Penghargaan',0.047596153846154,'Jumlah Penghargaan yang di terima oleh pegawai dalam satu bulan');

/*Table structure for table `tbl_nilai` */

DROP TABLE IF EXISTS `tbl_nilai`;

CREATE TABLE `tbl_nilai` (
  `id_kriteria` int(11) NOT NULL,
  `id_alternatif` int(11) NOT NULL,
  `nilai_awal` double DEFAULT NULL,
  KEY `id_alternatif` (`id_alternatif`),
  KEY `id_kriteria` (`id_kriteria`),
  CONSTRAINT `tbl_nilai_ibfk_1` FOREIGN KEY (`id_alternatif`) REFERENCES `tbl_alternatif` (`id_alternatif`),
  CONSTRAINT `tbl_nilai_ibfk_2` FOREIGN KEY (`id_kriteria`) REFERENCES `tbl_kriteria` (`id_kriteria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_nilai` */

insert  into `tbl_nilai`(`id_kriteria`,`id_alternatif`,`nilai_awal`) values (46,2,1),(47,2,3),(48,2,91),(49,2,88),(50,2,6),(51,2,88),(52,2,1),(53,2,1),(46,3,4),(47,3,10),(48,3,70),(49,3,77),(50,3,10),(51,3,100),(52,3,5),(53,3,3);

/*Table structure for table `tbl_parameter` */

DROP TABLE IF EXISTS `tbl_parameter`;

CREATE TABLE `tbl_parameter` (
  `id_kriteria` int(11) NOT NULL,
  `min` double DEFAULT NULL,
  `maks` double DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_kriteria`),
  CONSTRAINT `tbl_parameter_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `tbl_kriteria` (`id_kriteria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_parameter` */

insert  into `tbl_parameter`(`id_kriteria`,`min`,`maks`,`type`) values (46,0,4,'2'),(47,0,20,'2'),(48,40,100,'1'),(49,40,100,'1'),(50,0,10,'1'),(51,40,100,'1'),(52,0,5,'1'),(53,0,3,'1');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
