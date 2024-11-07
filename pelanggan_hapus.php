<?php 
$id = $_GET['id'];
$query = mysqli_query($koneksi, "DELETE FROM pelanggan WHERE id_pelanggan =$id");
if ($query) {
    echo '<script>alert("Hapus data berhasil"); location.href="?page=pelanggan"</script>';
} else {
    echo '<script>alert("Hapus data gagal: ' . mysqli_error($koneksi) . '");</script>';
}
?>