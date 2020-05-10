<?php 
	class database{

		function __construct(){
			$this->conn = mysqli_connect('localhost','root','','db_rmib');

			if (mysqli_connect_errno()) {
				echo "Koneksi Gagal <br>".mysqli_connect_error();
			}
		}
	}
 ?>