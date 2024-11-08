
<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>
   <br>
   <br>

   
    </ol>
    <div class="row">
        <div class="col-xl-5 col-md-6">
            <div class="card bg-dark text-white mb-4">
                <div class="card-body"><?php echo mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM produk")) ?>
                    Total Produk</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="?page=produk">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-5 col-md-6">
            <div class="card bg-info text-white mb-4">
                <div class="card-body"><?php echo mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM pelanggan")) ?>
                    Total Pelanggan</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="?page=pelanggan">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
    <div class="col-xl-5 col-md-6">
        <div class="card bg-success text-white mb-4">
            <div class="card-body"><?php echo mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM penjualan")) ?> Total
                Penjualan</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="?page=pembelian">View Details</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <?php if ($_SESSION['level'] == 'admin') { ?>
        <div class="col-xl-5 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body"><?php echo mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM user")) ?> Total User
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="?page=user">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    <?php } ?>

</div>

</div>