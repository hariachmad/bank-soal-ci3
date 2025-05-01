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
            <div class="container-fluid"></div>
            <div class="container">
                <div class="col-12">
                    <h2 class="my-3">Hasil Ujian</h2>
                    <table class="table table-borderless d-flex justify-content-center"
                        style="background-color: #f4f6f9;">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 20%"></th>
                                <th scope="col" style="width: 80%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="col">
                                    <h5>Nama Ujian</h5>
                                </th>
                                <th scope="col">
                                    <h5>: <?= $ujian[0]['nama_ujian'] ?></h5>
                                </th>
                            </tr>
                            <?php if ($ujian[0]['tunjukkan_nilai']): ?>
                                <tr>
                                    <th scope="col">
                                        <h5>Soal Benar</h5>
                                    </th>
                                    <th scope="col">
                                        <h5>: <?= $jawabanBenar ?> dari <?= $ujian[0]['jumlah_soal'] ?> Soal</h5>
                                    </th>
                                </tr>
                                <tr>
                                    <th scope="col">
                                        <h5>Nilai</h5>
                                    </th>
                                    <th scope="col">
                                        <h5>: <?= $nilai ?> %</h5>
                                    </th>
                                </tr>
                            <?php endif; ?>
                            <tr>
                                <th scope="col">
                                    <a href="/bank-soal-ci3/index.php/ujian/masuk_ujian/<?= $this->session->userdata('id'); ?>" class="btn btn-primary">Kembali</a>
                                </th>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 95%">Sub CPMK</th>
                                <th scope="col" style="width: 5%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            $rowColor = null;
                            foreach ($sub_cpmk as $k) {
                                if ($k[1] === $k[2]) {
                                    $rowColor = 'class = "table-success"';
                                } else {
                                    $rowColor = 'class = "table-danger"';
                                }

                                echo '<tr ' . $rowColor . '>
                            <td>' . $i . '. ' . $k[0] . '<br></td>
                            <td>' . $k[1] . '/' . $k[2] . '</td>
                        </tr>';
                                $i++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div><br>
                <div class="col-12">
                    <?php
                    $counter = 1;
                    foreach ($soalUjian as $soal):
                        $jawaban = null;
                        foreach ($soalIdAndJawaban as $jawaban) {
                            if ($jawaban['id_soal'] === $soal['id']) {
                                $jawaban = $jawaban['jawaban_dipilih'];
                                break;
                            }
                        }
                        ?>
                        <table class="table" style="margin-bottom: 0px;">
                            <thead>
                                <tr>
                                    <th scope="col" <?php if ($soal['jawaban_benar'] === $jawaban): ?> class="table-success"
                                        <?php else: ?> class="table-danger" <?php endif; ?>>Nomor <?= $counter ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?= $soal['soal'] ?></td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table">
                            <tbody>
                                <tr class="<?= ($jawaban == 'jawaban_a') ? 'table-secondary' : '' ?>">
                                    <?php if ($soal['jawaban_benar'] == 'jawaban_a'): ?>
                                        <td style="width: 2%">&#9989;</td>
                                    <?php elseif ($jawaban == 'jawaban_a' && $jawaban != $soal['jawaban_benar']): ?>
                                        <td style="width: 2%">&#10060;</td><?php else: ?>
                                        <td style="width: 2%"></td><?php endif; ?>
                                    <td style="width: 2%">A.</td>
                                    <td style="width: 96%"><?= $soal['jawaban_a'] ?></td>
                                </tr>
                                <tr class="<?= ($jawaban == 'jawaban_b') ? 'table-secondary' : '' ?>">
                                    <?php if ($soal['jawaban_benar'] == 'jawaban_b'): ?>
                                        <td style="width: 2%">&#9989;</td>
                                    <?php elseif ($jawaban == 'jawaban_b' && $jawaban != $soal['jawaban_benar']): ?>
                                        <td style="width: 2%">&#10060;</td><?php else: ?>
                                        <td style="width: 2%"></td><?php endif; ?>
                                    <td style="width: 2%">B.</td>
                                    <td style="width: 96%"><?= $soal['jawaban_b'] ?></td>
                                </tr>
                                <tr class="<?= ($jawaban == 'jawaban_c') ? 'table-secondary' : '' ?>">
                                    <?php if ($soal['jawaban_benar'] == 'jawaban_c'): ?>
                                        <td style="width: 2%">&#9989;</td>
                                    <?php elseif ($jawaban == 'jawaban_c' && $jawaban != $soal['jawaban_benar']): ?>
                                        <td style="width: 2%">&#10060;</td><?php else: ?>
                                        <td style="width: 2%"></td><?php endif; ?>
                                    <td style="width: 2%">C.</td>
                                    <td style="width: 96%"><?= $soal['jawaban_c'] ?></td>
                                </tr>
                                <tr class="<?= ($jawaban == 'jawaban_d') ? 'table-secondary' : '' ?>">
                                    <?php if ($soal['jawaban_benar'] == 'jawaban_d'): ?>
                                        <td style="width: 2%">&#9989;</td>
                                    <?php elseif ($jawaban == 'jawaban_d' && $jawaban != $soal['jawaban_benar']): ?>
                                        <td style="width: 2%">&#10060;</td><?php else: ?>
                                        <td style="width: 2%"></td><?php endif; ?>
                                    <td style="width: 2%">D.</td>
                                    <td style="width: 96%"><?= $soal['jawaban_d'] ?></td>
                                </tr>
                            </tbody>
                        </table><br><br>
                        <?php $counter++;
                    endforeach; ?>
                </div>
            </div>
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