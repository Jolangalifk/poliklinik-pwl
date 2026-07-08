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
            <li><a href="manage_dokter.php">Manage Dokter</a></li>
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
        $biaya_periksa = $data['biaya_periksa'];
        $keterangan_dokter = $data['keterangan_dokter'];
        $foto_dokter = $data['foto_dokter'];
        $id_user = $data['id_user'];
    }
    ?>

    <div class="kotak_login" style="width: 600px; position: absolute; left: 35%; top: 130px; margin: 0; margin-top: 0;">
        <p class="tulisan_login" style="margin-bottom: 25px; font-size: 22px;">Update Dokter</p>

        <form action="update_dokter.php" method="post" enctype="multipart/form-data">
            
            <input type="hidden" name="id_user" value="<?php echo $id_user; ?>">
            <input type="hidden" name="id_dokter" value="<?php echo $id_dokter; ?>">

            <label for="id_dokter" style="font-size: 14px; color: #1E3A8A; font-weight: 600;">ID Dokter</label>
            <input type="text" class="form_login" value="<?php echo $id_dokter; ?>" disabled>

            <label for="nama_dokter" style="font-size: 14px; color: #1E3A8A; font-weight: 600;">Nama Dokter</label>
            <input type="text" name="nama_dokter" class="form_login" placeholder="Masukkan Nama Dokter" required="required" value="<?php echo $nama_dokter; ?>">

            <label for="alamat_dokter" style="font-size: 14px; color: #1E3A8A; font-weight: 600;">Alamat Dokter</label>
            <input type="text" name="alamat_dokter" class="form_login" placeholder="Masukkan Alamat Dokter" required="required" value="<?php echo $alamat_dokter; ?>">

            <label for="nohp_dokter" style="font-size: 14px; color: #1E3A8A; font-weight: 600;">No HP Dokter</label>
            <input type="text" name="nohp_dokter" class="form_login" placeholder="Masukkan No HP Dokter" required="required" value="<?php echo $nohp_dokter; ?>">

            <label for="keterangan_dokter" style="font-size: 14px; color: #1E3A8A; font-weight: 600;">Keterangan Dokter</label>
            <select name="keterangan_dokter" class="form_login" required>
                <option value="">Pilih Keterangan</option>
                <option value="Ada" <?php if($keterangan_dokter=='Ada') echo 'selected'; ?>>Ada</option>
                <option value="Tidak" <?php if($keterangan_dokter=='Tidak') echo 'selected'; ?>>Tidak</option>
            </select>

            <label for="id_poli" style="font-size: 14px; color: #1E3A8A; font-weight: 600;">Poli</label>
            <select name="id_poli" id="id_poli" class="form_login" onChange="tampilPoli()" required>
                <option value="">--Pilih Poli--</option>
                <?php
                include("koneksi.php");
                $sql = "SELECT * FROM poli";
                $result = mysqli_query($connect, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                    $selected = ($row['id_poli'] == $id_poli) ? "selected" : "";
                    echo "<option value='" . $row['id_poli'] . "' $selected>"
                        . $row['id_poli'] . " - " . $row['nama_poli'] .
                        "</option>";
                }
                ?>
            </select>

            <label style="font-size: 14px; color: #1E3A8A; font-weight: 600;">Nama Poli</label>
            <input type="text" name="nama_poli" class="form_login" id="nama_poli" readonly>

            <label for="biaya_periksa" style="font-size: 14px; color: #1E3A8A; font-weight: 600;">Biaya Periksa</label>
            <input type="decimal" name="biaya_periksa" class="form_login" placeholder="Masukkan Biaya Periksa" required value="<?php echo $biaya_periksa; ?>">

            <label style="font-size: 14px; color: #1E3A8A; font-weight: 600;">Foto Dokter</label><br>
			<input type="file" name="foto_dokter" accept="image/*" onChange="previewFoto(event)">
			<br>
            <?php if (!empty($foto_dokter)) { ?>
                <img src="foto/<?php echo $foto_dokter; ?>" id="preview" width="100" height="100" style="display:block; margin-bottom: 10px;">
            <?php } else { ?>
			    <img id="preview" width="100" height="100" style="display:none; margin-bottom: 10px;">
            <?php } ?>

            <button type="submit" class="btn_login" style="background-color: #1E3A8A; color: white; padding: 10px 20px; border-radius: 6px; border: none; font-weight: 600; cursor: pointer; transition: all 0.3s;">UPDATE</button>
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