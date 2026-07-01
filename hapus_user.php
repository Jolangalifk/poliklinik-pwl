<?php
// include database connection file
include("koneksi.php");

// Get id from URL to delete that user
$id = $_GET['id'];

// Ambil username dan level dari tabel user sebelum dihapus
$query_old = mysqli_query($connect, "SELECT username, level FROM user WHERE id=$id");
if ($query_old && mysqli_num_rows($query_old) > 0) {
    $data_old = mysqli_fetch_assoc($query_old);
    $username = $data_old['username'];
    $level = strtolower($data_old['level']);
    
    // Hapus dari tabel pasien jika level pasien
    if($level == 'pasien'){
        mysqli_query($connect, "DELETE FROM pasien WHERE nama_pasien='$username'");
    }
    // Hapus dari tabel dokter jika level dokter
    else if($level == 'dokter'){
        mysqli_query($connect, "DELETE FROM dokter WHERE nama_dokter='$username'");
    }
}

// Delete user row from table based on given id
$query="DELETE FROM user WHERE id=$id";
$result = mysqli_query($connect,$query);

// After delete redirect to Home, so that latest user list will be displayed.
header("Location:manage_user.php");
?>
