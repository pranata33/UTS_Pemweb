<?php 

	include 'database.php';

	class Staff extends database{

		function show($search, $page){
			$offset = ($page == 1?'0':($page-1)*10);
			if ($search == '') {
				$data = mysqli_query($this->conn, "SELECT * FROM staff ORDER BY id_staff ASC LIMIT 10 OFFSET $offset");	
			}else{
				$data = mysqli_query($this->conn, "SELECT * FROM staff WHERE nama LIKE '%".$search."%' ORDER BY id_staff ASC");
			}

			

			while ($row = mysqli_fetch_array($data)) {
				$res[] = $row;
			}

			return $res;
		}

		function getStaff($id){
			$data = mysqli_query($this->conn, "SELECT * FROM staff WHERE id_staff = $id");

			while ($row = mysqli_fetch_array($data)) {
				$res = $row;
			}

			return $res;
		}

		function addStaff($username, $pass, $nama, $jk, $level, $alamat, $no_hp){
			$ins = mysqli_query($this->conn, "INSERT INTO staff VALUES(null, '$username', '$pass', '$nama', '$jk', '$level', '$alamat', '$no_hp')");
			return $ins;
		}

		function updateStaff($id, $username, $pass, $nama, $jk, $level, $alamat, $no_hp){
			$ed = mysqli_query($this->conn, "UPDATE staff SET username = '$username', pass = '$pass', nama = '$nama', jk = '$jk', level = '$level', alamat = '$alamat', no_hp = '$no_hp' WHERE id_staff = $id");
			return $ed;
		}

		function deleteStaff($id){
			$del = mysqli_query($this->conn, "DELETE FROM staff WHERE id_staff = $id");
			return $del;
		}

		function count(){
			$data = mysqli_query($this->conn, "SELECT * FROM staff");
			return mysqli_num_rows($data);
		}

	}

?>