<?php 

	include 'database.php';

	class JenisPekerjaan extends database{

		function show($search, $page){
			$offset = ($page == 1?'0':($page-1)*10);
			if ($search == '') {
				$data = mysqli_query($this->conn, "SELECT * FROM jenispekerjaan ORDER BY id_jenispekerjaan ASC LIMIT 10 OFFSET $offset");	
			}else{
				$data = mysqli_query($this->conn, "SELECT * FROM jenispekerjaan WHERE jenis LIKE '%".$search."%' ORDER BY id_jenispekerjaan ASC");
			}

			

			while ($row = mysqli_fetch_array($data)) {
				$res[] = $row;
			}

			return $res;
		}

		function getJenisPekerjaan($id){
			$data = mysqli_query($this->conn, "SELECT * FROM jenispekerjaan WHERE id_jenispekerjaan = $id");

			while ($row = mysqli_fetch_array($data)) {
				$res = $row;
			}

			return $res;
		}

		function addJenisPekerjaan($jenis, $ket, $pekerjaan){
			$ins = mysqli_query($this->conn, "INSERT INTO jenispekerjaan VALUES(null,'$jenis', '$ket', '$pekerjaan')");
			return $ins;
		}

		function updateJenisPekerjaan($id, $jenis, $ket, $pekerjaan){
			$ed = mysqli_query($this->conn, "UPDATE jenispekerjaan SET jenis = '$jenis', ket = '$ket', pekerjaan = '$pekerjaan' WHERE id_jenispekerjaan = $id");
			return $ed;
		}

		function deleteJenisPekerjaan($id){
			$del = mysqli_query($this->conn, "DELETE FROM jenispekerjaan WHERE id_jenispekerjaan = $id");
			return $del;
		}

		function count(){
			$data = mysqli_query($this->conn, "SELECT * FROM jenispekerjaan");
			return mysqli_num_rows($data);
		}

	}

?>