<?php
session_start();

if (!isset($_SESSION['level']) || $_SESSION['level'] == "") {
    header("location:index.php?pesan=gagal");
    exit;
}

include "koneksi.php";

$id_daftar = isset($_GET['id_daftar']) ? $_GET['id_daftar'] : '';

if (empty($id_daftar)) {
    header("location:manage_pemeriksaan_dokter.php");
    exit;
}

$id_daftar = mysqli_real_escape_string($connect, $id_daftar);

$query = mysqli_query(
    $connect,
    "SELECT daftar.*, pasien.nama_pasien, pasien.norm_pasien, dokter.nama_dokter, dokter.biaya_periksa,
            rekam_medis.id_rekam_medis,
            COALESCE((SELECT SUM(detail_rekam_medis.jumlah * obat.harga_obat)
                      FROM detail_rekam_medis
                      LEFT JOIN obat ON detail_rekam_medis.id_obat = obat.id_obat
                      WHERE detail_rekam_medis.id_rekam_medis = rekam_medis.id_rekam_medis), 0) AS total_obat
     FROM daftar
     LEFT JOIN pasien ON daftar.id_pasien = pasien.id_pasien
     LEFT JOIN dokter ON daftar.id_dokter = dokter.id_dokter
     LEFT JOIN rekam_medis ON rekam_medis.id_daftar = daftar.id_daftar
     WHERE daftar.id_daftar = '$id_daftar'
     LIMIT 1"
);

$data = mysqli_fetch_array($query);

if (!$data) {
    echo "Data pasien tidak ditemukan.";
    exit;
}

$nama_pasien = $data['nama_pasien'];
$norm_pasien = $data['norm_pasien'];
$nama_dokter = $data['nama_dokter'];
$id_rekam_medis = $data['id_rekam_medis'];
$tanggal_bayar = date('Y-m-d');
$biaya_pemeriksaan = isset($data['biaya_periksa']) ? $data['biaya_periksa'] : 0;

$obat_items = [];
$biaya_obat = 0;

