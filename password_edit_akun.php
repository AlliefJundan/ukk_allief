
<?php


$id = $_SESSION['user']['id_user'];
    if (isset($_POST['password'])) {
        $password = $_POST['password'];
        $password_baru = $_POST['password_baru'];
        $confirm = $_POST['confirm_password'];

        $cek = mysqli_query($koneksi, "SELECT * FROM user WHERE id_user='$id' AND password=MD5('$password')");
        if (mysqli_num_rows($cek) > 0) {
            $row = mysqli_fetch_array($cek);
            if ($password_baru == $confirm) {
                if ($password_baru == $password) {
                    echo '<script>alert("Password yang baru tidak boleh sama dengan yang lama");</script>';
                } else {
                    $query = mysqli_query($koneksi, "UPDATE user SET password=MD5('$password_baru') WHERE id_user=$id");

                    if ($query) {
                        echo '<script>alert("Password berhasil diganti"); window.location.href="?page=profile";</script>';
                    } else {
                        echo '<script>alert("Password gagal diganti");</script>';
                    }
                }

            } else {
                echo '<script>alert("Password dan konfirmasi password tidak sama");</script>';
            }
        } else {
            echo '<script>alert("Password yang Anda masukan salah");</script>';
        }
    }

?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Ubah password Anda</h1>
    <br><br>
        <a href="?page=profile" class="btn btn-dark text-light">Kembali</a>
    <hr>
    <form method="post">
        <table class="table table-border text-light">
                <tr>
                    <td>Password saat ini</td>
                    <td>:</td>
                    <td>
                        <div class="position-relative">
                            <input class="form-control" type="password" name="password" id="password"
                                placeholder="Masukan password saat ini">
                            <span class="position-absolute top-50 end-0 translate-middle-y pe-2"
                                onclick="togglePassword('password')" style="cursor: pointer;">
                                <i class="fa-solid fa-eye bg-black" id="togglePasswordIcon-password"></i>
                            </span>
                        </div>
                    </td>
                    <td width="400"><h3>|</h3></td>
                </tr>
            <tr>
                <td width="200">Password baru</td>
                <td width="20">:</td>
                <td > 
                    <div class="position-relative">
                        <input class="form-control" type="password" name="password_baru" id="password_baru"
                            placeholder="Masukan password baru">
                        <span class="position-absolute top-50 end-0 translate-middle-y pe-2"
                            onclick="togglePassword('password_baru')" style="cursor: pointer;">
                            <i class="fa-solid fa-eye bg-black" id="togglePasswordIcon-password_baru"></i>
                        </span>
                    </div>
                </td>
                <td width="400"><h3>|</h3></td>
            </tr>
            <tr>
                <td>Konfirmasi password</td>
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
                <td width="400"><h3>|</h3></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>
                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                        <button type="submit" class="btn btn-dark w-100">Ubah</button>
                    </div>
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