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
			<a href="logout.php">
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
		<p class="tulisan_login" style="margin-bottom: 25px; font-size: 22px;">Tambah Pasien</p>

		<form action="save_pasien.php" method="post">

			<label for="nama_pasien" style="font-size: 14px; color: #1E3A8A; font-weight: 600;">Nama Pasien</label>
			<input type="text" name="nama_pasien" class="form_login" placeholder="Masukkan Nama Pasien" required>

			<label for="alamat_pasien" style="font-size: 14px; color: #1E3A8A; font-weight: 600;">Alamat Pasien</label>
			<input type="text" name="alamat_pasien" class="form_login" placeholder="Masukkan Alamat Pasien" required>

			<label for="noktp_pasien" style="font-size: 14px; color: #1E3A8A; font-weight: 600;">No KTP Pasien</label>
			<input type="text" name="noktp_pasien" class="form_login" placeholder="Masukkan No KTP" required>

			<label for="nohp_pasien" style="font-size: 14px; color: #1E3A8A; font-weight: 600;">No HP Pasien</label>
			<input type="text" name="nohp_pasien" class="form_login" placeholder="Masukkan No HP" required>

			<label for="norm_pasien" style="font-size: 14px; color: #1E3A8A; font-weight: 600;">No RM Pasien</label>
			<input type="text" name="norm_pasien" class="form_login" placeholder="Masukkan No Rekam Medis" required>

			<button type="submit" class="btn_login" style="background-color: #1E3A8A; color: white; padding: 10px 20px; border-radius: 6px; border: none; font-weight: 600; cursor: pointer; transition: all 0.3s;">Simpan</button>

		</form>

	</div>
</body>

</html>
