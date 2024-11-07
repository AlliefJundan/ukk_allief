<?php
cek_level();
?>



<div class="container-fluid px-4">
    <h1 class="mt-4">Daftar Akun</h1>
    <br>
    <br>
    <a href="?page=user_tambah" class="btn btn-dark text-light"><i class="fa-solid fa-user-plus"></i> Tambah Akun</a>
    <hr>
    <table class="table text-light">
        <thead>
            <tr>
                <th>No</th>
                <th>ID User</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Level</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $nomor = 1;
            $query = mysqli_query($koneksi, "SELECT * FROM user");
            while ($data = mysqli_fetch_array($query)) {
                ?>
                <tr>
                    <td><?php echo $nomor++; ?></td>
                    <td><?php echo $data['id_user']; ?></td>
                    <td><?php echo $data['nama']; ?></td>
                    <td><?php echo $data['username']; ?></td>
                    <td><?php echo $data['level']; ?></td>
                    <?php if ($_SESSION['user']['id_user'] != $data['id_user']) { ?>
                        <td>
                            <a href="?page=user_ubah&&id=<?php echo $data['id_user']; ?>"
                                class="btn btn-dark text-light">Ubah</a>
                            <a href="?page=user_hapus&&id=<?php echo $data['id_user']; ?>" class="btn btn-danger text-light"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">Hapus</a>
                        </td>
                    <?php } ?>
                </tr>
                <?php
            }

            ?>
        </tbody>
    </table>

</div>