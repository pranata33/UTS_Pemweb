<?php 
	include 'lib/staff.php';
	$db = new staff();
	$search = (isset($_GET['search'])?$_GET['search']:'');
	$page = (isset($_GET['page'])?$_GET['page']:1);

	$staff = $db->show($search, $page);
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Tes RMIB</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div class="container-fluid">
	<div class="row bg-info">
		<div class="col-md-8 offset-md-2 col-12 header">
			</i> Data Staff</h1>
		</div>
	</div>
	<div class="row main">
		<?php 
			if (isset($_GET['edit'])) {
				$id = $_GET['edit'];
				$edit = $db->getStaff($id);
		?>
		<div class="col-md-8 offset-md-2 col-12">
			<form class="card mb-4" method="post" action="lib/edit.php?id=<?= $edit['id_staff'] ?>">
				<div class="card-body">
					<h2 class="card-title">Edit Data</h2>
					<hr>
					<label>Username</label>
					<input type="text" name="username" class="form-control" placeholder="Username" value="<?= $edit['username'] ?>"><br>
					<label>Password</label>
			        <input type="password" name="pass" class="form-control" placeholder="******" value="<?= $edit['password'] ?>"><br>
			        <label>Nama Staff</label>
			        <input type="text" name="nama" class="form-control" placeholder="Nama" value="<?= $edit['nama'] ?>"><br>
			        <label>Jenis Kelamin</label>
			        <select class="form-control" name="jk">
			        	<option value="l" <?= ($edit['jk']=='l'?'selected':'') ?>>Laki-laki</option>
			        	<option value="p" <?= ($edit['jk']=='p'?'selected':'') ?>>Perempuan</option>
			        </select><br>
			        <label>Jabatan</label>
			        <select class="form-control" name="level">
			        	<option value="1" <?= ($edit['level']=='1'?'selected':'') ?>>Ketua</option>
			        	<option value="2" <?= ($edit['level']=='2'?'selected':'') ?>>Staff</option>
			        </select><br>
			        <label>Alamat</label>
			        <input type="text" name="alamat" class="form-control" placeholder="Alamat" value="<?= $edit['alamat'] ?>"><br>
			        <label>No.Hp</label>
			        <input type="text" name="no_hp" class="form-control" placeholder="No.Hp" value="<?= $edit['no_hp'] ?>"><br>
			        <hr>
			        <div class="text-right">
			        	<a href="index.php" class="btn btn-outline-dark">Batal</a>
			        	<button type="submit" class="btn btn-warning">Simpan</button>
			        </div>
				</div>
			</form>
		</div>
		<?php } ?>

		<div class="col-md-4 offset-md-2 col-12">
			<a href="#" class="btn btn-outline-info" data-toggle="modal" data-target="#add"><i class="fa fa-plus-circle"></i> Tambah Data Staff</a>
		</div>
		<div class="col-md-4 text-right col-12">
			<form method="get" action="index.php">
				<div class="input-group">
				  <input type="text" name="search" class="form-control" placeholder="Cari Nama Staff">
				  <div class="input-group-append">
				    <button type="submit" class="btn btn-info" type="button" id="button-addon2"><i class="fa fa-search"></i> Cari</button>
				  </div>
				</div>
			</form>
		</div>
		<div class="col-md-8 offset-md-2 col-12">
			<?php 
				if (isset($_GET['notif'])) {
				$notif;
				$n_class = ($_GET['nstat']=="berhasil"?"success":"danger");
				switch ($_GET['notif']) {
					case 'add':
						$notif = "menambah";
						break;
					case 'del':
						$notif = "menghapus";
						break;
					case 'ed':
						$notif = "mengedit";
						break;
				}
			?>
			<div class="alert alert-<?= $n_class ?> alert-dismissible fade show mt-4" role="alert">
			  <strong><?php echo $_GET['nstat']." ".$notif." data." ?></strong>
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
			</div>
			<?php } ?>

			<hr>
			<div class="table-responsive">
				<table class="table table-striped text-center">
					<thead class="bg-dark">
						<tr>
							<th>No.</th>
							<th>Username</th>
							<th>Nama</th>
							<th>Jenis Kelamin</th>
							<th>Jabatan</th>
							<th>Alamat</th>
							<th>No.Hp</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$no = ($page-1)*10;
							foreach ($staff as $stf) {
								$no++;
						 ?>
						<tr>
							<td><?= $no ?>.</td>
							<td><?= $stf['username'] ?></td>
							<td><?= $stf['nama'] ?></td>
							<td><?= ($stf['jk']=='l'?'Laki-laki':'Perempuan') ?></td>
							<td><?= ($stf['level']=='l'?'Ketua':'Staff') ?></td>
							<td><?= $stf['alamat'] ?></td>
							<td><?= $stf['no_hp'] ?></td>
							<td>
								<a href="index.php?edit=<?= $stf['id_staff'] ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a> &nbsp;
								<a href="lib/hapus.php?id=<?= $stf['id_staff'] ?>" onclick="return confirm('Hapus data staff?')" class="btn btn-danger btn-sm"> Hapus</a>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
			
			<hr>

			<?php if (!isset($_GET['search'])) { ?>
			<ul class="pagination">
			    <li class="page-item"><a class="page-link" href="#"><i class="fa fa-angle-left"></i></a></li>
			    <li class="page-item <?= ($page == 1?'active':'') ?>"><a class="page-link" href="index.php">1</a></li>
			    <?php 
			    	for ($i=1; $i <= (int)($db->count() / 10); $i++) { 
			    		$p = $i + 1;
			    ?>
			    <li class="page-item <?= ($page == $p?'active':'') ?>"><a class="page-link" href="index.php?page=2"><?= $p ?></a></li>	
			    <?php } ?>
			    <li class="page-item"><a class="page-link" href="#"><i class="fa fa-angle-right"></i></a></li>
			 </ul>
			<?php } ?>
		</div>
	</div>

	<div class="row bg-dark foot">
		<div class="col-md-8 offset-md-2 text-center">
			<i class="fa fa-code"></i> Franata Ardhi Sukma | 18051214033
		</div>
	</div>
</div>


<!-- MODAL -->
<form class="modal fade" tabindex="-1" role="dialog" id="add" method="post" action="lib/insert.php">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-dark">
        <h5 class="modal-title">Tambah Data Staff</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<label>Username</label>
		<input type="text" name="username" class="form-control" placeholder="Username"><br>
        <label>Password</label>
		<input type="password" name="pass" class="form-control" placeholder="******"><br>
        <label>Nama Staff</label>
		<input type="text" name="nama" class="form-control" placeholder="Nama"><br>
		<label>Jenis Kelamin</label>
		<select class="form-control" name="jk">
			<option value="l">Laki-laki</option>
			<option value="p">Perempuan</option>
		</select><br>
		<label>Jabatan</label>
		<select class="form-control" name="level">
			<option value="1">Ketua</option>
			<option value="2">Staff</option>
		</select><br>
		<label>Alamat</label>
		<input type="text" name="alamat" class="form-control" placeholder="Alamat"><br>
		<label>No.Hp</label>
		<input type="text" name="no_hp" class="form-control" placeholder="No.Hp"><br>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
    </div>
  </div>
</form>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript">
	$(function () {
	  $('[data-toggle="tooltip"]').tooltip()
	})
</script>
</body>
</html>