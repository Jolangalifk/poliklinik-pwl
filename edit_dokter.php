<!DOCTYPE html>
<html>

<head>
    <title>Halaman dokter</title>
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
            <li><a href="manage_dokter.php">Home</a></li>
            <li><a href="manage_dokter.php">Manage dokter</a></li>
        </ul>
    </div>

    <?php
    // Display selected user data based on id
    // Getting id from url
    include "koneksi.php";
    $id = $_GET['id_dokter'];

    // Fetech user data based on id
    $query = "SELECT * FROM dokter WHERE id_dokter='$id'";
    $sql = mysqli_query($connect, $query);

    while ($data = mysqli_fetch_array($sql)) {
        $id_dokter = $data['id_dokter'];
        $nama_dokter = $data['nama_dokter'];
        $alamat_dokter = $data['alamat_dokter'];
        $nohp_dokter = $data['nohp_dokter'];
        $id_poli = $data['id_poli'];
        $keterangan_dokter = $data['keterangan_dokter'];
        $foto_dokter = $data['foto_dokter'];
        $id_user = $data['id_user'];
    }
    ?>

    <div class="kotak_login">
        <p class="tulisan_login">Update Dokter</p>

        <form action="update_dokter.php" method="post" enctype="multipart/form-data">
            <label>Identitas Dokter</label>
            <input type="text" name="id_dokter" class="form_login" placeholder="Identitas .." required="required"
                value="<?php echo $id_dokter; ?>"readonly>

            <label>Nama Dokter</label>
            <input type="text" name="nama_dokter" class="form_login" placeholder="Nama .." required="required"
                value="<?php echo $nama_dokter; ?>">

            <label>Alamat Dokter</label>
            <input type="text" name="alamat_dokter" class="form_login" placeholder="alamat .." required="required"
                value="<?php echo $alamat_dokter; ?>">

            <label>Nohp Dokter</label>
            <input type="text" name="nohp_dokter" class="form_login" placeholder="nohp .." required="required"
                value="<?php echo $nohp_dokter; ?>">

            <input type="hidden" name="id_user" value="<?php echo $id_user; ?>">

            <label>Keterangan Dokter</label>
            <br>
            <select name="keterangan_dokter" required>
    <option value="">--Pilih Keterangan--</option>
    <option value="Ada">Ada</option>
    <option value="Tidak">Tidak</option>
</select>
            <br>
            <br>

            <select name="id_poli" id="id_poli" onChange="tampilPoli()" required>
                <option value="">--Pilih Poli--</option>

                <?php
                include("koneksi.php");
                $sql = "SELECT * FROM poli";
                $result = mysqli_query($connect, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='" . $row['id_poli'] . "'>"
                        . $row['id_poli'] . " - " . $row['nama_poli'] .
                        "</option>";
                }
                ?>
            </select>
            <br>
            <br>
            <label>Nama Poli</label>
            <input type="text" name="nama_poli" class="form_login" id="nama_poli" readonly>
            <label>Foto Dokter</label><br>
            <input type="file" name="foto_dokter" accept="image/*" onChange="previewFoto(event)">
            <br>
            <img id="preview" width="100" height="100" style="display:none;">
            <br />

            <input type="submit" class="tombol_login" value="UPDATE">
            <br />
        </form>
    </div>
    <script>
        function tampilPoli() {

            // Ambil select
            var select = document.getElementById("id_poli");

            // Ambil text option yang dipilih
            var text = select.options[select.selectedIndex].text;

            // Pisahkan ID dan nama jabatan
            var pecah = text.split(" - ");

            // Tampilkan nama jabatan
            if (pecah.length > 1) {
                document.getElementById("nama_poli").value = pecah[1];
            } else {
                document.getElementById("nama_poli").value = "";
            }
        }

        function previewFoto(event) {

            var gambar = document.getElementById("preview");

            gambar.src = URL.createObjectURL(event.target.files[0]);

            gambar.style.display = "block";
        }

    </script>
</body>

</html>