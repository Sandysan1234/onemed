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
    $role = 'user';

    mysqli_query($koneksi,"INSERT INTO tb_users (`full_name`, `email`, `password`, `role`) VALUES ('$full_name', '$email', '$password_hash', '$role')");

    return mysqli_affected_rows($koneksi);
}
// Buat token reset password
function buatResetToken($email) {
    global $koneksi;

    $email = mysqli_real_escape_string($koneksi, $email);
    $token = bin2hex(random_bytes(32));
    $expiry = date("Y-m-d H:i:s", strtotime("+1 hour"));

    $cek = mysqli_query($koneksi, "SELECT * FROM tb_users WHERE email = '$email'");
    if (mysqli_num_rows($cek) == 0) return false;

    mysqli_query($koneksi, "UPDATE tb_users SET reset_token = '$token', reset_expiry = '$expiry' WHERE email = '$email'");

    return $token;
}

// Ganti password berdasarkan token
function resetPassword($token, $newPassword) {
    global $koneksi;

    $token = mysqli_real_escape_string($koneksi, $token);
    $check = mysqli_query($koneksi, "SELECT * FROM tb_users WHERE reset_token = '$token' AND reset_expiry > NOW()");

    if (mysqli_num_rows($check) == 0) return false;

    $passwordHash = password_hash($newPassword, PASSWORD_DEFAULT);
    mysqli_query($koneksi, "UPDATE tb_users SET password = '$passwordHash', reset_token = NULL, reset_expiry = NULL WHERE reset_token = '$token'");

    return mysqli_affected_rows($koneksi);
}   

?>
