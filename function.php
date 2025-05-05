<?php
session_start();
$koneksi = mysqli_connect('localhost','root','','onemed_db');

if (!$koneksi) {
    die('Koneksi gagal: ' . mysqli_connect_error());
}

// Fungsi query umum
function query($query) {
    global $koneksi;
    $result = mysqli_query($koneksi, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

// Fungsi logging perubahan
function logperubahan($no_id, $kolom, $lama, $baru, $aksi, $user = 'unknown') {
    global $koneksi;

    $no_id = mysqli_real_escape_string($koneksi, $no_id);
    $kolom = mysqli_real_escape_string($koneksi, $kolom);
    $lama = mysqli_real_escape_string($koneksi, $lama);
    $baru = mysqli_real_escape_string($koneksi, $baru);
    $aksi = mysqli_real_escape_string($koneksi, $aksi);
    $user = mysqli_real_escape_string($koneksi, $user);

    $query = "INSERT INTO tb_kalibrasi_log 
        (no_id, kolom_yang_diubah, nilai_lama, nilai_baru, waktu_perubahan, diubah_oleh, aksi)
        VALUES 
        ('$no_id', '$kolom', '$lama', '$baru', NOW(), '$user', '$aksi')";

    mysqli_query($koneksi, $query);
}

// Fungsi tambah data alat ukur
function tambah($data) {
    global $koneksi;

    $nama = htmlspecialchars($data['Nama_Alat_Ukur']);
    $noid = htmlspecialchars($data['noid']);
    $merk = htmlspecialchars($data['merk']);
    $datebefore = htmlspecialchars($data['datebefore']);
    $dateafter = htmlspecialchars($data['dateafter']);
    $poin = htmlspecialchars($data['Poin_Kalibrasi']);
    $hasil = htmlspecialchars($data['Hasil_Pengukuran']);
    $koreksi = htmlspecialchars($data['koreksi']);
    $u95 = htmlspecialchars($data['u95']);
    $koreksi_u95 = htmlspecialchars($data['Koreksi_U95_yang_diijinkan']);
    $status = htmlspecialchars($data['Status']);
    $pelaksana = htmlspecialchars($data['pelaksana']);
    $no_dokumen = htmlspecialchars($data['no_dokumen']);
    $lokasi = htmlspecialchars($data['lokasi']);
    $divisi = htmlspecialchars($data['divisi']);

    $query = "INSERT INTO tb_alat 
        (`Nama Alat Ukur`, `No. ID`, `Merk`, `Tanggal Kalibrasi`, `Tanggal Re-Kalibrasi`, 
        `Poin Kalibrasi`, `Hasil Pengukuran`, `Koreksi`, `U95`, `Koreksi & U95 yang diijinkan`, 
        `Status`, `pelaksana`, `no_dokumen`, `lokasi`, `divisi`)
        VALUES 
        ('$nama', '$noid', '$merk', '$datebefore', '$dateafter', '$poin', '$hasil', 
        '$koreksi', '$u95', '$koreksi_u95', '$status', '$pelaksana', '$no_dokumen', '$lokasi', '$divisi')";

    mysqli_query($koneksi, $query);

    $user = $_SESSION['full_name'] ?? 'unknown';

    // Log semua field utama
    logperubahan($noid, 'Nama Alat Ukur', null, $nama, 'INSERT', $user);
    logperubahan($noid, 'Merk', null, $merk, 'INSERT', $user);
    logperubahan($noid, 'Tanggal Kalibrasi', null, $datebefore, 'INSERT', $user);
    logperubahan($noid, 'Tanggal Re-Kalibrasi', null, $dateafter, 'INSERT', $user);
    logperubahan($noid, 'Status', null, $status, 'INSERT', $user);

    return mysqli_affected_rows($koneksi);
}

// Fungsi update data
function update($data) {
    global $koneksi;

    $noid = htmlspecialchars($data['noid']);
    $user = $_SESSION['full_name'] ?? 'unknown';

    // Ambil data lama
    $old = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM tb_alat WHERE `No. ID` = '$noid'"));

    $nama = htmlspecialchars($data['Nama_Alat_Ukur']);
    $merk = htmlspecialchars($data['merk']);
    $datebefore = htmlspecialchars($data['datebefore']);
    $dateafter = htmlspecialchars($data['dateafter']);
    $poin = htmlspecialchars($data['Poin_Kalibrasi']);
    $hasil = htmlspecialchars($data['Hasil_Pengukuran']);
    $koreksi = htmlspecialchars($data['koreksi']);
    $u95 = htmlspecialchars($data['u95']);
    $koreksi_u95 = htmlspecialchars($data['Koreksi_U95_yang_diijinkan']);
    $status = htmlspecialchars($data['Status']);

    // Logging perubahan nyata saja
    if ($old['Nama Alat Ukur'] !== $nama) logperubahan($noid, 'Nama Alat Ukur', $old['Nama Alat Ukur'], $nama, 'UPDATE', $user);
    if ($old['Merk'] !== $merk) logperubahan($noid, 'Merk', $old['Merk'], $merk, 'UPDATE', $user);
    if ($old['Tanggal Kalibrasi'] !== $datebefore) logperubahan($noid, 'Tanggal Kalibrasi', $old['Tanggal Kalibrasi'], $datebefore, 'UPDATE', $user);
    if ($old['Tanggal Re-Kalibrasi'] !== $dateafter) logperubahan($noid, 'Tanggal Re-Kalibrasi', $old['Tanggal Re-Kalibrasi'], $dateafter, 'UPDATE', $user);
    if ($old['Status'] !== $status) logperubahan($noid, 'Status', $old['Status'], $status, 'UPDATE', $user);

    $query = "UPDATE tb_alat SET 
        `Nama Alat Ukur` = '$nama',
        `Merk` = '$merk',
        `Tanggal Kalibrasi` = '$datebefore',
        `Tanggal Re-Kalibrasi` = '$dateafter',
        `Poin Kalibrasi` = '$poin',
        `Hasil Pengukuran` = '$hasil',
        `Koreksi` = '$koreksi',
        `U95` = '$u95',
        `Koreksi & U95 yang diijinkan` = '$koreksi_u95',
        `Status` = '$status'
        WHERE `No. ID` = '$noid'";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

// Fungsi hapus data (soft delete disarankan)
function hapus($noid) {
    global $koneksi;
    $user = $_SESSION['full_name'] ?? 'unknown';

    // Soft delete: update is_deleted = 1 (disarankan buat kolom ini)
    mysqli_query($koneksi, "UPDATE tb_alat SET is_deleted = 1 WHERE `No. ID` = '$noid'");
    logperubahan($noid, 'is_deleted', 0, 1, 'DELETE', $user);

    return mysqli_affected_rows($koneksi);
}

// Fungsi register user
function register($data) {
    global $koneksi;

    $first_name = htmlspecialchars($data['first_name']);
    $last_name = htmlspecialchars($data['last_name']);
    $email = htmlspecialchars($data['email']);
    $password = htmlspecialchars($data['password']);
    $password2 = htmlspecialchars($data['password2']);

    // Cek apakah email sudah ada
    $query = "SELECT email FROM tb_users WHERE email = '$email'";
    $k = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($k) > 0 || $password !== $password2) {
        return false;
    }

    // Hash password
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $full_name = $first_name . ' ' . $last_name;

    mysqli_query($koneksi, "INSERT INTO tb_users (`full_name`, `email`, `password`) 
        VALUES ('$full_name', '$email', '$password_hash')");

    return mysqli_affected_rows($koneksi);
}
?>
