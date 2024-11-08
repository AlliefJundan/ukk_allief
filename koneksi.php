<?php 
session_start();    
$koneksi = mysqli_connect("localhost","root","","kasir");

function cek_level(){
    if (!isset($_SESSION['level']) || $_SESSION['level'] != 'admin') {
        header('location:?page=home');
        exit();
    }
}

function cek_login() {
    if (!isset($_SESSION['user'])) {
        header(header: 'location:login.php');
    
    }
}
?>