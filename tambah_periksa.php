<!DOCTYPE html>
<html>

<head>
	<title>Tambah Periksa</title>
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
			<b>Halaman Pasien</b>
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
			<li><a href="halaman_pasien.php">Home</a></li>
			<li><a href="manage_periksa.php">Manage Periksa</a></li>
		</ul>
	</div>

	<div class="kotak_login" style="width: 600px; position: absolute; left: 35%; top: 130px; margin: 0; margin-top: 0;">
		<p class="tulisan_login" style="margin-bottom: 25px; font-size: 22px;">Tambah Periksa</p>

		<form action="save_periksa.php" method="post">

			<label for="id_pasien" style="font-size: 14px; color: #1E3A8A; font-weight: 600;">ID Pasien</label>
			<input type="number" name="id_pasien" class="form_login" placeholder="Masukkan ID Pasien" required>

			<label for="tanggal_periksa" style="font-size: 14px; color: #1E3A8A; font-weight: 600;">Tanggal Periksa</label>
			<input type="date" name="tanggal_periksa" class="form_login" required>

			<label for="keterangan" style="font-size: 14px; color: #1E3A8A; font-weight: 600;">Keterangan</label>
			<textarea name="keterangan" class="form_login" placeholder="Masukkan Keterangan" rows="4" required></textarea>

			<button type="submit" class="btn_login" style="background-color: #1E3A8A; color: white; padding: 10px 20px; border-radius: 6px; border: none; font-weight: 600; cursor: pointer; transition: all 0.3s;">Simpan</button>

		</form>

	</div>
</body>

</html>
