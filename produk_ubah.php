<?php

$id = $_GET['id'];
if (isset($_POST['nama_produk'])) {
    $nama = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    $query = mysqli_query($koneksi, "UPDATE produk SET nama_produk='$nama', harga='$harga', stok='$stok' WHERE id_produk=$id");
    if ($query) {
        echo '<script>alert("Tambah data berhasil"); location.href="?page=produk"</script>';
    } else {
        echo '<script>alert("Tambah data gagal: ' . mysqli_error($koneksi) . '");</script>';
    }

}
$query = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk=$id");
$data = mysqli_fetch_array($query);
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Produk</h1>
    <br>
    <br>
    <a href="?page=produk" class="btn btn-dark text-light">Kembali</a>
    <hr>

    <form method="post">
        <table class="table table-border text-light">
            <tr>
                <td width="200">Nama Produk</td>
                <td width="1">:</td>
                <td><input class="form-control" value="<?php echo $data['nama_produk']; ?>" type="text"
                        name="nama_produk"></td>
                </td>
                <td width="400">
                    <h3>|</h3>
                </td>
            </tr>
            <tr>
                <td width="200">Harga</td>
                <td width="10">:</td>
                <td><input class="form-control" value="<?php echo $data['harga']; ?>" type="number" name="harga"></td>
                </td>
                <td width="400">
                    <h3>|</h3>
                </td>
            </tr>
            <tr>
                <td>Stok</td>
                <td>:</td>
                <td><input class="form-control" type="number" step="0" value="<?php echo $data['stok']; ?>" name="stok">
                </td>
                </td>
                <td width="400">
                    <h3>|</h3>
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>
                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                        <button type="submit" class="btn btn-dark w-100">Ubah</a>
                    </div>
                </td>
            </tr>

        </table>

    </form>
</div>