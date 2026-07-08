<!DOCTYPE html>
<html>

<head>
    <title>Halaman Pasien</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style_sheet.css">
    <link rel="icon" type="image/png" href="assets/logo-udinus.png">
</head>

<body>
    <?php
    session_start();

    if (!isset($_SESSION['level']) || $_SESSION['level'] == "") {
        header("location:index.php?pesan=gagal");
        exit();
    }

    $username = $_SESSION['username'];
    $level    = $_SESSION['level'];
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
    <div class="top-right">
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
            <li><a href="manage_daftar.php">Daftar</a></li>
            <li><a href="manage_antrian_daftar_pasien.php">Antrian</a></li>

        </ul>
    </div>


    <div class="content">
        <div style="margin-top:100px;margin-left:250px">
            <?php if ($level == "admin") { ?>
                <div style="margin-bottom: 20px;">
                    <a href="tambah_pasien.php" style="padding: 10px 20px; background-color: #1E3A8A; color: white; text-decoration: none; border-radius: 5px; font-weight: bold;">+ Tambah Pasien</a>
                </div>
            <?php } ?>
            <table width="1027" style=" padding: 15px;">
                <tr style="background-color: #1E3A8A; color: white;">
                    <th width="5%" style="text-align: center;">
                        Id Pasien
                    </th>
                    <th width="20%" style="text-align: center;">
                        Nama Pasien
                    </th>
                    <th width="20%" style="text-align: center;">
                        Alamat
                    </th>
                    <th width="10%" style="text-align: center;">
                        No.Ktp Pasien
                    </th>
                    <th width="10%" style="text-align: center;">
                        No.HP Pasien
                    </th>
                    <th width="10%" style="text-align: center;">
                        No.Rm Pasien
                    </th>
                    <th width="15%" style="text-align: center;">
                        Aksi
                    </th>
                </tr>


                <?php
                include "koneksi.php";
                $username = $_SESSION['username'];
                $level = $_SESSION['level'];
                
                // Jika admin atau dokter, tampilkan semua pasien
                // Jika pasien, tampilkan hanya data dirinya sendiri
                if ($level == "admin" || $level == "dokter") {
                    $query = mysqli_query($connect, "SELECT * FROM pasien");
                } else {
                    // Pasien hanya bisa melihat data dirinya sendiri
                    $query = mysqli_query($connect, "SELECT * FROM pasien WHERE nama_pasien='$username'");
                }
                
                while ($data = mysqli_fetch_array($query)) {
                ?>
                    <tr>
                        <td style="text-align: center;">
                            <?php echo $data['id_pasien']; ?>
                        </td>
                        <td style="text-align: center;">
                            <?php echo $data['nama_pasien']; ?>
                        </td>
                        <td style="text-align: center;">
                            <?php echo $data['alamat_pasien']; ?>
                        </td>
                        <td style="text-align: center;">
                            <?php echo $data['noktp_pasien']; ?>
                        </td>
                        <td style="text-align: center;">
                            <?php echo $data['nohp_pasien']; ?>
                        </td>
                        <td style="text-align: center;">
                            <?php echo $data['norm_pasien']; ?>
                        </td>
                        <td style="text-align: center; display: flex; flex-direction: row; gap: 10px;">
                            <a href="edit_pasien.php?id=<?= $data['id_pasien'] ?>" style="background-color: #1E3A8A; color: white; padding: 10px 20px; border-radius: 6px; text-decoration: none; display: inline-block; font-weight: 600; transition: all 0.3s; margin-right: 10px;">Edit</a>
						    <a href="hapus_pasien.php?id=<?= $data['id_pasien'] ?>" style="background-color: #DC2626; color: white; padding: 10px 20px; border-radius: 6px; text-decoration: none; display: inline-block; font-weight: 600; transition: all 0.3s;">Hapus</a>
                        </td>
                    </tr>
                <?php
                }
                ?>

            </table>
        </div>
</body>

</html>