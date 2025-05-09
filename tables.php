<?php 
require "function.php";

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}

include "akses.php";
cek_akses('super_admin');

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
                            <div id="toolbar" class="mb-2 w-50">
                                <select class="form-select w-25">
                                    <option value="basic">Export Basic</option>
                                    <option value="all">Export All</option>
                                    <option value="selected">Export Selected</option>
                                </select>
                            </div>
                            <div class="card-body">
                                <table 
                                    id="table"
                                    class="table my-3"
                                    data-toolbar="#toolbar"
                                    data-search="true"
                                    data-show-columns="true"
                                    data-show-toggle="true"
                                    data-show-export="true"
                                    data-click-to-select="true"
                                    data-show-footer="true"
                                    data-export-types="['csv', 'excel', 'pdf']"
                                    data-export-options='{"fileName": "perubahan_log"}'
                                    >
                                    <thead>
                                        <tr class="table">
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
        <!-- switch alert -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
        <script src="js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-table@1.21.2/dist/bootstrap-table.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-table@1.21.2/dist/extensions/export/bootstrap-table-export.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/xlsx@0.17.5/dist/xlsx.core.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.29.0/tableExport.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>
        <style>
            .fixed-table-loading {
                display: none !important;
            }
        </style>


        <!-- Script for Export Select -->
        <script>
            $(function () {
            $('#toolbar select').change(function () {
                const type = $(this).val()
                $('#table').bootstrapTable('destroy').bootstrapTable({
                exportDataType: type,
                exportTypes: ['xlsx','csv', 'excel', 'pdf' ],
                columns: [
                    { field: 'state', checkbox: true, visible: type === 'selected' },
                    { field: 'id', title: 'ID' },
                    { field: 'name', title: 'Kolom Yang Diubah' },
                    { field: 'tanggal', title: 'Tanggal Kalibrasi' }
                ]
                });
            }).trigger('change');
            });
        </script>
        
    </body>
</html>

                
                

