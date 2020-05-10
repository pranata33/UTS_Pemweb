<?php 
	include 'staff.php';
	$db = new Staff();

	$id = @$_GET['id'];

	if ($db->deleteStaff($id)) {
		header('location:../index.php?notif=del&nstat=berhasil');
	}else{
		header('location:../index.php?notif=del&nstat=gagal');
	}
 ?>