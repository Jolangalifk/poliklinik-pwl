<!DOCTYPE html>
<html>

<head>
	<title>Tambah Pasien</title>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="style_sheet.css">
	<link rel="icon" type="image/png" href="assets/logo-udinus.png">
</head>

<body>
	<?php
	session_start();

	// cek apakah yang mengakses halaman ini sudah login
	if ($_SESSION['level'] == "") {
		header("location:index.php?pesan=gagal");
	}

	// Hanya admin yang bisa tambah pasien
	if ($_SESSION['level'] != "admin") {
		header("location:manage_pasien.php");
		exit();
	}

	?>
	<div class="top-left">
		<img src="./assets/logo-udinus.png" alt="logo-udinus">
		<p class="title">
			POLIKLINIK
		</p>
		<p class="define">
			Clinic Universitas Dian Nuswantoro
		</p>

	</div>
	<div class="top-right" style="display: flex; padding-left: 10px; flex-direction: row; justify-content: space-between; align-items: center;">
		<p class="page-title">
		<p>
			<b>Halaman Admin</b>
			<br>
			Halo : <b><?php echo $_SESSION['username'];
						$username = $_SESSION["username"];
						function GetNama($username)
						{
							print $username;
						}
						?></b>
			<br>
			</b> Anda telah login sebagai <b><?php echo $_SESSION['level'];
												$level = $_SESSION["level"];
												function GetLevel($level)
												{
													print $level;
												}
												?></b>.
		</p>
		</p>
		<div class="logout-button">
			<a href="index.php">
				<b> Logout </b>
			</a>
		</div>
	</div>
	<div class="horizontal-menu">
		<img src="./assets/logo-udinus.png" alt="profile">
		<div class="nama">
			<h2><?php getNama($username) ?></h2>
			<h6><?php getLevel($level) ?></h6>
		</div>
		<ul>
			<li><a href="halaman_admin.php">Home</a></li>
			<li><a href="manage_pasien.php">Manage Pasien</a></li>
		</ul>
	</div>

	<div class="kotak_login" style="width: 600px; position: absolute; left: 35%; top: 130px; margin: 0; margin-top: 0;">
		<p class="tulisan_login" style="margin-bottom: 25px; font-size: 22px;">Tambah Data Pasien Baru</p>

		<form action="simpan_pasien.php" method="post">
			
			<label>Nama Pasien</label>
			<input type="text" name="nama_pasien" class="form_login" placeholder="Masukkan nama pasien" required>
			
			<label>Alamat Pasien</label>
			<input type="text" name="alamat_pasien" class="form_login" placeholder="Masukkan alamat pasien" required>

			<label>No KTP Pasien</label>
			<input type="text" name="noktp_pasien" class="form_login" placeholder="Masukkan nomor KTP" required>

			<label>No HP Pasien</label>
			<input type="text" name="nohp_pasien" class="form_login" placeholder="Masukkan nomor HP" required>

			<label>No RM Pasien</label>
			<input type="text" name="norm_pasien" class="form_login" placeholder="Masukkan nomor RM" required>

			<button type="submit" class="btn_login" style="background-color: #04AA6D; color: white; padding: 10px 20px; border-radius: 6px; border: none; font-weight: 600; cursor: pointer; transition: all 0.3s;">SIMPAN</button>

			<a href="manage_pasien.php" class="btn_login" style="display: inline-block; background-color: #999999; color: white; padding: 10px 20px; border-radius: 6px; border: none; font-weight: 600; cursor: pointer; transition: all 0.3s; text-align: center; text-decoration: none; margin-left: 10px;">BATAL</a>

			<br />

		</form>

	</div>
</body>

</html>
