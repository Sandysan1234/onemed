<?php
require_once "function.php";

if (!isset($_SESSION['email'])) {
    header("Location:login.php");
    exit;
}else {
    # code...
    echo"login dulu bro";
}
include "template/nav.php";
$kalibrasi =query("SELECT * FROM tb_alat");
$total_alat = count($kalibrasi);
$no=1;



?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body d-flex align-items-center justify-content-between"><h5>Total Alat :</h5>
                                        <h5><?= $total_alat; ?></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Success Card</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">Warning Card</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">Danger Card</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-xl-3 col-md-6 m-2">
                                <button type="button" class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-bell-fill"  style="font-size: 1.8rem; "></i><span class="badge badge-counter" style="font-size: 1.2rem;">3+</span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="#">Separated link</a></li>
                                </ul>
                            </div> -->
                        </div>
                        <div class="container-pengingat"> 
                            <h3>Pengingat Kalibrasi</h3>

                            <div class="alerts py-3">
                                <div class="row">
                                <?php foreach ($kalibrasi as $kl): ?>
                                    
                                    <?php
                                    $today = date('Y-m-d');
                                    $tanggal_kalibrasi = $kl['Tanggal Kalibrasi'];

                                    $id = $kl['No. ID'];
                                    $nama = $kl['Nama Alat Ukur'];

                                    // Hitung countdown
                                    $diff = round((strtotime($tanggal_kalibrasi) - strtotime($today)) / (60 * 60 * 24));
                                    $tgl_format = date('d-m-Y H:i', strtotime($tanggal_kalibrasi));

                                    if ($tanggal_kalibrasi <= $today):
                                    ?>
                                        <div class="col-md-3">
                                            <div class="alert alert-danger limit-text">
                                                <p><strong><i class="bi bi-exclamation-triangle-fill"></i> Waktunya Re-Kalibrasi!</strong></p>
                                                <p class="fs-5 m-0 p-0">ID: <?= $id ?> | Alat: <?= $nama ?></p>
                                                <p class="fs-5 m-0 p-0">Tanggal: <?= $tgl_format ?></p>
                                            </div>
                                        </div>
                                    <?php elseif ($diff <= 7): ?>
                                        <div class="col-md-3">
                                            <div class="alert alert-primary limit-text">
                                                <p><strong><i class="bi bi-clock-fill"></i> <?=$diff?> Hari Lagi!</strong></p>
                                                <p class="fs-5 m-0 p-0">ID: <?= $id ?> | Alat: <?= $nama ?></p>
                                                <p class="fs-5 m-0 p-0">Tanggal: <?= $tgl_format ?></p>
                                            </div>
                                        </div>
                                    <?php elseif ($diff <= 21): ?>
                                        <div class="col-md-3">
                                            <div class="alert alert-info limit-text">
                                                <p><strong><i class="bi bi-info-circle-fill"></i> <?=$diff?> Hari Lagi!</strong></p>
                                                <p class="fs-5 m-0 p-0">ID: <?= $id ?> | Alat: <?= $nama ?></p>
                                                <p class="fs-5 m-0 p-0">Tanggal: <?= $tgl_format ?></p>
                                            </div>
                                        </div>
                                    <?php elseif ($diff <= 30): ?>
                                        <div class="col-md-3">
                                                <div class="alert alert-warning limit-text">
                                                    <p><strong><i class="bi bi-alarm-fill "></i> 30 Hari Lagi!</strong></p>
                                                    <p class="fs-5 m-0 p-0">ID: <?= $id ?> | Alat: <?= $nama ?></p>
                                                    <p class="fs-5 m-0 p-0">Tanggal: <?= $tgl_format ?></p>
                                                </div>
                                            </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <a href="tambah.php" class="btn btn-success mb-2">Tambahkan Alatmu</a>
                        <div class="card mb-4">
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>No ID</th>
                                            <th>Merk/Type/ No. Seri</th>
                                            <th>Tanggal Kalibrasi</th>
                                            <th>Tanggal Re Kalibrasi</th>
                                            <th>Poin Kalibrasi</th>
                                            <th>Hasil Pengukuran</th>
                                            <th>Koreksi</th>
                                            <th>U95</th>
                                            <th>Koreksi & U95 yang diijinkan</th>
                                            <th>Status</th>
                                            <th>Pelaksana</th>
                                            <th>No. Dokumen </th>
                                            <th>lokasi</th>
                                            <th>Divisi</th>
                                            <th>Handle</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>No ID</th>
                                            <th>Merk/Type/ No. Seri</th>
                                            <th>Tanggal Kalibrasi</th>
                                            <th>Tanggal Re Kalibrasi</th>
                                            <th>Poin Kalibrasi</th>
                                            <th>Hasil Pengukuran</th>
                                            <th>Koreksi</th>
                                            <th>U95</th>
                                            <th>Koreksi & U95 yang diijinkan</th>
                                            <th>Status</th>
                                            <th>Pelaksana</th>
                                            <th>No. Dokumen </th>
                                            <th>lokasi</th>
                                            <th>Divisi</th>
                                            <th>Handle</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php foreach($kalibrasi as $kl):?>
                                        <tr class="">
                                            <td><?=$no;?></td>
                                            <td><?=$kl['Nama Alat Ukur'];?></td>
                                            <td><?=$kl['No. ID'];?></td>
                                            <td><?=$kl['Merk'];?></td>
                                            <td><?=$kl['Tanggal Kalibrasi'];?></td>
                                            <td><?=$kl['Tanggal Re-Kalibrasi'];?></td>
                                            <td><?=$kl['Poin Kalibrasi'];?></td>
                                            <td><?=$kl['Hasil Pengukuran'];?></td>
                                            <td><?=$kl['Koreksi'];?></td>
                                            <td><?=$kl['U95'];?></td>
                                            <td><?=$kl['Koreksi & U95 yang diijinkan'];?></td>
                                            <td><?=$kl['Status'];?></td>
                                            <td><?=$kl['pelaksana'];?></td>
                                            <td><?=$kl['no_dokumen'];?></td>
                                            <td><?=$kl['lokasi'];?></td>
                                            <td><?=$kl['divisi'];?></td>
                                            <td>
                                                
                                                <a class="btn btn-primary mb-1" href="update.php?noid=<?=$kl["No. ID"]?>"><i class="bi bi-eye"></i>                                                </a>
                                                <a class="btn btn-warning mb-1 text-white" href="update.php?noid=<?=$kl["No. ID"]?>"><i class="bi bi-pencil-square"></i>                                                </a>
                                                <a class="btn btn-danger" data-bs-toggle="modal"data-bs-target="#hapusModal<?= $kl['No. ID']; ?>"><i class="bi bi-trash3"></i>                                                </a>
                                                
                                            </td>
                                        </tr>
                                        <!-- Modal -->
                                        <div class="modal fade"  id="hapusModal<?= $kl['No. ID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                            <a class="btn btn-danger" href="hapus.php?noid=<?=$kl["No. ID"];?>">Hapus</a>
                                                ...
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary">Save changes</button>
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                        <?php $no++; endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; JMI 2025</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; JMI 2025</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script>
            function confirmlogout() {
                Swal.fire({
                    title: "Keluar dari akun?",
                    text: "Anda yakin ingin logout?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, Logout"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "logout.php";
                    }
                });

                // cegah href langsung dijalankan
                return false;
            }
        </script> 
        
        <!-- switch alert -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>

