<?php

if (isset($_POST['nama_pelanggan'])) {
    $nama = $_POST['nama_pelanggan'];
    $alamat = $_POST['alamat'];
    $no_telepon = $_POST['no_telepon'];

    // Menggabungkan 62 dan nomor yang diinput
    $no_telepon_full = '62' . $no_telepon;

    $query = mysqli_query($koneksi, "INSERT INTO pelanggan(nama_pelanggan,alamat,no_telepon) VALUES('$nama','$alamat','$no_telepon_full')");
    if ($query) {
        echo '<script>alert("Tambah data berhasil"); location.href="?page=pelanggan"</script>';
    } else {
        echo '<script>alert("Tambah data gagal: ' . mysqli_error($koneksi) . '");</script>';
    }
}
?>

<div class="container-fluid px-4 text-light">
    <h1 class="mt-4">Pelanggan</h1>
    <br>
    <br>
    <a href="?page=pelanggan" class="btn btn-dark">Kembali</a>
    <hr>

    <form method="post">
        <table class="table table-border text-light">
            <tr>
                <td width="200">Nama Pelanggan</td>
                <td width="1">:</td>
                <td><input class="form-control" type="text" required name="nama_pelanggan"></td>
            </tr>
            <tr>
                <td width="200">Alamat</td>
                <td width="10">:</td>
                <td><textarea name="alamat" rows="5" required class="form-control"></textarea></td>
            </tr>
            <tr>
                <td>No. Telepon</td>
                <td>:</td>
                <td>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">+62</span>
                        <input class="form-control" type="number" required name="no_telepon"
                            placeholder="Masukkan No Telepon" min="0" pattern="[0-9]*">
                    </div>
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>
                    <button type="submit" class="btn btn-dark text-light">+ Tambah</button>
                    <button type="reset" class="btn btn-danger text-light">Reset</button>
                </td>
            </tr>
        </table>
    </form>
</div>