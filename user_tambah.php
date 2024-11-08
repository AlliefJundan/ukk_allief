<?php

cek_level();

if (isset($_POST['nama'])) {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $level = $_POST['level'];

    if ($password !== $confirm_password) {
        echo '<script>alert("Password dan konfirmasi password tidak cocok"); location.href="?page=user_tambah"</script>';
    } else {
        $cek_username = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username' OR nama = '$nama'");
        if (mysqli_num_rows($cek_username) > 0) {
            echo '<script>alert("Username / Nama sudah digunakan, Mohon untuk diubah"); location.href="?page=user_tambah"</script>';
        } else {
            $query = mysqli_query($koneksi, "INSERT INTO user(nama,username,password,level) VALUES('$nama','$username', MD5('$password'), '$level')");
            if ($query) {
                echo '<script>alert("Tambah data berhasil"); location.href="?page=user"</script>';
            } else {
                echo '<script>alert("Tambah data gagal: ' . mysqli_error($koneksi) . '");</script>';
            }
        }
    }
}
$query = mysqli_query($koneksi, "SELECT * FROM user ");
$data = mysqli_fetch_assoc($query);
?>


<div class="container-fluid px-4">
    <h1 class="mt-4">Tambah Akun</h1>
    <br>
    <br>
    <a href="?page=user" class="btn btn-dark text-light">Kembali</a>
    <hr>

    <form method="post">
        <table class="table table-border text-light">
            <tr>
                <td width="200">Nama</td>
                <td width="1">:</td>
                <td><input class="form-control" type="text" required name="nama" placeholder="Masukan Nama"></td>
            </tr>
            <tr>
                <td width="200">Username</td>
                <td width="10">:</td>
                <td><input class="form-control" type="text" required name="username" placeholder="Masukan Username">
                </td>
            </tr>
            <tr>
                <td>Password</td>
                <td>:</td>
                <td>
                    <div class="position-relative">
                        <input class="form-control" type="password" name="password" id="password"
                            placeholder="Masukan password">
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
                            placeholder="Masukan konfirmasi password">
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
                    <button type="submit" class="btn btn-dark text-light">submit</button>
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