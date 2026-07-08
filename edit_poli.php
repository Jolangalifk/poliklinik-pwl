<!DOCTYPE html>
<html>

<head>
	<title>Edit Poli</title>
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
			<li><a href="manage_poli.php">Manage Poli</a></li>
		</ul>
	</div>

	<div class="kotak_login" style="width: 600px; position: absolute; left: 35%; top: 130px; margin: 0; margin-top: 0;">
		<p class="tulisan_login" style="margin-bottom: 25px; font-size: 22px;">Update Poli</p>

		<form action="update_poli.php" method="post">
			<?php
			include "koneksi.php";
			$id = $_GET['id'];
			$query = "SELECT * FROM poli WHERE id_poli='$id'";
			$sql = mysqli_query($connect, $query);
			while ($data = mysqli_fetch_array($sql)) {
			?>
				<input type="hidden" name="id_poli" value="<?php echo $data['id_poli'] ?>">
				
				<label>ID Poli</label>
				<input type="text" class="form_login" value="<?php echo $data['id_poli'] ?>" disabled>

				<label>Nama Poli</label>
				<input type="text" name="nama_poli" class="form_login" value="<?php echo $data['nama_poli'] ?>" required>

			<?php
			}			?>
			<button type="submit" class="btn_login" style="background-color: #1E3A8A; color: white; padding: 10px 20px; border-radius: 6px; border: none; font-weight: 600; cursor: pointer; transition: all 0.3s;">UPDATE</button>

			<br />

		</form>

	</div>
</body>

</html>
