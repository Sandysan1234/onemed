<?php
    require_once "function.php";
    $noid = $_GET["noid"];

    if (hapus($noid) > 0) {
        echo "<script>
            alert('data berhasil dihapus');
            document.location.href = 'index.php';
        </script>";

    }else{
        echo "<script>
            alert('data error dihapus');
            document.location.href = 'hapus.php';
        </script>";
    }
?>