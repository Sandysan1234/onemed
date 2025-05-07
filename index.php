<?php
require_once "function.php";

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}

include "template/nav.php";

$kalibrasi = query("SELECT * FROM tb_alat WHERE is_deleted = 0");
$total_alat = count($kalibrasi);
$no = 1;
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
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <h5>Total Alat :</h5>
                            <h5><?= $total_alat; ?></h5>
                        </div>
                    </div>
                </div>
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
                            $diff = round((strtotime($tanggal_kalibrasi) - strtotime($today)) / (60 * 60 * 24));
                            $tgl_format = date('d-m-Y H:i', strtotime($tanggal_kalibrasi));
                            ?>
                            <?php if ($tanggal_kalibrasi <= $today): ?>
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
                                        <p><strong><i class="bi bi-alarm-fill"></i> 30 Hari Lagi!</strong></p>
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
                <div class="card-header">
                <i class="fas fa-table me-1"></i>
                </div>
                <div class="card-body">
                    <?php foreach($kalibrasi as $kl): ?>
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
                                <th>No. Dokumen</th>
                                <th>Lokasi</th>
                                <th>Divisi</th>
                                <th>Handle</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($kalibrasi as $kl): ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $kl['Nama Alat Ukur']; ?></td>
                                    <td><?= $kl['No. ID']; ?></td>
                                    <td><?= $kl['Merk']; ?></td>
                                    <td><?= date ('d-m-Y H:i:s',strtotime($kl['Tanggal Kalibrasi'])); ?></td>
                                    <td><?= date ('d-m-Y H:i:s',strtotime($kl['Tanggal Re-Kalibrasi'])); ?></td>
                                    <td><?= $kl['Poin Kalibrasi']; ?></td>
                                    <td><?= $kl['Hasil Pengukuran']; ?></td>
                                    <td><?= $kl['Koreksi']; ?></td>
                                    <td><?= $kl['U95']; ?></td>
                                    <td><?= $kl['Koreksi & U95 yang diijinkan']; ?></td>
                                    <td><?= $kl['Status']; ?></td>
                                    <td><?= $kl['pelaksana']; ?></td>
                                    <td><?= $kl['no_dokumen']; ?></td>
                                    <td><?= $kl['lokasi']; ?></td>
                                    <td><?= $kl['divisi']; ?></td>
                                    <td>
                                        <a class="btn btn-warning mb-1 text-white" href="update.php?noid=<?= $kl['No. ID']; ?>"><i class="bi bi-pencil-square"></i></a>
                                        <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal<?= $kl['No. ID']; ?>"><i class="bi bi-trash3"></i></a>
                                    </td>
                                </tr>
                                <div class="modal fade" id="hapusModal<?= $kl['No. ID']; ?>" tabindex="-1" aria-labelledby="modalLabel<?= $kl['No. ID']; ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalLabel<?= $kl['No. ID']; ?>">Konfirmasi Hapus</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah kamu yakin ingin menghapus data alat <strong><?= $kl['Nama Alat Ukur']; ?></strong> (ID: <?= $kl['No. ID']; ?>)?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <a class="btn btn-danger" href="hapus.php?noid=<?= $kl['No. ID']; ?>">Ya, Hapus</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
<?php include "template/footer.php";?>
