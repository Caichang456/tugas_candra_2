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
			$data=mysqli_query($koneksi,"SELECT * FROM tb_status ORDER BY id_status DESC");
			while ($d=mysqli_fetch_array($data)) { ?>
				<div class="card-body">
					<h5 class="card-header"><?php echo $d['nama']; echo " "; echo $d['tanggal']; ?></h5>
					<div class="card-body">
						<p class="card-text"><?php echo $d['status']; ?></p>
						<form method="POST">
							<input type="hidden" name="txt_id_status" value="<?php $d['id_status']; ?>">
							<input type="text" name="txt_nama_komentar" placeholder="Nama Komentar"><br>
							<textarea name="txt_isi_komentar" placeholder="Isi Komentar"></textarea><br>
							<input class="btn btn-primary" type="submit" name="simpan_komentar" value="Simpan Komentar">
						</form>
						<?php
							include "koneksi.php";
							$data2=mysqli_query($koneksi,"SELECT * FROM tb_komentar WHERE id_status='' ORDER BY id_komentar DESC");
							while ($d2=mysqli_fetch_array($data2)) { ?>
								<p class="card-text"><?php echo $d2['nama_komentar']; echo " "; echo $d2['tanggal_komentar']; echo " "; echo $d2['isi_komentar']; ?></p>
							<?php }
						?>
					</div>
				</div>
			<?php }
		?>
	</body>
</html>
<?php
	include "koneksi.php";
	if(isset($_POST['simpan_status'])){
		$nama=$_POST['txt_nama'];
		$status=$_POST['txt_status'];
		$tanggal=date("Y-m-d H:i:s");
		if($nama==""){
			echo "<div class='alert alert-danger' role='alert'>Nama tidak boleh kosong! </div>";
		}
		else if($status==""){
			echo "<div class='alert alert-danger' role='alert'>Status tidak boleh kosong! </div>";
		}
		else{
			mysqli_query($koneksi,"INSERT INTO tb_status(nama,status,tanggal) VALUES('$nama','$status','$tanggal')");
			header("location:index.php");
			echo "<div class='alert alert-success' role='alert'> Nama dan Status berhasil disimpan </div>";
		}
	}
	if(isset($_POST['simpan_komentar'])){
		$id_status=$_POST['txt_id_status'];
		$nama_komentar=$_POST['txt_nama_komentar'];
		$isi_komentar=$_POST['txt_isi_komentar'];
		$tanggal=date("Y-m-d H:i:s");
		if($nama_komentar==""){
			echo "<div class='alert alert-danger' role='alert'>Nama Komentar tidak boleh kosong! </div>";
		}
		else if($isi_komentar==""){
			echo "<div class='alert alert-danger' role='alert'>Isi Komentar tidak boleh kosong! </div>";
		}
		else{
			mysqli_query($koneksi,"INSERT INTO tb_status(id_status,nama_komentar,isi_komentar,tanggal) VALUES('$id_status','$nama_komentar','$isi_komentar','$tanggal')");
			header("location:index.php");
			echo "<div class='alert alert-success' role='alert'> Nama dan Status berhasil disimpan </div>";
		}
	}
?>