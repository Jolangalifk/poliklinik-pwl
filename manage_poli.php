<!DOCTYPE html>
<html>

<head>
	<title>Manage Poli</title>
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
			<li><a href="manage_user.php">Manage User</a></li>
			<li><a href="manage_poli.php">Manage Poli</a></li>
			<li><a href="manage_dokter.php">Manage Dokter</a></li>
		</ul>
	</div>

	<div style="margin-top: 120px; margin-left: 260px; padding: 30px; width: calc(100% - 320px);">
		<h4 style="margin-bottom: 25px; font-size: 20px; color: #1E3A8A;"><a href="tambah_poli.php" style="background-color: #1E3A8A; color: white; padding: 10px 20px; border-radius: 6px; text-decoration: none; display: inline-block; font-weight: 600; transition: all 0.3s;">+ Tambah Data Poli</a></h4>
		<table width="100%" style="padding: 15px; box-shadow: 0 2px 8px rgba(30, 58, 138, 0.1); border-radius: 8px; overflow: hidden;">
			<tr style="background-color: #1E3A8A; color: white; font-family: 'Poppins', sans-serif; font-weight: 600;">
				<th width="10%" style="text-align: center;">ID Poli</th>
				<th width="45%" style="text-align: center;">Nama Poli</th>
				<th width="45%" style="text-align: center;">Aksi</th>
			</tr>


			<?php
			include "koneksi.php";
			$query = mysqli_query($connect, "select * from poli");
			while ($data = mysqli_fetch_array($query)) {
			?>
				<tr style="background-color: white; color: #1E3A8A; font-family: 'Poppins', sans-serif; text-align: center;">
					<td width="10%">
						<?php echo $data['id_poli']; ?>
					</td>
					<td width="60%">
						<?php echo $data['nama_poli']; ?>
					</td>
					<td width="30%">
						<a href="edit_poli.php?id=<?php echo $data['id_poli']; ?>" style="background-color: #1E3A8A; color: white; padding: 5px 10px; border-radius: 6px; text-decoration: none; display: inline-block; font-weight: 600; transition: all 0.3s;">Edit</a>
						<a href="hapus_poli.php?id=<?php echo $data['id_poli']; ?>" style="background-color: #DC2626; color: white; padding: 5px 10px; border-radius: 6px; text-decoration: none; display: inline-block; font-weight: 600; transition: all 0.3s;" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
					</td>
				</tr>
			<?php
			}
			?>

		</table>
	</div>
</body>

</html>
