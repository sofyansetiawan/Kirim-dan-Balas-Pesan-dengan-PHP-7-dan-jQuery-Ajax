<?php
error_reporting(0);
include_once '../setting/database.php';

$pengirim_balas_pesan    = $_POST['pengirim_balas_pesan'];
$penerima_balas_pesan     = $_POST['penerima_balas_pesan'];
$subyek_balas_pesan         = $_POST['subyek_balas_pesan']; 
$isi_balas_pesan      = $_POST['isi_balas_pesan'];
$tanggal         		= date('Y-m-d'); 

if(empty($pengirim_balas_pesan) || empty($subyek_balas_pesan) || empty($isi_balas_pesan)){
	die(pesan(0,"Semua Field Harus Di isi"));
}

if(!(int)$penerima_balas_pesan){
	die(pesan(0,"Pilih Penerima Pesan"));
}
  $isi = mysqli_query($koneksi, "INSERT INTO pesan(id_pengirim, id_penerima, subyek_pesan, isi_pesan, tanggal, sudah_dibaca) VALUES('$pengirim_balas_pesan','$penerima_balas_pesan','Re: $subyek_balas_pesan','$isi_balas_pesan','$tanggal', 'belum')");
  die(pesan(1,"Pesan sudah berhasil terbalas"));

function pesan($status,$teks) {
	return '{"status":'.$status.',"teks":"'.$teks.'"}';
}