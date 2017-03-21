$(document).ready(function() {
	$('#ke_kirim_pesan').click(function() {
		$('#kirim_pesan').slideToggle();
	});

	$('#ke_balas_pesan').click(function() {
		$('#balas_pesan').slideToggle();
	});

	$('#kirim_pesan').submit(function(e) {
		kirim_pesan();
		e.preventDefault();
	});

	$('#balas_pesan').submit(function(e) {
		balas_pesan();
		e.preventDefault();
	});
});

function kirim_pesan() {
	visible('loading_kirim_pesan',1);
	gagal(0);
	sukses(0);		
	$.ajax({
		type: "POST",
		url: "proses_kirim_pesan.php",
		data: $('#form_kirim_pesan').serialize(),
		dataType: "json",
		success: function(pesan) {
			if(parseInt(pesan.status)==1) {
			   sukses(1,pesan.teks);
			   $("#penerima_kirim_pesan").val('- Pilih Penerima Pesan -');
			   $("#subyek_kirim_pesan").val('');
			   $("#isi_kirim_pesan").val('');			
			}
			else if(parseInt(pesan.status)==0) {
				gagal(1,pesan.teks);
			}			
			visible('loading_kirim_pesan',0);			
	 	}
	});
}

function balas_pesan() {
	visible('loading_balas_pesan',1);
	gagal(0);
	sukses(0);		
	$.ajax({
		type: "POST",
		url: "proses_balas_pesan.php",
		data: $('#form_balas_pesan').serialize(),
		dataType: "json",
		success: function(pesan) {
			if(parseInt(pesan.status)==1) {
			   sukses(1,pesan.teks);
			   $("#penerima_kirim_pesan").val('- Pilih Penerima Pesan -');
			   $("#subyek_kirim_pesan").val('');
			   $("#isi_kirim_pesan").val('');			
			}
			else if(parseInt(pesan.status)==0) {
				gagal(1,pesan.teks);
			}			
			visible('loading_balas_pesan',0);			
	 	}
	});
}

function visible(seleksi,status) {
	if(status) $('#'+seleksi).css('visibility','visible');
	else $('#'+seleksi).css('visibility','hidden');
}

function gagal(status,teks) {
	visible('keterangan',status);
	if(teks) $('#keterangan').html(teks);
	$('#keterangan').removeClass('sukses').addClass('gagal');
}

function sukses(status,teks) {
	visible('keterangan',status);
	if(teks) $('#keterangan').html(teks);
	$('#keterangan').removeClass('gagal').addClass('sukses');
}