<!DOCTYPE html>
<html>

<head>
	<title>Halaman admin</title>
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
		<!-- <p>Jolang Alif Khan - A12.2024.07239</p> -->
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
			<li><a href="index.php">Home</a></li>
			<li><a href="manage_user.php">Manage User</a></li>
		</ul>
	</div>

	<div class="kotak_login" style="width: 600px; position: absolute; left: 35%; top: 130px; margin: 0; margin-top: 0;">
		<p class="tulisan_login" style="margin-bottom: 25px; font-size: 22px;">Update User</p>

		<form action="update_user.php" method="post">
			<?php
			include "koneksi.php";
			$id = $_GET['id'];
			$query = "SELECT * FROM user WHERE id='$id'";
			$sql = mysqli_query($connect, $query);
			while ($data = mysqli_fetch_array($sql)) {
			?>
				<input type="hidden" name="id" value="<?php echo $data['id'] ?>">
				
				<label>ID</label>
				<input type="text" class="form_login" value="<?php echo $data['id'] ?>" disabled>

				<label>Nama</label>
				<input type="text" name="nama" class="form_login" value="<?php echo $data['nama'] ?>" required>

				<label>Username</label>
				<input type="text" name="username" class="form_login" value="<?php echo $data['username'] ?>" required>

				<label>Password</label>
				<input type="text" name="password" class="form_login" value="<?php echo $data['password'] ?>" required>

				<label>Level</label>
				<input type="text" name="level" class="form_login" value="<?php echo $data['level'] ?>" required>
			<?php
			}			?>
			<input type="submit" class="tombol_login" value="UPDATE">

			<br />

		</form>

	</div>
</body>

</html>