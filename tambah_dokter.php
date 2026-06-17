<!DOCTYPE html>
<html>

<head>
    <title>Halaman admin</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style_sheet.css">
    <link rel="icon" type="image/png" href="assets/logo-udinus.png">
</head>
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

function previewFoto(event)
{

	var gambar = document.getElementById("preview");

	gambar.src = URL.createObjectURL(event.target.files[0]);

	gambar.style.display = "block";

}
</script>

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
            <li><a href="index.php">Home</a></li>
            <li><a href="manage_dokter.php">Manage Dokter</a></li>
        </ul>
    </div>

    <div class="kotak_login" style="width: 600px; position: absolute; left: 35%; top: 130px; margin: 0; margin-top: 0;">
        <p class="tulisan_login" style="margin-bottom: 25px; font-size: 22px;">Tambah Dokter</p>

        <form action="save_dokter.php" method="post" enctype="multipart/form-data">

            <label for="nama_dokter" style="font-size: 14px; color: #1E3A8A; font-weight: 600;">Nama Dokter</label>
            <input type="text" name="nama_dokter" class="form_login" placeholder="Masukkan Nama Dokter" required>

            <label for="alamat_dokter" style="font-size: 14px; color: #1E3A8A; font-weight: 600;">Alamat Dokter</label>
            <input type="text" name="alamat_dokter" class="form_login" placeholder="Masukkan Alamat Dokter" required>

            <label for="nohp_dokter" style="font-size: 14px; color: #1E3A8A; font-weight: 600;">No HP Dokter</label>
            <input type="text" name="nohp_dokter" class="form_login" placeholder="Masukkan No HP Dokter" required>

            <label for="keterangan_dokter" style="font-size: 14px; color: #1E3A8A; font-weight: 600;">Keterangan Dokter</label>
            <select name="keterangan_dokter" class="form_login" required>
                <option value="">Pilih Keterangan</option>
                <option value="Ada">Ada</option>
                <option value="Tidak Ada">Tidak Ada</option>
            </select>

            <!-- dropdown identitas poli mengambil dari tabel poli -->
            <label for="id_poli" style="font-size: 14px; color: #1E3A8A; font-weight: 600;">Poli</label>
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
			<input type="file" name="foto_dokter" accept="image/*" onChange="previewFoto(event)" required>
			<br>
			<img id="preview" width="100" height="100" style="display:none;">
			<br/>

            <button type="submit" class="btn_login" style="background-color: #1E3A8A; color: white; padding: 10px 20px; border-radius: 6px; border: none; font-weight: 600; cursor: pointer; transition: all 0.3s;">Simpan</button>

        </form>

    </div>
</body>

</html>