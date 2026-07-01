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
			<li><a href="manage_user.php">Home</a></li>
			<li><a href="manage_user.php">Manage User</a></li>
		</ul>
	</div>

	<div style="margin-top: 120px; margin-left: 260px; padding: 30px; width: calc(100% - 320px);">
		<h4 style="margin-bottom: 25px; font-size: 20px; color: #1E3A8A;"><a href="tambah_user.php" style="background-color: #1E3A8A; color: white; padding: 10px 20px; border-radius: 6px; text-decoration: none; display: inline-block; font-weight: 600; transition: all 0.3s;">+ Tambah Data User</a></h4>
		<table width="100%" style="padding: 15px; box-shadow: 0 2px 8px rgba(30, 58, 138, 0.1); border-radius: 8px; overflow: hidden;">
			<tr style="background-color: #1E3A8A; color: white; font-family: 'Poppins', sans-serif; font-weight: 600;">
				<th width="5%" style="text-align: center;">
					Id User
				</th>
				<th width="20%" style="text-align: center;">
					Nama User
				</th>
				<th width="20%" style="text-align: center;">
					User Name
				</th>
				<th width="20%" style="text-align: center;">
					Password
				</th>
				<th width="20%" style="text-align: center;">
					Level
				</th>
				<th width="15%" style="text-align: center;">
					Action
				</th>
			</tr>


			<?php
			include "koneksi.php";
			$query = mysqli_query($connect, "select * from user");
			while ($data = mysqli_fetch_array($query)) {
			?>
				<tr>
					<td style="text-align: center;">
						<?php echo $data['id']; ?>
					</td>
					<td style="text-align: center;">
						<?php echo $data['nama']; ?>
					</td>
					<td style="text-align: center;">
						<?php echo $data['username'] ?>
					</td>
					<td style="text-align: center;">
						<?php echo $data['password']; ?>
					</td>
					<td style="text-align: center;">
						<?php echo $data['level']; ?>
					</td>
					<td style="display: flex; flex-direction: row; gap: 10px;">
						<a href="edit_user.php?id=<?= $data['id'] ?>" style="background-color: #1E3A8A; color: white; padding: 10px 20px; border-radius: 6px; text-decoration: none; display: inline-block; font-weight: 600; transition: all 0.3s; margin-right: 10px;">Edit</a>
						<a href="hapus_user.php?id=<?= $data['id'] ?>" style="background-color: #DC2626; color: white; padding: 10px 20px; border-radius: 6px; text-decoration: none; display: inline-block; font-weight: 600; transition: all 0.3s;">Hapus</a>
					</td>
				</tr>
			<?php
			}
			?>

		</table>
	</div>
</body>

</html>