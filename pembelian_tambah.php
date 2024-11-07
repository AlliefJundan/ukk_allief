<?php
if (isset($_POST["id_pelanggan"]) && $_POST["id_pelanggan"] != "") {

    $id_pelanggan = $_POST['id_pelanggan'];
    $produk = $_POST['produk'];
    $total = 0;

    $allZero = true;
    foreach ($produk as $val) {
        if ($val > 0) {
            $allZero = false;
            break;
        }
    }

    if ($allZero) {
        echo '<script>alert("Tidak bisa melanjutkan, jumlah semua produk adalah 0!");</script>';
    } else {
        $query = mysqli_query($koneksi, "INSERT INTO penjualan(tanggal_penjualan, id_pelanggan) VALUES(NOW(), '$id_pelanggan') ");
        $idTerakhir = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM penjualan ORDER BY id_penjualan DESC"));
        $id_penjualan = $idTerakhir['id_penjualan'];

        foreach ($produk as $key => $val) {
            if ($val > 0) {
                $pr = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk=$key"));
                $sub = $val * $pr['harga'];
                $total += $sub;

                $query = mysqli_query($koneksi, "INSERT INTO detail_penjualan(id_penjualan, id_produk, jumlah_produk, subtotal) VALUES('$id_penjualan', '$key', '$val', '$sub') ");

                $kurang = mysqli_query($koneksi, "UPDATE produk SET stok = stok - $val WHERE id_produk = $key");
            }
        }

    }

    $query = mysqli_query($koneksi, "UPDATE penjualan SET id_pelanggan = $id_pelanggan, tanggal_penjualan = NOW(), total_harga = $total WHERE id_penjualan = $id_penjualan");
    if ($query) {
        echo '<script>location.href="?page=pembelian"; alert("Tambah data berhasil");</script>';
    } else {
        echo '<script>alert("Tambah data gagal");</script>';
    }
}

?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Pembelian</h1>
    <br>
    <br>
    <a href="?page=pembelian" class="btn btn-dark text-light">Kembali</a>
    <hr>
    <form method="post" id="form-penjualan" onsubmit="return validateForm()">
        <table class="table table-border text-light">
            <tr>
                <td width="200">Nama Pelanggan</td>
                <td width="1">:</td>
                <td>
                    <select class="form-control form-select" name="id_pelanggan" id="id_pelanggan">
                        <option value="">Pilih pelanggan</option>
                        <?php
                        $p = mysqli_query($koneksi, 'SELECT * FROM pelanggan');
                        while ($pel = mysqli_fetch_array($p)) {
                            ?>
                            <option value="<?php echo $pel['id_pelanggan']; ?>"><?php echo $pel['nama_pelanggan']; ?>
                            </option>
                            <?php
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <?php
            $pro = mysqli_query($koneksi, 'SELECT * FROM produk');
            while ($produk = mysqli_fetch_array($pro)) {
                ?>
                <tr>
                <td><?php echo $produk['nama_produk'] . ' (Stok: ' . $produk['stok'] . ', Harga: Rp ' . number_format($produk['harga'], 0, ',', '.') . ')' ?></td>
                    <td>:</td>
                    <td>
                        <input class="form-control produk-input" <?php if ($produk['stok'] == 0) { ?> disabled <?php } ?>
                            type="number" step="1" min="0" value="0" max="<?php echo $produk['stok']; ?>"
                            name="produk[<?php echo $produk['id_produk']; ?>]" data-harga="<?php echo $produk['harga']; ?>"
                            onchange="hitungTotal()">
                    </td>
                </tr>
                <?php
            }
            ?>
            <tr>
                <td colspan="2"><strong>Total Harga:</strong></td>
                <td><input type="text" id="total-harga" class="form-control" value="0" readonly></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>
                    <button type="submit" class="btn btn-dark text-light">Submit</button>
                    <button type="reset" class="btn btn-danger text-light">Reset</button>
                </td>
            </tr>
        </table>
    </form>

    <script>
        function formatRupiah(angka) {
            let number_string = angka.toString().replace(/[^,\d]/g, ''),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // Tambahkan titik jika ada ribuan
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            return 'Rp ' + rupiah + (split[1] !== undefined ? ',' + split[1] : '');
        }

        function hitungTotal() {
            let total = 0;

            // Ambil semua input produk
            const produkInputs = document.querySelectorAll('.produk-input');

            // Loop melalui semua input produk
            produkInputs.forEach(function (input) {
                const jumlah = parseFloat(input.value);
                const harga = parseFloat(input.getAttribute('data-harga'));

                // Tambahkan subtotal untuk produk yang dipilih
                if (!isNaN(jumlah) && !isNaN(harga)) {
                    total += jumlah * harga;
                }
            });

            // Format total harga dengan format rupiah
            document.getElementById('total-harga').value = formatRupiah(total.toFixed(0));
        }

        function validateForm() {
            const pelangganSelect = document.getElementById('id_pelanggan');
            if (pelangganSelect.value === "") {
                alert("Mohon pilih pelanggan terlebih dahulu");
                return false;
            }
            return true;
        }
    </script>

</div>