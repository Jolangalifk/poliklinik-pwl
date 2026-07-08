<!DOCTYPE html>
<html>

<head>
    <title>Halaman admin</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style_sheet.css">
    <link rel="stylesheet" href="style_periksa.css">
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
    <!--
	<h1>Halaman Admin</h1>

	<p>Halo <b><?php echo $_SESSION['username']; ?></b> Anda telah login sebagai <b><?php echo $_SESSION['level']; ?></b>.</p>
	<a href="index.php">LOGOUT</a>

	<br/>
	<br/>

	<a><a href="https://www.malasngoding.com/membuat-login-multi-user-level-dengan-php-dan-mysqli">Membuat Login Multi Level Dengan PHP</a> - www.malasngoding.com</a>
	-->

    <div class="top-left">
        <img src="./assets/logo-udinus.png" alt="logo-udinus">
        <p class="title">
            POLY
        </p>
        <p class="define">
            Clinic Universitas Dian Nuswantoro
        </p>

    </div>
    <div class="top-right">
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
            <li><a href="manage_dokter.php">Dokter</a></li>
            <li><a href="manage_user.php">User</a></li>
            <li><a href="manage_pasien.php">Pasien</a></li>
            <li><a href="manage_pemeriksaan_pasien.php">Periksa</a></li>
        </ul>
    </div>

     <?php
    include "koneksi.php";
    
    // Validasi dan ambil parameter
    if (!isset($_GET['id_daftar']) || empty($_GET['id_daftar'])) {
        header("location:manage_pemeriksaan_pasien.php");
        exit();
    }
    
    $id_daftar = mysqli_real_escape_string($connect, $_GET['id_daftar']);
    
    // Query yang aman dengan prepared statement concept
    $query = mysqli_query(
        $connect,
        "SELECT
        daftar.*,pasien.nama_pasien,pasien.norm_pasien,pasien.id_pasien,dokter.nama_dokter,dokter.id_dokter
        FROM daftar,pasien,dokter
        WHERE
        daftar.id_pasien=pasien.id_pasien
        AND
        daftar.id_dokter=dokter.id_dokter
        AND
        status_periksa='menunggu'
        AND
        daftar.id_daftar='$id_daftar'
        LIMIT 1"
    );
    
    // Cek apakah query berhasil
    if (!$query) {
        echo "Query Error: " . mysqli_error($connect);
        exit();
    }
    
    $data = mysqli_fetch_array($query);
    
    // Cek apakah data ditemukan
    if (!$data) {
        echo "Data pemeriksaan tidak ditemukan atau status tidak 'menunggu'!";
        echo "<br><a href='manage_pemeriksaan_pasien.php'>Kembali</a>";
        exit();
    }
    ?>

    <!--<div class="header"> -->
    <div style="margin-top:70px;margin-left:250px">
        <h2>
            Form Pemeriksaan Pasien
        </h2>
    </div>

    <!--<div class="container"> -->
    <div style="margin-top:10px;margin-left:250px">
        <form
            action="save_pemeriksaan_admin.php"
            method="POST">

            <input
                type="hidden"
                name="id_daftar"
                value="<?php echo $data['id_daftar']; ?>" readonly>

            <!-- IDENTITAS -->

            <div class="card">

                <div class="grid-2">

                    <div>

                        <label>No Antrian</label>

                        <input
                            type="text"
                            readonly
                            value="<?php echo $data['nomor_antrian']; ?>" readonly>

                    </div>

                    <div>

                        <label>No Rekam Medis</label>

                        <input
                            type="text"
                            readonly
                            value="<?php echo $data['norm_pasien']; ?>" readonly>

                    </div>

                    <div>

                        <label>Id. Pasien</label>

                        <input
                            type="text"
                            name="id_pasien"
                            readonly
                            value="<?php echo $data['id_pasien']; ?>" readonly>

                    </div>

                    <div>

                        <label>Nama Pasien</label>

                        <input
                            type="text"
                            readonly
                            value="<?php echo $data['nama_pasien']; ?>" readonly>

                    </div>

                    <div>

                        <label>Id. Dokter</label>

                        <input
                            type="text"
                            name="id_dokter"
                            readonly
                            value="<?php echo $data['id_dokter']; ?>" readonly>

                    </div>

                    <div>

                        <label>Nama Dokter</label>

                        <input
                            type="text"
                            readonly
                            value="<?php echo $data['nama_dokter']; ?>" readonly>

                    </div>

                    <div>

                        <label>Tanggal</label>

                        <input
                            type="text"
                            name="tanggal_pemeriksaan"
                            readonly
                            value="<?php echo date('d-m-Y'); ?>">

                    </div>

                </div>
            </div>

            <!-- PROFILE KESEHATAN -->

            <div class="card">

                <div class="section-title">

                    Profile Kesehatan

                </div>

                <div class="grid-2">

                    <div>

                        <label>Tekanan Darah</label>

                        <input
                            type="text"
                            name="tekanan_darah">

                    </div>

                    <div>

                        <label>Tinggi Badan (cm)</label>

                        <input
                            type="number"
                            name="tinggi_badan">

                    </div>

                    <div>

                        <label>Berat Badan (kg)</label>

                        <input
                            type="number"
                            name="berat_badan">

                    </div>

                </div>

            </div>

            <div class="footer-action">

                <button
                    type="submit"
                    name="save"
                    class="btn btn-save">

                    Save

                </button>

            </div>

        </form>

    </div>
</body>

</html>