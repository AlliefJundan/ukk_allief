<?php
// Ambil id_penjualan dari URL atau request
$id_penjualan = $_GET['id'];

// Query untuk mengambil data penjualan dan detail produk yang dibeli
$query_struk = mysqli_query($koneksi, "
    SELECT produk.nama_produk, detail_penjualan.jumlah_produk, produk.harga, detail_penjualan.subtotal
    FROM detail_penjualan
    JOIN produk ON detail_penjualan.id_produk = produk.id_produk
    WHERE detail_penjualan.id_penjualan = '$id_penjualan'
");

// Query untuk mengambil informasi pembelian dan pelanggan
$query_info = mysqli_query($koneksi, "
    SELECT penjualan.tanggal_penjualan, pelanggan.nama_pelanggan, penjualan.total_harga
    FROM penjualan
    JOIN pelanggan ON penjualan.id_pelanggan = pelanggan.id_pelanggan
    WHERE penjualan.id_penjualan = '$id_penjualan'
");

// Ambil informasi pembelian dan pelanggan
$info = mysqli_fetch_array($query_info);
$tanggal_penjualan = $info['tanggal_penjualan'];
$nama_pelanggan = $info['nama_pelanggan'];
$total_harga = $info['total_harga'];

?>

<div class="container-fluid px-4 text-light">
    <h1 class="mt-4">Struk Penjualan</h1>
    <br>
    <br>
    <a href="?page=pembelian" class="btn btn-dark text-light">Kembali</a>
    <a href="cetak_struk.php?id=<?php echo $id_penjualan; ?>" target="_blank" class="btn btn-success text-light">Cetak
        Struk</a>
    <hr>
    <p><strong>Waktu Pembelian:</strong> <?php echo $tanggal_penjualan; ?></p>
    <p><strong>Nama Pelanggan:</strong> <?php echo $nama_pelanggan; ?></p>

    <table class="table table-bordered text-light">
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $total_harga_struk = 0;
            while ($data_struk = mysqli_fetch_array($query_struk)) {
                $subtotal = $data_struk['subtotal'];
                $total_harga_struk += $subtotal;
                ?>
                <tr>
                    <td><?php echo $data_struk['nama_produk']; ?></td>
                    <td><?php echo $data_struk['jumlah_produk']; ?></td>
                    <td>Rp <?php echo number_format($data_struk['harga'], 0, ',', '.'); ?></td>
                    <td>Rp <?php echo number_format($subtotal, 0, ',', '.'); ?></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>

    <!-- Total Harga -->
    <p><strong>Total Harga:</strong> Rp <?php echo number_format($total_harga_struk, 0, ',', '.'); ?></p>
</div>