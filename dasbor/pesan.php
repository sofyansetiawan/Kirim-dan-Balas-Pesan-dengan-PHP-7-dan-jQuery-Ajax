<?php 
session_start();
error_reporting(0);
include_once '../setting/database.php';
include_once '../setting/status_session.php';
$id_member = $_SESSION['id_member'];
?>

<!DOCTYPE html>
<html>
<head>
	<title>Pesan : Sofyan Setiawan</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<script type="text/javascript" src="../js/jquery-3.1.0.min.js"></script>
	<script type="text/javascript" src="../js/pesan.js"></script>
</head>
<body>
	<h1>Inbox Pesan</h1>
	<p><a href="index.php">&laquo; Home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" id="ke_kirim_pesan">Kirim Pesan</a></p>

	<div id="kirim_pesan">
	<form id="form_kirim_pesan" method="post">
		<input type="hidden" id="pengirim_kirim_pesan" name="pengirim_kirim_pesan" value="<?php echo $id_member; ?>">
		Penerima
		<br>
		<select id="penerima_kirim_pesan" name="penerima_kirim_pesan">
		<option value="0">- Pilih Penerima Pesan -</option>
		<?php 
			$query_penerima = mysqli_query($koneksi, "SELECT id_member, nama_lengkap FROM member WHERE id_member != $id_member");
			while ($daftar_penerima=mysqli_fetch_array($query_penerima)) {
		?>
			<option value="<?php echo $daftar_penerima['id_member']; ?>"><?php echo $daftar_penerima['nama_lengkap']; ?></option>
		<?php } ?>
		</select>
		<br>
		Subyek Pesan
		<br>
		<input type="text" id="subyek_kirim_pesan" name="subyek_kirim_pesan">
		<br>
		Isi Pesan
		<br>
		<textarea id="isi_kirim_pesan" name="isi_kirim_pesan" cols="30" rows="5"></textarea>
		<br><br>
		<input type="submit" name="submit_kirim_pesan" value="KIRIM PESAN">
		<br>
		<div id="loading_kirim_pesan">Mengirim Pesan...</div>
		<div id="keterangan"></div>
		</form>
	</div>

	<table width="600" class="tabel_pesan" cellpadding="5" cellspacing="0">
		<thead>
		<tr class="top_inbox">
			<th>
				Pengirim
			</th>
			<th>
				Subyek Pesan
			</th>
			<th>
				Tanggal
			</th>
		</tr>
		</thead>
		<tbody>
<?php
	$query_daftar_pesan = mysqli_query($koneksi, "SELECT P.*, M.id_member, M.nama_lengkap FROM pesan P, member M WHERE P.id_pengirim=M.id_member AND P.id_penerima='$id_member' ORDER BY P.id_pesan DESC");
	while ($daftar_pesan=mysqli_fetch_array($query_daftar_pesan)) {
		if($daftar_pesan['sudah_dibaca']=="belum"){
?>
		<tr class="pesan pesan_belum">
			<td>
				<?php echo $daftar_pesan['nama_lengkap']; ?>
			</td>
			<td>
				<a href="buka_pesan.php?id_member=<?php echo $id_member; ?>&id_pesan=<?php echo $daftar_pesan['id_pesan']; ?>"><?php echo $daftar_pesan['subyek_pesan']; ?></a>
			</td>
			<td>
				<?php echo $daftar_pesan['tanggal']; ?>
			</td>
		</tr>
<?php } 
		else if($daftar_pesan['sudah_dibaca']=="sudah"){
?>
		<tr class="pesan">
			<td>
				<?php echo $daftar_pesan['nama_lengkap']; ?>
			</td>
			<td>
				<a href="buka_pesan.php?id_member=<?php echo $id_member; ?>&id_pesan=<?php echo $daftar_pesan['id_pesan']; ?>"><?php echo $daftar_pesan['subyek_pesan']; ?></a>
			</td>
			<td>
				<?php echo $daftar_pesan['tanggal']; ?>
			</td>
		</tr>

<?php 
		} 
	}
?>

		</tbody>
	</table>
</body>
</html>