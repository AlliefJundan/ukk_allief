<div class="container-fluid px-4">
    <h1 class="mt-4">Produk</h1>
    <br>
    <br>
    <a href="?page=produk_tambah" class="btn btn-dark text-light">+<i class="fa-solid fa-box-open"></i> Tambah Barang</a>
    <hr>
    <table class="table text-light">
        <thead>
            <tr>
                <th>No</th>
                <th>ID Produk</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $nomor = 1;
            $query = mysqli_query($koneksi, "SELECT * FROM produk");
            while ($data = mysqli_fetch_array($query)) {
                ?>
                <tr>
                    <th scope="row"><?php echo $nomor++; ?></th>
                    <td><?php echo  $data['id_produk'];?></td>
                    <td><?php echo $data['nama_produk']; ?></td>
                    <td><?php echo 'Rp ' . number_format($data['harga'], 0, ',', '.'); ?></td>
                    <td><?php echo $data['stok']; ?></td>
                    <td>
                        <a href="?page=produk_ubah&&id=<?php echo $data['id_produk']; ?>"
                            class="btn btn-dark text-light">Ubah</a>
                        <a href="?page=produk_hapus&&id=<?php echo $data['id_produk']; ?>" class="btn btn-danger text-light"
                            onclick="return confirm('Apakah Anda yakin ingin menghapus barang ini?')">Hapus</a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>

</div>