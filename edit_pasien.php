<!DOCTYPE html>
<html>

<head>
	<title>Edit Pasien</title>
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

	// Validasi akses berdasarkan role
	$level = $_SESSION['level'];
	$username = $_SESSION['username'];
	
	// Jika level adalah pasien, periksa apakah mereka mengakses data dirinya sendiri
	if ($level == "pasien" && isset($_GET['id'])) {
		include "koneksi.php";
		$id = mysqli_real_escape_string($connect, $_GET['id']);
		$checkQuery = "SELECT nama_pasien FROM pasien WHERE id_pasien='$id'";
		$checkResult = mysqli_query($connect, $checkQuery);
		$checkData = mysqli_fetch_assoc($checkResult);
		
		// Jika nama pasien tidak sesuai dengan username yang login, redirect
		if (!$checkData || $checkData['nama_pasien'] != $username) {
			header("location:manage_pasien.php");
			exit();
		}
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
		<p class="tulisan_login" style="margin-bottom: 25px; font-size: 22px;">Update Pasien</p>

		<form action="update_pasien.php" method="post">
			<?php
			include "koneksi.php";
			if (isset($_GET['id'])) {
				$id = mysqli_real_escape_string($connect, $_GET['id']);
				$query = "SELECT * FROM pasien WHERE id_pasien='$id'";
				$sql = mysqli_query($connect, $query);
				
				if (mysqli_num_rows($sql) > 0) {
					while ($data = mysqli_fetch_array($sql)) {
			?>
				<input type="hidden" name="id_pasien" value="<?php echo $data['id_pasien'] ?>">
				
				<label>ID Pasien</label>
				<input type="text" class="form_login" value="<?php echo $data['id_pasien'] ?>" disabled>

				<label>Nama Pasien</label>
				<input type="text" name="nama_pasien" class="form_login" value="<?php echo $data['nama_pasien'] ?>" required>
				
				<label>Alamat Pasien</label>
				<input type="text" name="alamat_pasien" class="form_login" value="<?php echo $data['alamat_pasien'] ?>" required>

				<label>No KTP Pasien</label>
				<input type="text" name="noktp_pasien" class="form_login" value="<?php echo $data['noktp_pasien'] ?>" required>

				<label>No HP Pasien</label>
				<input type="text" name="nohp_pasien" class="form_login" value="<?php echo $data['nohp_pasien'] ?>" required>

				<label>No RM Pasien</label>
				<input type="text" name="norm_pasien" class="form_login" value="<?php echo $data['norm_pasien'] ?>" required>
			<?php
					}
				} else {
					echo "<p style='color: red;'>Data pasien tidak ditemukan!</p>";
				}
			} else {
				echo "<p style='color: red;'>ID Pasien tidak valid!</p>";
			}
			?>
			<button type="submit" class="btn_login" style="background-color: #1E3A8A; color: white; padding: 10px 20px; border-radius: 6px; border: none; font-weight: 600; cursor: pointer; transition: all 0.3s;">UPDATE</button>

			<br />

		</form>

	</div>
</body>

</html>
