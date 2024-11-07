<div class="container-fluid px-4">
    <h1 class="mt-4">Pembelian</h1>
    <br>
    <br>
    <a href="?page=pembelian_tambah" class="btn btn-dark text-light"><i class="fa-solid fa-cart-shopping"></i> Tambah
        Data</a>
    <?php if ($_SESSION['level'] == 'admin') { ?>
        <form action="cetak.php" method="GET" target="_blank" class="d-inline">
            <button type="submit" class="btn btn-success text-light"><i class="fa-solid fa-print"></i>Cetak Laporan</button>
            <label for="filter_waktu">Cetak untuk:</label>
            <select name="rentang_waktu" id="filter_waktu" class="form-select" style="width: auto; display: inline-block;">
                <option value="1">1 Hari</option>
                <option value="3">3 Hari</option>
                <option value="7">7 Hari</option>
                <option value="30">30 Hari</option>
            </select>
        </form>
    <?php } ?>
    <hr>
    <table class="table text-light">
        <thead>
            <tr>
                <th>No</th>
                <th>ID Pembelian</th>
                <th>Waktu Pembelian</th>
                <th>Pelanggan</th>
                <th>Total Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $nomor = 1;
            $query = mysqli_query($koneksi, "SELECT * FROM penjualan LEFT JOIN pelanggan ON pelanggan.id_pelanggan = penjualan.id_pelanggan ORDER BY tanggal_penjualan DESC");
            while ($data = mysqli_fetch_array($query)) {
                ?>
                <tr>
                    <th scope="row"><?php echo $nomor++; ?></th>
                    <td><?php echo $data['id_penjualan']; ?></td>
                    <td><?php echo $data['tanggal_penjualan']; ?></td>
                    <td><?php echo $data['nama_pelanggan']; ?></td>
                    <td><?php echo 'Rp ' . number_format($data['total_harga'], 0, ',', '.'); ?></td>
                    <td>
                        <a href="?page=pembelian_detail&&id=<?php echo $data['id_penjualan']; ?>"
                            class="btn btn-dark text-light">Detail</a>
                        <a href="?page=pembelian_hapus&&id=<?php echo $data['id_penjualan']; ?>"
                            class="btn btn-danger text-light"
                            onclick="return confirm('Apakah anda yakin akan menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>