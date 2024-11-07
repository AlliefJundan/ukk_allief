<?php
if($_SESSION    ["level"] !== "admin") {
    header("location=?page=home");
}
include("koneksi.php");

// Ambil rentang waktu dari parameter GET
$rentang_waktu = isset($_GET['rentang_waktu']) ? (int)$_GET['rentang_waktu'] : 1;

// Hitung tanggal awal berdasarkan rentang waktu (hari ini sebagai akhir)
$tanggal_awal = date('Y-m-d', strtotime("-" . ($rentang_waktu - 1) . " days"));
$tanggal_sekarang = date('Y-m-d 23:59:59');
$query = mysqli_query($koneksi, "SELECT * FROM penjualan 
    LEFT JOIN pelanggan ON pelanggan.id_pelanggan = penjualan.id_pelanggan 
    WHERE tanggal_penjualan BETWEEN '$tanggal_awal' AND '$tanggal_sekarang' 
    ORDER BY tanggal_penjualan DESC");

?>

<html>
<head>
    <center><h1>Laporan Penjualan (<?php echo $rentang_waktu; ?> Hari Terakhir)</h1></center>
</head>
<body>

<table border="1" style="width:100%">
    <thead>
        <tr>
            <th>No</th>
            <th>ID Penjualan</th>
            <th>Waktu Pembelian</th>
            <th>Pelanggan</th>
            <th>Total Harga</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $nomor = 1;
        while ($data = mysqli_fetch_array($query)) {
            ?>
            <tr>
                <th scope="row"><?php echo $nomor++; ?></th>
                <td><?php echo $data['id_penjualan'];?></td>
                <td><?php echo $data['tanggal_penjualan']; ?></td>
                <td><?php echo $data['nama_pelanggan']; ?></td>
                <td><?php echo 'Rp ' . number_format($data['total_harga'], 0, ',', '.'); ?></td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>

<script>window.print()</script>
</body>
</html>
