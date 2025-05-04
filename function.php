<?php
session_start();
$koneksi = mysqli_connect('localhost','root','','onemed_db');

if (!$koneksi) {
    die('Koneksi gagal: ' . mysqli_connect_error());
}

// if (isset($_POST['login'])){

//     $email = $_POST['email'];
//     $password = $_POST['password'];

//     $check = mysqli_query($koneksi, "SELECT * FROM tb_users WHERE email ='$email'");
//     $data = mysqli_fetch_assoc($check);

//     if ($data && password_verify($password, $data['password'])) {
//         $_SESSION['login'] = true;
//         header('location:index.php');
//     } else {
//         echo "<script>
//             Swal.fire({
//                 title: 'email atau password!',
//                 icon: 'error',
//                 confirmButtonText: 'OK'
//             }).then((result) => {
//                 if (result.isConfirmed) {
//                     window.location.href = 'login.php';
//                 }
//             });
//         </script>";
//     }

// }

function query($query){
    global $koneksi;

    $result= mysqli_query($koneksi, $query);
    $tempatKosong =[]; 
    while($row= mysqli_fetch_assoc($result)){
        $tempatKosong[]=$row;
    }
    return $tempatKosong;
}

// menambahkan data
function tambah($data){
    global $koneksi;

    $nama =htmlspecialchars($data["Nama_Alat_Ukur"]);
    $noid =htmlspecialchars($data["noid"]);
    $merk =htmlspecialchars($data["merk"]);
    $datebefore = htmlspecialchars($data["datebefore"]);  // Menambahkan detik
    $dateafter = htmlspecialchars($data["dateafter"]);  // Menambahkan detik
    $poin =htmlspecialchars($data["Poin_Kalibrasi"]);
    $hasil =htmlspecialchars($data["Hasil_Pengukuran"]);
    $koreksi =htmlspecialchars($data["koreksi"]);
    $u95 =htmlspecialchars($data["u95"]);
    $koreksi_u95 =htmlspecialchars($data["Koreksi_U95_yang_diijinkan"]);
    $status =htmlspecialchars($data["Status"]);
    $pelaksana =htmlspecialchars($data["pelaksana"]);
    $no_dokumen =htmlspecialchars($data["no_dokumen"]);
    $lokasi =htmlspecialchars($data["lokasi"]);
    $divisi =htmlspecialchars($data["divisi"]);
 

    $query = "INSERT INTO tb_kal (`Nama Alat Ukur`, `No. ID`, `Merk`, `Tanggal Kalibrasi`, `Tanggal Re-Kalibrasi`, `Poin Kalibrasi`, `Hasil Pengukuran`, `Koreksi`, `U95`, `Koreksi & U95 yang diijinkan`, `Status`, `pelaksana`, `no_dokumen`, `lokasi`, `divisi`)
    VALUES
    ('$nama', '$noid', '$merk', '$datebefore', '$dateafter', '$poin', '$hasil', '$koreksi', '$u95', '$koreksi_u95', '$status','$pelaksana','$no_dokumen', '$lokasi', '$divisi')";


    mysqli_query($koneksi,$query);
    
    return mysqli_affected_rows($koneksi);
}

function update($data){
    global $koneksi;


    $nama =htmlspecialchars($data["Nama_Alat_Ukur"]);
    $noid =htmlspecialchars($data["noid"]);
    $merk =htmlspecialchars($data["merk"]);
    $datebefore = htmlspecialchars($data["datebefore"]);  // Menambahkan detik
    $dateafter = htmlspecialchars($data["dateafter"]);  // Menambahkan detik
    $poin =htmlspecialchars($data["Poin_Kalibrasi"]);
    $hasil =htmlspecialchars($data["Hasil_Pengukuran"]);
    $koreksi =htmlspecialchars($data["koreksi"]);
    $u95 =htmlspecialchars($data["u95"]);
    $koreksi_u95 =htmlspecialchars($data["Koreksi_U95_yang_diijinkan"]);
    $status =htmlspecialchars($data["Status"]);


    $query = "UPDATE tb_kal SET
    `Nama Alat Ukur` = '$nama',
    `No. ID` = '$noid',
    `Merk` = '$merk',
    `Tanggal Kalibrasi`='$datebefore',
    `Tanggal Re-Kalibrasi` ='$dateafter',
    `Poin Kalibrasi` = '$poin',
    `Hasil Pengukuran` = '$hasil',
    `Koreksi` = '$koreksi',
    `U95` = '$u95',
    `Koreksi & U95 yang diijinkan` ='$koreksi_u95',
    `Status` = '$status' WHERE `No. ID` = '$noid'";
    
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);

}


function hapus($data){
    global $koneksi;

    mysqli_query($koneksi, "DELETE FROM tb_kal  WHERE `No. ID` = '$data'");
    return mysqli_affected_rows($koneksi);
}
// function register($data){
//     global $koneksi;
    
//    $first_name = htmlspecialchars($data['first_name']);
//     $last_name = htmlspecialchars($data['last_name']);
//     $email = htmlspecialchars($data['email']);
//     $password = htmlspecialchars($data['password']);
//     $password2 = htmlspecialchars($data['password2']);


//     $query ="SELECT email FROM tb_users where email = '$email'";

//     $k=mysqli_query($koneksi, $query);
    
//     $cekdata= mysqli_affected_rows($koneksi);
//     if ($password!=$password2) {
//         return false;
//     }
//     if ($cekdata) {
//         mysqli_query($koneksi,"INSERT INTO tb_users (`full_name`,`email`,`password`) VALUES ('$first_name','$email','$password')");
//         return mysqli_affected_rows($koneksi);
//     }else{
//         return false;
//     }
    
// }

function register($data){
    global $koneksi;

    $first_name = htmlspecialchars($data['first_name']);
    $last_name = htmlspecialchars($data['last_name']);
    $email = htmlspecialchars($data['email']);
    $password = htmlspecialchars($data['password']);
    $password2 = htmlspecialchars($data['password2']);

    // Cek apakah email sudah ada
    $query = "SELECT email FROM tb_users WHERE email = '$email'";
    $k = mysqli_query($koneksi, $query);
    
    if (mysqli_num_rows($k) > 0) {
        // Email sudah terdaftar
        return false;
    }

    // Cek apakah password cocok
    if ($password !== $password2) {
        return false;
    }

    // Hash password
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Gabungkan nama depan dan belakang
    $full_name = $first_name . ' ' . $last_name;

    // Insert data
    mysqli_query($koneksi, "INSERT INTO tb_users (`full_name`, `email`, `password`) VALUES ('$full_name', '$email', '$password_hash')");

    return mysqli_affected_rows($koneksi);
}

?>