<?php 
require "function.php";

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}
include "template/nav.php"; 

$kalibrasi_log = query("SELECT * FROM tb_kalibrasi_log");



?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Data Perubahan</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Tables</li>
                        </ol>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                            </div>
                            <div class="card-body">
                                <table class="table" id="datatablesSimple">
                                    <thead>
                                        <tr class="table table-primary">
                                            <th>No</th>
                                            <th>No. ID</th>
                                            <th>Kolom Yang Diubah</th>
                                            <th>Nilai Lama</th>
                                            <th>Nilai Baru</th>
                                            <th>Waktu Perubahan</th>
                                            <th>Diubah Oleh</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($kalibrasi_log as $kl_log ):?>
                                            <tr>
                                                <td><?=$kl_log['log_id'];?></td>
                                                <td><?=$kl_log['no_id'];?></td>
                                                <td><?=$kl_log['kolom_yang_diubah'];?></td>
                                                <td><?=$kl_log['nilai_lama'];?></td>
                                                <td><?=$kl_log['nilai_baru'];?></td>
                                                <td><?=$kl_log['waktu_perubahan'];?></td>
                                                <td><?=$kl_log['diubah_oleh'];?></td>
                                                <td><?=$kl_log['aksi'];?></td>
                                                
                                            </tr>
                                        <?php endforeach;?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
<?php include "template/footer.php";?>