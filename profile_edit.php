<?php
$id = $_SESSION['user']['id_user'];

// Proses update data jika ada data dikirim melalui POST
if (isset($_POST['nama'])) {
    $nama = $_POST['nama'];
    $username = $_POST['username'];

    // Cek apakah password diberikan
    if (!empty($_POST['password'])) {
        $password_hashed = "password=MD5('{$_POST['password']}')";
    } else {
        $password_hashed = "";
    }

    // Buat query update tanpa error koma berlebihan
    $query_string = "UPDATE user SET nama='$nama', username='$username'";
    if (!empty($password_hashed)) {
        $query_string .= ", $password_hashed";
    }
    $query_string .= " WHERE id_user = $id";

    // Eksekusi query dan cek hasil
    $query = mysqli_query($koneksi, $query_string);
    if ($query) {
        echo '<script>alert("Mohon untuk login kembali untuk melanjutkan"); location.href="logout.php";</script>';
    } else {
        echo '<script>alert("Failed to update data: ' . mysqli_error($koneksi) . '");</script>';
    }
    
}

// Query untuk mengambil data pengguna berdasarkan id_user dari sesi
$query = mysqli_query($koneksi, "SELECT * FROM user WHERE id_user= $id");
if (!$query || mysqli_num_rows($query) == 0) {
    echo "No data found for the given ID.";
    exit();
}
$data = mysqli_fetch_array($query);
?>


<div class="container-fluid px-4">
    <h1 class="mt-4">Edit User Data</h1>
    <a href="?page=profile" class="btn btn-dark" text-light>Back</a>
    <hr>
    <form method="post">
        <table class="table table-border text-light">
            <tr>
                <td width="200">Nama</td>
                <td width="1">:</td>
                <td><input class="form-control" value="<?php echo $data['nama']; ?>" type="text" name="nama"></td>
            </tr>
            <tr>
                <td width="200">Username</td>
                <td width="10">:</td>
                <td><input class="form-control" value="<?php echo $data['username']; ?>" type="text" name="username"></td>
            </tr>
            <tr>
                <td>Password</td>
                <td>:</td>
                <td><input class="form-control" type="password" name="password" placeholder="Kosongkan bila tidak diubah"></td>
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
