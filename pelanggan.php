

<div class="container-fluid px-4 text-light">
    <h1 class="mt-4">Pelanggan</h1>
    <br>
    <br>
    <a href="?page=pelanggan_tambah" class="btn btn-dark text-light"><i class="fa-solid fa-person-circle-plus"></i>
        Tambah Pelanggan</a>
    <hr>
    <table class="table text-light">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pelanggan</th>
                <th>Alamat</th>
                <th>No Telepon</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $nomor = 1;
            $query = mysqli_query($koneksi, "SELECT * FROM pelanggan");
            while ($data = mysqli_fetch_array($query)) {
                ?>
                <tr>
                    <th scope="row"><?php echo $nomor++; ?></th>
                    <td><?php echo $data['nama_pelanggan']; ?></td>
                    <td><?php echo $data['alamat']; ?></td>
                    <td><?php echo $data['no_telepon']; ?></td>
                    <td>
                        <a href="?page=pelanggan_ubah&&id=<?php echo $data['id_pelanggan']; ?>"
                            class="btn btn-dark text-light">Ubah</a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>

</div>