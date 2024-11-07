<?php
cek_level();

$id = $_GET['id'];

if (isset($_POST['nama'])) {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $level = $_POST['level'];

    $cek_username = mysqli_query($koneksi, "SELECT * FROM user WHERE (nama='$nama' OR username='$username') AND id_user != $id");
    if (mysqli_num_rows($cek_username) > 0) {
        echo '<script>alert("Username / Nama sudah digunakan, Mohon untuk diubah"); location.href="?page=user_ubah&id=' . $id . '"</script>';
        exit();
    }

    // Validasi dan update password jika diperlukan
    if (!empty($_POST['password_baru'])) {
        $password_baru = $_POST['password_baru'];
        $konfirmasi_password = $_POST['confirm_password'];

        // Pastikan password baru dan konfirmasi cocok
        if ($password_baru === $konfirmasi_password) {
            $password = "password=MD5('$password_baru'),";
        } else {
            echo '<script>alert("Password dan konfirmasi password tidak cocok"); location.href="?page=user_ubah&id=' . $id . '"</script>';
            exit();
        }
    } else {
        $password = ""; // Tidak ada update password
    }

    $query = mysqli_query($koneksi, "UPDATE user SET nama='$nama', username='$username', $password level='$level' WHERE id_user=$id");
    if ($query) {
        echo '<script>alert("Data berhasil diperbarui"); location.href="?page=user"</script>';
    } else {
        echo '<script>alert("Gagal memperbarui data: ' . mysqli_error($koneksi) . '");</script>';
    }
}

$query = mysqli_query($koneksi, "SELECT * FROM user WHERE id_user=$id");
if (!$query || mysqli_num_rows($query) == 0) {
    echo "Data tidak ditemukan untuk ID tersebut.";
    exit();
}
$data = mysqli_fetch_array($query);
?>



<div class="container-fluid px-4">
    <h1 class="mt-4">Ubah Akun <?php echo $data['nama']; ?></h1>
    <br>
    <br>
    <a href="?page=user" class="btn btn-dark text-light">Kembali</a>
    <hr>

    <form method="post">
        <table class="table table-border text-light">
            <tr>
                <td width="200">Nama</td>
                <td width="1">:</td>
                <td><input class="form-control" type="text" required name="nama" value="<?php echo $data['nama']; ?>"
                        placeholder="Masukan Nama"></td>
            </tr>
            <tr>
                <td width="200">Username</td>
                <td width="10">:</td>
                <td><input class="form-control" type="text" required name="username"
                        value="<?php echo $data['username']; ?>" placeholder="Masukan Username"></td>
            </tr>
            <tr>
                <td>Password</td>
                <td>:</td>
                <td>
                    <div class="position-relative">
                        <input class="form-control" type="password" name="password" id="password"
                            placeholder="Kosongkan jika tidak diganti">
                        <span class="position-absolute top-50 end-0 translate-middle-y pe-2"
                            onclick="togglePassword('password')" style="cursor: pointer;">
                            <i class="fa-solid fa-eye bg-black" id="togglePasswordIcon-password"></i>
                        </span>
                    </div>
                </td>
            </tr>
            <tr>
                <td>Konfirmasi Password</td>
                <td>:</td>
                <td>
                    <div class="position-relative">
                        <input class="form-control" type="password" name="confirm_password" id="confirm_password"
                            placeholder="Kosongkan jika tidak diganti">
                        <span class="position-absolute top-50 end-0 translate-middle-y pe-2"
                            onclick="togglePassword('confirm_password')" style="cursor: pointer;">
                            <i class="fa-solid fa-eye bg-black" id="togglePasswordIcon-confirm_password"></i>
                        </span>
                    </div>
                </td>
            </tr>
            <tr>
                <td>Level</td>
                <td>:</td>
                <td>
                    <select class="form-control form-select" name="level">
                        <option value="admin" <?php echo ($data['level'] == 'admin') ? 'selected' : ''; ?>>admin</option>
                        <option value="petugas" <?php echo ($data['level'] == 'petugas') ? 'selected' : ''; ?>>petugas
                        </option>
                    </select>
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>
                    <button type="submit" class="btn btn-dark text-light">Ubah</button>
                </td>
            </tr>

        </table>

    </form>
</div>

<script>
    function togglePassword(fieldId) {
        const field = document.getElementById(fieldId);
        const icon = document.getElementById(`togglePasswordIcon-${fieldId}`);
        if (field.type === "password") {
            field.type = "text";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        } else {
            field.type = "password";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        }
    }
</script>