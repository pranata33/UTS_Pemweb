<?php 
	include 'staff.php';
	$db = new Staff();

	$username = @$_POST['username'];
	$pass = @$_POST['pass'];
	$nama = @$_POST['nama'];
	$jk = @$_POST['jk'];
	$level = @$_POST['level'];
	$alamat = @$_POST['alamat'];
	$no_hp = @$_POST['no_hp'];

	if ($db->addStaff($username, $pass, $nama, $jk, $level, $alamat, $no_hp)) {
		header('location:../index.php?notif=add&nstat=berhasil');
	}else{
		header('location:../index.php?notif=add&nstat=gagal');
	}
 ?>