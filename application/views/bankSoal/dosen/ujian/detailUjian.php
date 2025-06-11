<!doctype html>
<html lang="en">

<head>
    <?php $this->load->helper('url'); ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.0.js"
        integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
        crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Philosopher:regular">
    <link rel="stylesheet" href="<?= base_url("/public/styles.css") ?>">
    <title><?= $title; ?></title>
</head>

<body>
    <style>
        table {
            background-color: #fff;
        }
    </style>
    <div class="d-flex" id="wrapper">
        <div class="border-end" id="sidebar-wrapper">
            <div class="sidebar-heading border-bottom"
                style="font-family: 'Philosopher', sans-serif; background-color: #dc3545; color: #fff">
                <img src="https://inspire.unsrat.ac.id/resources/img/logo-unsrat-mosaic.png" class="ms-2" alt="Logo"
                    style="width: 35px;">
                <span class="ms-2 fs-5">I N S P I R E </span>
            </div>
            <div class="list-group list-group-flush">
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!"><img
                        src="https://cdn-icons-png.flaticon.com/512/5/5178.png" class="ms-2" alt="Logo"
                        style="width: 30px;"><span class="ms-2 fs-8">Ujian</span></a>
            </div>
        </div>
        <div id="page-content-wrapper" style="background-color: #f4f6f9;">
            <nav class="navbar navbar-expand-lg navbar-dark border-bottom" style="background-color: #dc3545;">
                <div class="container-fluid">
                    <button id="sidebarToggle" style="background-color: #dc3545; color: #fff; border: none">☰</button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mt-2 mt-lg-0 ml-auto">
                            <li class="nav-item dropdown">
                                <a class="nav-link" data-toggle="dropdown" href="#" style="line-height: 0.8em;">
                                    <small><span
                                            class="text-uppercase"><?= $this->session->userdata("fullname") ?></span></small><br>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" id="absolute">
                                    <a href="<?= site_url("logout") ?>" class="dropdown-item">
                                        KELUAR
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="container-fluid">

                <div class="container">
                    <div class="row">
                        <div class="col">
                            <h2 class="mt-2"><?= $ujian['nama_ujian'] ?></h2><br>
                            <a class="btn btn-primary"
                                href="/bank-soal-ci3/index.php/bankSoal/<?= $id_mata_kuliah; ?>/">Kembali ke Halaman
                                Sebelumnya</a><br><br>
                            <a id="exportExcel" class="btn btn-success" href="#" role="button">Export Nilai ke Excel</a>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 20%">Tentang Ujian</th>
                                        <th scope="col" style="width: 80%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Nama Ujian</td>
                                        <td><?= $ujian['nama_ujian'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Deskripsi Ujian</td>
                                        <td><?= $ujian['deskripsi_ujian'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Waktu Buka Ujian</td>
                                        <td><?= $ujian['waktu_buka_ujian'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Waktu Tutup Ujian</td>
                                        <td><?= $ujian['waktu_tutup_ujian'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Durasi Ujian</td>
                                        <td><?= $ujian['durasi_ujian'] ?> Menit</td>
                                    </tr>
                                    <tr>
                                        <td>Nilai Minimum Kelulusan</td>
                                        <td><?= $ujian['nilai_minimum_kelulusan'] ?> %</td>
                                    </tr>
                                    <tr>
                                        <td>Jumlah Soal</td>
                                        <td><?= $ujian['jumlah_soal'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Acak Soal</td>
                                        <td><?= ($ujian['random']) === 0 ? 'Tidak' : 'Ya'; ?></td>
                                    </tr>
                                    <?php if ($ujian['ruang_ujian']): ?>
                                        <tr>
                                            <td>Ruang Ujian</td>
                                            <td><?= $ujian['ruang_ujian'] ?></td>
                                        </tr>
                                    <?php endif; ?>
                                    <tr>
                                        <td>Tunjukkan Nilai</td>
                                        <td><?= ($ujian['tunjukkan_nilai']) === 0 ? 'Tidak' : 'Ya'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Kode Ujian</td>
                                        <td>
                                            <p id="codeCell">
                                                <?php if ($kode_ujian): ?>
                                                    <?= $kode_ujian[0]; ?>
                                                <?php endif; ?>
                                            </p>
                                            <a id="generateButton" class="btn btn-primary pull-right" href="#"
                                                role="button">Generate
                                                Kode Baru</a>
                                        </td>

                                    </tr>
                                </tbody>
                            </table>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 80%">Bab Untuk Ujian</th>
                                        <?php $count = array_count_values(array_column($soal_model, 'id_bab')); ?>
                                        <?php $countAll = 0; ?>
                                        <th scope="col" style="width: 20%">
                                            <?php foreach ($bab_data as $k): ?>
                                                <?php $countAll = $countAll + $count[$k['id']]; ?>
                                            <?php endforeach; ?>
                                            <?= $countAll; ?>
                                            Soal Tersedia
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($bab_data as $k): ?>
                                        <tr>
                                            <td><?= $k['nama_bab']; ?></td>
                                            <td>
                                                <?= $count[$k['id']]; ?> Soal
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <script>
                    var generateButton = document.getElementById('generateButton');

                    if (generateButton) {
                        generateButton.addEventListener('click', function() {
                            var randomCode = generateRandomCode();
                            document.getElementById('codeCell').textContent = randomCode;
                            // Send an AJAX request to save the code
                            var xhttp = new XMLHttpRequest();
                            xhttp.onreadystatechange = function() {
                                if (this.readyState == 4 && this.status == 200) {
                                    // Code successfully saved
                                    console.log('Code saved:', randomCode);
                                }
                            };
                            xhttp.open('POST', '/bank-soal-ci3/index.php/bankSoal/save-code', true);
                            xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                            xhttp.send('kode_ujian=' + encodeURIComponent(randomCode) + '&id_ujian=' + encodeURIComponent(<?php echo $ujian['id']; ?>));
                        });
                    }

                    document.getElementById('exportExcel').addEventListener('click', function() {
                        // Send an AJAX request to save the code
                        var xhttp = new XMLHttpRequest();
                        xhttp.responseType = 'blob';
                        xhttp.open('POST', 'http://localhost:4000/export-excel', true);
                        xhttp.setRequestHeader('Content-type', 'application/json');
                        xhttp.onreadystatechange = function() {
                            if (this.readyState == 4 && this.status == 200) {
                                console.log('Excel exported');
                                const blob = new Blob([this.response], {
                                    type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                                });
                                const downloadUrl = URL.createObjectURL(blob);
                                const a = document.createElement('a');
                                a.href = downloadUrl;
                                a.download = 'laporan.xlsx';
                                const contentDisposition = xhttp.getResponseHeader('Content-Disposition');
                                if (contentDisposition) {
                                    const filenameMatch = contentDisposition.match(/filename="?(.+)"?/);
                                    if (filenameMatch && filenameMatch[1]) {
                                        a.download = filenameMatch[1];
                                    }
                                }
                                document.body.appendChild(a);
                                a.click();
                                setTimeout(() => {
                                    document.body.removeChild(a);
                                    URL.revokeObjectURL(downloadUrl);
                                }, 100);

                            } else if (this.status != 200) {
                                console.error("Gagal mengirim request. Status:", this.status);
                            }
                        };

                        xhttp.send(JSON.stringify({
                            id: <?= $ujian['id']; ?>
                        }));
                    });

                    function generateRandomCode() {
                        var charset = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
                        var code = '';
                        for (var i = 0; i < 8; i++) {
                            var randomIndex = Math.floor(Math.random() * charset.length);
                            code += charset[randomIndex];
                        }
                        return code;
                    }
                </script>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('DOMContentLoaded', event => {
            const sidebarToggle = document.body.querySelector('#sidebarToggle');
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', event => {
                    event.preventDefault();
                    document.body.classList.toggle('sb-sidenav-toggled');
                    localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
                });
            }
        });
    </script>
</body>

</html>