if (!empty($id_rekam_medis)) {
    $obat_query = mysqli_query(
        $connect,
        "SELECT obat.id_obat AS kode_obat, obat.nama_obat, obat.stok_obat, obat.satuan_obat, obat.harga_obat,
                detail_rekam_medis.jumlah, detail_rekam_medis.aturan_pakai,
                (detail_rekam_medis.jumlah * obat.harga_obat) AS total_harga
         FROM detail_rekam_medis
         LEFT JOIN obat ON detail_rekam_medis.id_obat = obat.id_obat
         WHERE detail_rekam_medis.id_rekam_medis = '$id_rekam_medis'"
    );

    while ($row = mysqli_fetch_assoc($obat_query)) {
        $obat_items[] = $row;
        $biaya_obat += floatval($row['total_harga']);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Bayar Pemeriksaan</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style_sheet.css">
    <link rel="stylesheet" href="style_periksa.css">
    <link rel="icon" type="image/png" href="assets/logo-udinus.png">
    <style>
        body { font-family: Arial, sans-serif; background: #f0f4f8; color: #202840; margin: 0; padding: 0; }
        .bayar-page { min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 40px 20px; }
        .bayar-card { width: 100%; max-width: 1000px; background: #fff; border-radius: 24px; box-shadow: 0 20px 45px rgba(16, 54, 112, 0.12); overflow: hidden; }
        .bayar-header { padding: 32px 40px 20px; border-bottom: 1px solid #e6ecf5; display: flex; justify-content: space-between; flex-wrap: wrap; gap: 20px; }
        .bayar-header h1 { margin: 0; font-size: 26px; letter-spacing: -0.3px; color: #1b263b; }
        .bayar-meta { display: grid; grid-template-columns: repeat(2, minmax(180px, 1fr)); gap: 14px; font-size: 14px; color: #546185; }
        .bayar-meta div { line-height: 1.8; }
        .table-wrapper { padding: 20px 40px 0; }
        .obat-table { width: 100%; border-collapse: collapse; }
        .obat-table th, .obat-table td { padding: 14px 16px; border-bottom: 1px solid #eef1f6; }
        .obat-table th { text-align: left; color: #33475b; background: #f8fafc; font-weight: 700; }
        .obat-table td { color: #33475b; }
        .obat-table tbody tr:hover { background: #f6f8fb; }
        .summary-box { padding: 24px 40px; display: grid; gap: 12px; border-top: 1px solid #e6ecf5; }
        .summary-row { display: flex; justify-content: space-between; align-items: center; font-size: 15px; color: #495167; }
        .summary-row.total-row { font-weight: 700; font-size: 17px; color: #1b263b; }
        .bayar-footer { padding: 24px 40px 40px; display: flex; justify-content: space-between; align-items: center; gap: 20px; flex-wrap: wrap; border-top: 1px solid #e6ecf5; }
        .bayar-field { min-width: 240px; width: 100%; max-width: 400px; }
        .bayar-field label { display: block; margin-bottom: 8px; font-weight: 700; color: #354060; }
        .bayar-field select { width: 100%; padding: 12px 14px; border-radius: 12px; border: 1px solid #d8dee8; background: #fff; color: #1f2a44; }
        .bayar-action button { width: 100%; max-width: 220px; padding: 14px 22px; background: #3b82f6; border: none; border-radius: 14px; color: #fff; font-size: 15px; cursor: pointer; transition: background 0.2s ease; }
        .bayar-action button:hover { background: #2563eb; }
        .bayar-action { width: 100%; max-width: 220px; }
        @media (max-width: 760px) {
            .bayar-meta { grid-template-columns: 1fr; }
            .bayar-footer { flex-direction: column; align-items: stretch; }
            .bayar-action button { width: 100%; }
        }
    </style>
</head>
<body>
    <div class="bayar-page">
        <div class="bayar-card">
            <div class="bayar-header">
                <div>
                    <h1>Pembayaran Pasien</h1>
                </div>
                <div class="bayar-meta">
                    <div><strong>No RM</strong> <?php echo htmlspecialchars($norm_pasien); ?></div>
                    <div><strong>Nama Pasien</strong> <?php echo htmlspecialchars($nama_pasien); ?></div>
                    <div><strong>Dokter</strong> <?php echo htmlspecialchars($nama_dokter); ?></div>
                    <div><strong>Tanggal</strong> <?php echo date('d-m-Y', strtotime($tanggal_bayar)); ?></div>
                </div>
            </div>

            <form action="save_bayar.php" method="POST">
                <input type="hidden" name="id_daftar" value="<?php echo htmlspecialchars($id_daftar); ?>">
                <input type="hidden" name="id_rekam_medis" value="<?php echo htmlspecialchars($id_rekam_medis); ?>">
                <input type="hidden" name="biaya_pemeriksaan" id="biaya_pemeriksaan" value="<?php echo htmlspecialchars($biaya_pemeriksaan); ?>">
                <input type="hidden" name="biaya_obat" id="biaya_obat" value="<?php echo htmlspecialchars($biaya_obat); ?>">
                <input type="hidden" name="total_bayar" id="total_bayar" value="<?php echo htmlspecialchars($biaya_pemeriksaan + $biaya_obat); ?>">

                <div class="table-wrapper">
                    <table class="obat-table">
                        <thead>
                            <tr>
                                <th>Obat</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($obat_items)): ?>
                                <?php foreach ($obat_items as $item): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($item['nama_obat']); ?></td>
                                        <td>Rp <?php echo number_format($item['harga_obat'], 0, ',', '.'); ?></td>
                                        <td><?php echo htmlspecialchars($item['jumlah']); ?></td>
                                        <td>Rp <?php echo number_format($item['total_harga'], 0, ',', '.'); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" style="text-align:center;">Tidak ada data obat</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <div class="summary-box">
                    <div class="summary-row">
                        <span>Biaya Pemeriksaan</span>
                        <span>Rp <?php echo number_format($biaya_pemeriksaan, 0, ',', '.'); ?></span>
                    </div>
                    <div class="summary-row">
                        <span>Total Obat</span>
                        <span>Rp <?php echo number_format($biaya_obat, 0, ',', '.'); ?></span>
                    </div>
                    <div class="summary-row total-row">
                        <span>Total Bayar</span>
                        <span>Rp <?php echo number_format($biaya_pemeriksaan + $biaya_obat, 0, ',', '.'); ?></span>
                    </div>
                </div>

                <div class="bayar-footer">
                    <div class="bayar-field">
                        <label>Metode Bayar</label>
                        <select name="metode_bayar" required>
                            <option value="Tunai">Tunai</option>
                            <option value="Transfer">Transfer</option>
                            <option value="Debit">Debit</option>
                            <option value="Kartu Kredit">Kartu Kredit</option>
                        </select>
                    </div>
                    <div class="bayar-action">
                        <button type="submit">Bayar Sekarang</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('bayar-form');
    </script>
</body>
</html>