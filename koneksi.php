<?php
	$koneksi=mysqli_connect("localhost","root","","db_tugas_2");
	if(mysqli_connect_errno()){
		echo "<div class='alert alert-danger' role='alert'>  Koneksi database gagal </div>".mysqli_connect_error();
	}
?>