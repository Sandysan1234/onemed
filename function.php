<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "onemed_db";

$koneksi = mysqli_connect($servername, $username, $password,$database) or die(mysqli_error());



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

    $fields=[
        'Nama Alat Ukur' => htmlspecialchars($data['Nama_Alat_Ukur']),
        'No. ID' => htmlspecialchars($data['noid']),
        'merk' => htmlspecialchars($data['merk']),
        'Tanggal Kalibrasi' => htmlspecialchars($data['datebefore']),
        'Tanggal Re-Kalibrasi' => htmlspecialchars($data['dateafter']),
        'Poin Kalibrasi' => htmlspecialchars($data['Poin_Kalibrasi']),
        'Hasil Pengukuran' => htmlspecialchars($data['Hasil_Pengukuran']),
        'Koreksi' => htmlspecialchars($data['koreksi']),
        'U95' => htmlspecialchars($data['u95']),
        'Koreksi & U95 yang diijinkan' => htmlspecialchars($data['Koreksi_U95_yang_diijinkan']),
        'Status' => htmlspecialchars($data['status']),
        'pelaksana' => htmlspecialchars($data['pelaksana']),
        'no_dokumen' => htmlspecialchars($data['no_dokumen']),
        'lokasi' => htmlspecialchars($data['lokasi']),
        'divisi' => htmlspecialchars($data['divisi']),
    ];

    $columns = "`" . implode("`, `", array_keys($fields)) . "`";
    $values = "'" . implode("', '", array_values($fields)) . "'";
    
    $query = "INSERT INTO tb_alat ($columns) VALUES ($values)";
    mysqli_query($koneksi, $query);

    $user = $_SESSION['full_name'] ?? 'unknown';
    $noid = $fields['No. ID'];

    
    foreach ($fields as $col => $val) {
        if ($col !== 'No. ID') {
            logperubahan($noid, $col, null, $val, 'INSERT', $user);
        }
    }
    return mysqli_affected_rows($koneksi);
    
}

// Fungsi update data
// function update($data) {
//     global $koneksi;

//     $noid = htmlspecialchars($data['noid']);
//     $user = $_SESSION['full_name'] ?? 'unknown';

//     // Ambil data lama
//     $old = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM tb_alat WHERE `No. ID` = '$noid'"));

//     $nama = htmlspecialchars($data['Nama_Alat_Ukur']);
//     $merk = htmlspecialchars($data['merk']);
//     $datebefore = htmlspecialchars($data['datebefore']);
//     $dateafter = htmlspecialchars($data['dateafter']);
//     $poin = htmlspecialchars($data['Poin_Kalibrasi']);
//     $hasil = htmlspecialchars($data['Hasil_Pengukuran']);
//     $koreksi = htmlspecialchars($data['koreksi']);
//     $u95 = htmlspecialchars($data['u95']);
//     $koreksi_u95 = htmlspecialchars($data['Koreksi_U95_yang_diijinkan']);
//     $status = htmlspecialchars($data['Status']);

