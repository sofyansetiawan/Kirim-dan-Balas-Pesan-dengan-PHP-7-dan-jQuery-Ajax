<?php
error_reporting(0);
include_once '../setting/database.php';

$pengirim_kirim_pesan    = $_POST['pengirim_kirim_pesan'];
$penerima_kirim_pesan     = $_POST['penerima_kirim_pesan'];
$subyek_kirim_pesan         = $_POST['subyek_kirim_pesan']; 
$isi_kirim_pesan      = $_POST['isi_kirim_pesan'];
$tanggal         		= date('Y-m-d'); 

if(empty($pengirim_kirim_pesan) || empty($subyek_kirim_pesan) || empty($isi_kirim_pesan)){
	die(pesan(0,"Semua Field Harus Di isi"));
}

if(!(int)$penerima_kirim_pesan){
	die(pesan(0,"Pilih Penerima Pesan"));
}
  $isi = mysqli_query($koneksi, "INSERT INTO pesan(id_pengirim, id_penerima, subyek_pesan, isi_pesan, tanggal, sudah_dibaca) VALUES('$pengirim_kirim_pesan','$penerima_kirim_pesan','$subyek_kirim_pesan','$isi_kirim_pesan','$tanggal', 'belum')");
  die(pesan(1,"Pesan sudah berhasil terkirim"));

function pesan($status,$teks) {
	return '{"status":'.$status.',"teks":"'.$teks.'"}';
}