<!DOCTYPE html>
<html>

<head>
	<title>Latihan Facebook</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<script type="text/javascript" src="js/bootstrap.js"></script>
</head>

<body>
	<div class="card">
		<div class="card-body">
			<h5 class="card-title">Latihan Facebook</h5>
			<form method="POST">
				<input type="text" name="txt_nama" placeholder="Nama"><br>
				<textarea name="txt_status" placeholder="Status"></textarea><br>
				<input class="btn btn-primary" type="submit" name="simpan_status" value="Simpan Status">
			</form>
		</div>
	</div>
	<?php
	include "koneksi.php";
	$tampilSemuaStatus = mysqli_query($koneksi, "SELECT * FROM tb_status ORDER BY id_status DESC");
	$dataStatus = [];
	$idStatusArray = [];
	$namaStatusArray = [];
	$tanggalStatusArray = [];
	while ($statusArray = mysqli_fetch_array($tampilSemuaStatus)) {
		$dataStatus[]=$statusArray;
		$idStatusArray[] = $statusArray['id_status'];
		$namaStatusArray[] = $statusArray['nama'];
		$isiStatusArray[] = $statusArray['status'];
		$tanggalStatusArray[] = $statusArray['tanggal'];
	}
	$idStatusTeks = implode(",", $idStatusArray);
	$tampilSemuaKomentar = mysqli_query($koneksi, "SELECT * FROM tb_komentar WHERE id_status IN ($idStatusTeks)");
	$dataKomentar = [];
	$n = [];
	while ($komentarArray = mysqli_fetch_array($tampilSemuaKomentar)) {
		$dataKomentar[$komentarArray['id_status']] = $komentarArray;
		$n[] = $komentarArray['id_komentar'];
		//print_r($komentar);
	}
	print_r($dataKomentar);
	//die();
	?>
	<?php
		foreach($dataStatus as $statuses){ ?>
			<div class="card-body">
				<h5 class="card-header"><?php echo $statuses['nama'] . " " . $statuses['tanggal']; ?></h5>
				<div class="card-body">
					<p class="card-text"><?php echo $statuses['status']; ?></p>
					<form method="POST">
						<input type="hidden" name="txt_id_status" value="<?php echo $statuses['id_status']; ?>">
						<input type="text" name="txt_nama_komentar" placeholder="Nama Komentar"><br>
						<textarea name="txt_isi_komentar" placeholder="Isi Komentar"></textarea><br>
						<input class="btn btn-primary" type="submit" name="simpan_komentar" value="Simpan Komentar">
					</form>
					<?php
						foreach($dataKomentar as $indeks => $komentars){
							if($indeks==$statuses['id_status']){ ?>
								<p class="card-text"><?php echo $komentars['nama_komentar']." ".$komentars['tanggal_komentar']." ".$komentars['isi_komentar']; ?></p>
							<?php }
						}
					?>
				</div>
			</div>
		<?php }
	?>
</body>

</html>
<?php
if (isset($_POST['simpan_status'])) {
	$nama = $_POST['txt_nama'];
	$status = $_POST['txt_status'];
	$tanggal=date("Y-m-d H:i:s");
	if ($nama == "") {
		echo "<div class='alert alert-danger' role='alert'>Nama tidak boleh kosong! </div>";
	} else if ($status == "") {
		echo "<div class='alert alert-danger' role='alert'>Status tidak boleh kosong! </div>";
	} else {
		mysqli_query($koneksi, "INSERT INTO tb_status(nama,status) VALUES('$nama','$status')");
		header("location:index.php");
	}
}
if (isset($_POST['simpan_komentar'])) {
	$id_status = $_POST['txt_id_status'];
	$nama_komentar = $_POST['txt_nama_komentar'];
	$isi_komentar = $_POST['txt_isi_komentar'];
	$tanggal=date("Y-m-d H:i:s");
	if ($nama_komentar == "") {
		echo "<div class='alert alert-danger' role='alert'>Nama Komentar tidak boleh kosong! </div>";
	} else if ($isi_komentar == "") {
		echo "<div class='alert alert-danger' role='alert'>Isi Komentar tidak boleh kosong! </div>";
	} else {
		mysqli_query($koneksi, "INSERT INTO tb_komentar(id_status,nama_komentar,isi_komentar) VALUES('$id_status','$nama_komentar','$isi_komentar')");
		header("location:index.php");
	}
}
?>