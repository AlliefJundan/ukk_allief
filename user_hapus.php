<?php
$id = $_GET['id'];
$query = mysqli_query($koneksi, "DELETE FROM user WHERE id_user=$id");
if ($query) {
    echo '<script>alert("Hapus data berhasil"); location.href="?page=user"</script>';
} else {
    echo '<script>alert("Hapus data gagal: ' . mysqli_error($koneksi) . '");</script>';
}
?>