//     // Logging perubahan nyata saja
//     if ($old['Nama Alat Ukur'] !== $nama) logperubahan($noid, 'Nama Alat Ukur', $old['Nama Alat Ukur'], $nama, 'UPDATE', $user);
//     if ($old['Merk'] !== $merk) logperubahan($noid, 'Merk', $old['Merk'], $merk, 'UPDATE', $user);
//     if ($old['Tanggal Kalibrasi'] !== $datebefore) logperubahan($noid, 'Tanggal Kalibrasi', $old['Tanggal Kalibrasi'], $datebefore, 'UPDATE', $user);
//     if ($old['Tanggal Re-Kalibrasi'] !== $dateafter) logperubahan($noid, 'Tanggal Re-Kalibrasi', $old['Tanggal Re-Kalibrasi'], $dateafter, 'UPDATE', $user);
//     if ($old['Poin Kalibrasi'] !== $poin) logperubahan($noid, 'Poin Kalibrasi', $old['Poin Kalibrasi'], $poin, 'UPDATE', $user);
//     if ($old['Hasil Pengukuran'] !== $hasil) logperubahan($noid, 'Hasil Pengukuran', $old['Hasil Pengukuran'], $hasil, 'UPDATE', $user);
//     if ($old['Koreksi'] !== $koreksi) logperubahan($noid, 'Koreksi', $old['Koreksi'], $koreksi, 'UPDATE', $user);
//     if ($old['u95'] !== $u95) logperubahan($noid, 'u95', $old['u95'], $u95, 'UPDATE', $user);
//     if ($old['koreksi & u95 yang diijinkan'] !== $koreksi_u95) logperubahan($noid, 'koreksi & u95 yang diijinkan', $old['koreksi & u95 yang diijinkan'], $koreksi_u95, 'UPDATE', $user);
//     if ($old['Status'] !== $status) logperubahan($noid, 'Status', $old['Status'], $status, 'UPDATE', $user);
//     if ($old['pelaksana'] !== $pelaksana) logperubahan($noid, 'pelaksana', $old['pelaksana'], $pelaksana, 'UPDATE', $user);
//     if ($old['no_dokumen'] !== $no_dokumen) logperubahan($noid, 'no_dokumen', $old['no_dokumen'], $no_dokumen, 'UPDATE', $user);
//     if ($old['lokasi'] !== $lokasi) logperubahan($noid, 'lokasi', $old['lokasi'], $lokasi, 'UPDATE', $user);
//     if ($old['divisi'] !== $divisi) logperubahan($noid, 'divisi', $old['divisi'], $divisi, 'UPDATE', $user);
    
    

//     $query = "UPDATE tb_alat SET 
//         `Nama Alat Ukur` = '$nama',
//         `Merk` = '$merk',
//         `Tanggal Kalibrasi` = '$datebefore',
//         `Tanggal Re-Kalibrasi` = '$dateafter',
//         `Poin Kalibrasi` = '$poin',
//         `Hasil Pengukuran` = '$hasil',
//         `Koreksi` = '$koreksi',
//         `U95` = '$u95',
//         `Koreksi & U95 yang diijinkan` = '$koreksi_u95',
//         `Status` = '$status'
//         WHERE `No. ID` = '$noid'";

//     mysqli_query($koneksi, $query);

//     return mysqli_affected_rows($koneksi);
// }

function update($data) {
    global $koneksi;

    $noid = htmlspecialchars($data['noid']);
    $user = $_SESSION['full_name'] ?? 'unknown';

    // Ambil data lama dari database
    $old = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM tb_alat WHERE `No. ID` = '$noid'"));

    // Siapkan data baru dalam bentuk array associative
    $new = [
        'Nama Alat Ukur' => htmlspecialchars($data['Nama_Alat_Ukur']),
        'Merk' => htmlspecialchars($data['merk']),
        'Tanggal Kalibrasi' => htmlspecialchars($data['datebefore']),
        'Tanggal Re-Kalibrasi' => htmlspecialchars($data['dateafter']),
        'Poin Kalibrasi' => htmlspecialchars($data['Poin_Kalibrasi']),
        'Hasil Pengukuran' => htmlspecialchars($data['Hasil_Pengukuran']),
        'Koreksi' => htmlspecialchars($data['koreksi']),
        'U95' => htmlspecialchars($data['u95']),
        'Koreksi & U95 yang diijinkan' => htmlspecialchars($data['Koreksi_U95_yang_diijinkan']),
        'Status' => htmlspecialchars($data['Status']),
        'pelaksana' => htmlspecialchars($data['pelaksana']),
        'no_dokumen' => htmlspecialchars($data['no_dokumen']),
        'lokasi' => htmlspecialchars($data['lokasi']),
        'divisi' => htmlspecialchars($data['divisi'])
    ];

    // Logging perubahan jika berbeda
    foreach ($new as $key => $val) {
        if (isset($old[$key]) && $old[$key] !== $val) {
            logperubahan($noid, $key, $old[$key], $val, 'UPDATE', $user);
        }
    }

    // Buat query update dinamis
    $update_parts = [];
    foreach ($new as $key => $val) {
        $update_parts[] = "`$key` = '$val'";
    }
    $set_clause = implode(", ", $update_parts);

    $query = "UPDATE tb_alat SET $set_clause WHERE `No. ID` = '$noid'";
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
