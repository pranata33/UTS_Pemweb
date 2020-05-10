<?php 

	include 'database.php';

	class Instansi extends database{

		function __construct(){
			$this->conn = mysqli_connect('localhost','root','','db_rmib');

			if (mysqli_connect_errno()) {
				echo "Koneksi Gagal <br>".mysqli_connect_error();
			}
		}

		function show($search, $page){
			$offset = ($page == 1?'0':($page-1)*10);
			if ($search == '') {
				$data = mysqli_query($this->conn, "SELECT * FROM instansi ORDER BY id_instansi ASC LIMIT 10 OFFSET $offset");	
			}else{
				$data = mysqli_query($this->conn, "SELECT * FROM instansi WHERE nama_instansi LIKE '%".$search."%' ORDER BY id_instansi ASC");
			}

			

			while ($row = mysqli_fetch_array($data)) {
				$res[] = $row;
			}

			return $res;
		}

		function getInstansi($id){
			$data = mysqli_query($this->conn, "SELECT * FROM instansi WHERE id_instansi = $id");

			while ($row = mysqli_fetch_array($data)) {
				$res = $row;
			}

			return $res;
		}

		function addInstansi($nama_instansi, $no_hp, $alamat){
			$ins = mysqli_query($this->conn, "INSERT INTO instansi VALUES(null, '$nama_instansi', '$no_hp', '$alamat')");
			return $ins;
		}

		function updateInstansi($id_instansi, $nama_instansi, $no_hp, $alamat){
			$ed = mysqli_query($this->conn, "UPDATE instansi SET nama = '$nama_instansi', no_hp = '$no_hp', alamat = '$alamat' WHERE id_instansi = $id");
			return $ed;
		}

		function deleteInstansi($id){
			$del = mysqli_query($this->conn, "DELETE FROM instansi WHERE id_instansi = $id");
			return $del;
		}

		function count(){
			$data = mysqli_query($this->conn, "SELECT * FROM instansi");
			return mysqli_num_rows($data);
		}

	}

?>