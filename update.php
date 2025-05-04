<?php
require "function.php";

if (!isset($_SESSION['email'])) {
    header("Location:login.php");
    exit;
}else {
    # code...
    echo"login dulu bro";
}


$noid = $_GET['noid'];
$kl = query("SELECT * FROM tb_kal WHERE `No. ID` = '$noid'")[0];


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Mengubah Alat</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html">Start Bootstrap</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="#!">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="index.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Layouts
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="layout-static.html">Static Navigation</a>
                                    <a class="nav-link" href="layout-sidenav-light.html">Light Sidenav</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Pages
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Authentication
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="login.html">Login</a>
                                            <a class="nav-link" href="register.html">Register</a>
                                            <a class="nav-link" href="password.html">Forgot Password</a>
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                        Error
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="401.html">401 Page</a>
                                            <a class="nav-link" href="404.html">404 Page</a>
                                            <a class="nav-link" href="500.html">500 Page</a>
                                        </nav>
                                    </div>
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">Addons</div>
                            <a class="nav-link" href="charts.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Charts
                            </a>
                            <a class="nav-link" href="tables.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Tables
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Start Bootstrap
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="my-4">Ubah Data</h1>
                        
                        <div class="container">
                            <form method="post">
                                <div class="row border ">
                                    <div class="col-md-4 my-3">
                                        <label for="nama" class="form-label">Nama Alat Ukur</label>
                                        <input type="text" class="form-control" name="Nama_Alat_Ukur" id="Nama_Alat_Ukur" required value="<?=$kl["Nama Alat Ukur"];?>">
                                    </div>
                                    <div class="col-md-4 my-3">
                                        <input type="hidden" class="form-control" name="noid" id="noid" value="<?=$kl["No. ID"];?>">
                                    </div>
                                    <div class="col-md-4 my-3">
                                        <label for="Merk" class="form-label">Merk/Type/ No. Seri</label>
                                        <input type="text" class="form-control" name="merk" id="merk" required value="<?=$kl["Merk"];?>">
                                    </div>
                                    <div class="col-md-4 my-3">
                                        <label for="Tanggal Kalibrasi" class="form-label">Tanggal Kalibrasi</label>
                                        <input type="datetime-local" name="datebefore" id="datebefore" required value="<?=$kl["Tanggal Kalibrasi"];?>">
                                    </div>
                                    <div class="col-md-4 my-3">
                                        <label for="Tanggal re-Kalibrasi" class="form-label">Tanggal  Re-Kalibrasi</label>
                                        <input type="datetime-local" name="dateafter" id="dateafter" required value="<?=$kl["Tanggal Re-Kalibrasi"];?>" >
                                    </div>
                                    <div class="col-md-4 my-3">
                                        <label for="poin Kalibrasi" class="form-label">Poin Kalibrasi</label>
                                        <input type="text" class="form-control" name="Poin_Kalibrasi" id="Poin_Kalibrasi" required value="<?=$kl["Poin Kalibrasi"];?>">
                                    </div>
                                    <div class="col-md-4 my-3">
                                        <label for="hasil pengukuruan" class="form-label">Hasil Pengukuruan</label>
                                        <input type="text" class="form-control" name="Hasil_Pengukuran" id="Hasil_Pengukuran" required value="<?=$kl["Hasil Pengukuran"];?>">
                                    </div>
                                    <div class="col-md-4 my-3">
                                        <label for="koreksi" class="form-label">Koreksi</label>
                                        <input type="text" class="form-control" name="koreksi" id="koreksi" required value="<?=$kl["Koreksi"];?>">
                                    </div>
                                    <div class="col-md-4 my-3">
                                        <label for="u95" class="form-label">U95</label>
                                        <input type="text" class="form-control" name="u95" id="u95" required value="<?=$kl["U95"];?>">
                                    </div>
                                    <div class="col-md-4 my-3">
                                        <label for="koreksi-u95" class="form-label">Koreksi & U95 yang diijinkan</label>
                                        <input type="text" class="form-control" name="Koreksi_U95_yang_diijinkan" id="Koreksi_U95_yang_diijinkan" required value="<?=$kl["Koreksi & U95 yang diijinkan"];?>">
                                    </div>
                                    <div class="col-md-4 my-3">
                                        <label for="status" class="form-label">Status</label>
                                        <input type="text" class="form-control" name="Status" id="status" required value="<?=$kl["Status"];?>">
                                    </div>
                                    <div class="col-md-4 my-3">
                                        <label for="pelaksana" class="form-label">Pelaksana</label>
                                        <input type="text" class="form-control" name="pelaksana" id="pelaksana" required value="<?=$kl["pelaksana"];?>">
                                    </div>
                                    <div class="col-md-4 my-3">
                                        <label for="no_dokumen" class="form-label">No. Dokumen</label>
                                        <input type="text" class="form-control" name="no_dokumen" id="no_dokumen" required value="<?=$kl["no_dokumen"];?>">
                                    </div>
                                    <div class="col-md-4 my-3">
                                        <label for="lokasi" class="form-label">Lokasi</label>
                                        <input type="text" class="form-control" name="lokasi" id="lokasi" required value="<?=$kl["lokasi"];?>">
                                    </div>
                                    <div class="col-md-4 my-3">
                                        <label for="divisi" class="form-label">Divisi</label>
                                        <input type="text" class="form-control" name="divisi" id="divisi" required value="<?=$kl["divisi"];?>">
                                    </div>
                                    <div class="col-9 d-flex justify-content-center mx-4 my-3">
                                        <button type="submit" name="submit" class="btn btn-primary btn-lg mx-4 my-3">Update Data</button>
                                        <button type="button" class="btn btn-danger btn-lg  mx-4 my-3"><a href="index.php" style="color: white; text-decoration: none;">Kembali</a></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2023</div>
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
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
<?php
if (ISSET($_POST["submit"])) {
    if (update($_POST)>0) {
        echo "<script>
        Swal.fire({
            title: 'Data berhasil ditambahkan!',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'index.php';
            }
        });
    </script>";
    }else {
        echo "<script>
            Swal.fire({
                title: 'Gagal menambahkan data!',
                icon: 'error'    
            }); </script>";
    }
}?>