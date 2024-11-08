
   <div class="container-fluid px-4 text-light">
        <h1 class="mt-4">Profil Anda</h1>
        <br>
        <br>
        <a href="?page=home" class="btn btn-dark text-light">Kembali</a>
        <hr>
        <table class="table table-border text-light">
            <tr>
                <td width="100">ID Akun</td>
                <td width="100">:</td>
                <td><?php echo $_SESSION['user']['id_user']; ?></td>
            </tr>
            <tr>
                <td width="100">Nama</td>
                <td width="100">:</td>
                <td><?php echo $_SESSION['user']['nama']; ?></td>

            </tr>
            <tr>
                <td width="100">Username</td>
                <td width="100">:</td>
                <td><?php echo $_SESSION['user']['username']; ?></td>
                </td>
            </tr>
            <tr>
                <td width="100">Level</td>
                <td width="100">:</td>
                <td><?php echo $_SESSION['user']['level']; ?></td>
    
                
            </tr>
        </table>
        <td>
        <td><a href="?page=password_edit_akun" class="btn btn-dark">Ubah Password</a></td>
        </tr>
    </div>
