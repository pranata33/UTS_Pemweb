<?php 

	include 'database.php';

	class Peserta extends database{

		function show($search, $page){
			$offset = ($page == 1?'0':($page-1)*10);
			if ($search == '') {
				$data = mysqli_query($this->conn, "SELECT * FROM peserta ORDER BY id_peserta ASC LIMIT 10 OFFSET $offset");	
			}else{
				$data = mysqli_query($this->conn, "SELECT * FROM peserta WHERE nama_peserta LIKE '%".$search."%' ORDER BY id_peserta ASC");
			}

			

			while ($row = mysqli_fetch_array($data)) {
				$res[] = $row;
			}

			return $res;
		}

		function getPeserta($id){
			$data = mysqli_query($this->conn, "SELECT * FROM peserta WHERE id_peserta = $id");

			while ($row = mysqli_fetch_array($data)) {
				$res = $row;
			}

			return $res;
		}

		function addPeserta($nama_peserta, $instansi, $jk, $no_hp, $alamat){
			$ins = mysqli_query($this->conn, "INSERT INTO peserta VALUES(null, '$nama_peserta', '$instansi', '$jk', '$no_hp', '$alamat')");
			return $ins;
		}

		function updatePeserta($id_peserta, $nama_peserta, $instansi, $jk, $no_hp, $alamat){
			$ed = mysqli_query($this->conn, "UPDATE peserta SET nama = '$nama_peserta', instansi = '$instansi', jk = '$jk', no_hp = '$no_hp', alamat = '$alamat' WHERE id_peserta = $id");
			return $ed;
		}

		function deletePeserta($id){
			$del = mysqli_query($this->conn, "DELETE FROM peserta WHERE id_peserta = $id");
			return $del;
		}

		function count(){
			$data = mysqli_query($this->conn, "SELECT * FROM peserta");
			return mysqli_num_rows($data);
		}

	}

?>