<?php

if (isset($_POST['nama_produk'])) {
    $nama = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    $query = mysqli_query($koneksi, "INSERT INTO produk(nama_produk,harga,stok) VALUES('$nama','$harga','$stok')");
    if ($query) {
        echo '<script>alert("Tambah data berhasil"); location.href="?page=produk"</script>';
    } else {
        echo '<script>alert("Tambah data gagal: ' . mysqli_error($koneksi) . '");</script>';
    }

}
?>

<div class="container-fluid px-4">
    <h1 class="mt-4"> Tambah produk</h1>
    <br>
    <br>
    <a href="?page=produk" class="btn btn-dark text-light">Kembali</a>
    <hr>

    <form method="post">
        <table class="table table-border text-light">
            <tr>
                <td width="200">Nama Produk</td>
                <td width="1">:</td>
                <td><input class="form-control" type="text" name="nama_produk"></td>
            </tr>
            <tr>
                <td width="200">Harga</td>
                <td width="10">:</td>
                <td><input class="form-control" type="number" name="harga"></td>
            </tr>
            <tr>
                <td>Stok</td>
                <td>:</td>
                <td><input class="form-control" type="number" step="0" name="stok"></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>
                    <button type="submit" class="btn btn-dark text-light">+ Tambah</button>
                </td>
            </tr>
        </table>
    </form>
</div>