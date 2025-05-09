<?php
require 'function.php';

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}
// hapus.php
require 'akses.php';
cek_multi_akses(['superadmin', 'admin']);



$noid = $_GET['noid'];

if (hapus($noid) > 0) {
    echo "<script>
        document.location.href = 'index.php';
    </script>";
} else {
    echo "<script>
        alert('Gagal menghapus data!');
        document.location.href = 'index.php';
    </script>";
}
?>  