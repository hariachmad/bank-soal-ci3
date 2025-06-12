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
    <link rel="stylesheet" href="<?= base_url("public/styles.css") ?>">
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
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="/bank-soal-ci3/index.php/banksoal"><img
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
                            <h2 class="mt-2"><?= $mataKuliah['nama_mata_kuliah'] ?></h2>
                            <a href="/bank-soal-ci3/index.php/bankSoal" class="btn btn-primary mb-3">Kembali ke Daftar Mata Kuliah</a><br><br>
                            <h2 class="mt-2">Daftar Ujian</h2><br>
                            <a href="/bank-soal-ci3/index.php/bankSoal/<?= $mataKuliah['id']; ?>/tambah_ujian"
                                class="btn btn-primary mb-3">Tambah Ujian</a><br>
                            <?php if ($this->session->flashdata('pesan_ujian')): ?>
                                <div class="alert alert-success" role="alert">
                                    <?= $this->session->flashdata('pesan_ujian'); ?>
                                </div>
                            <?php endif; ?>

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col" class="col-9">Nama Ujian</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($ujian as $k): ?>
                                        <?php if ($k['id_mata_kuliah'] === $mataKuliah['id']): ?>
                                            <tr>
                                                <td><?= $k['nama_ujian'] ?></td>
                                                <td><a href="/bank-soal-ci3/index.php/bankSoal/<?= $mataKuliah['id']; ?>/detail_ujian/<?= $k['id']; ?>"
                                                        class="btn btn-primary">Detail</a>
                                                    <a href="/bank-soal-ci3/index.php/bankSoal/<?= $mataKuliah['id']; ?>/ubah_ujian/<?= $k['id']; ?>"
                                                        class="btn btn-warning">Ubah</a>
                                                    <form
                                                        action="/bank-soal-ci3/index.php/bankSoal/<?= $mataKuliah['id']; ?>/hapus_ujian/<?= $k['id']; ?>"
                                                        method="get" class="d-inline">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button type="submit" class="btn btn-danger"
                                                            onclick="return confirm('Hapus Ujian ini?');">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>

                            <h2 class="mt-2">Daftar Bab</h2><br>
                            <a href="/bank-soal-ci3/index.php/bankSoal/<?= $mataKuliah['id']; ?>/tambah_bab" class="btn btn-primary mb-3">Tambah
                                Bab</a><br>
                            <?php if ($this->session->flashdata('pesan_bab')): ?>
                                <div class="alert alert-success" role="alert">
                                    <?= $this->session->flashdata('pesan_bab'); ?>
                                </div>
                            <?php endif; ?>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 10%">Nomor Bab</th>
                                        <th scope="col" style="width: 65%">Nama Bab</th>
                                        <th scope="col" style="width: 25%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($bab as $k): ?>
                                        <?php if ($k['id_mata_kuliah'] === $mataKuliah['id']): ?>
                                            <tr>
                                                <th scope="row"><?= $k['nomor_bab'] ?></th>
                                                <td><?= $k['nama_bab'] ?></td>
                                                <td><a href="/bank-soal-ci3/index.php/bankSoal/<?= $mataKuliah['id']; ?>/bab/<?= $k['id']; ?>/"
                                                        class="btn btn-primary">Detail</a>
                                                    <a href="/bank-soal-ci3/index.php/bankSoal/<?= $mataKuliah['id']; ?>/ubah_bab/<?= $k['id']; ?>"
                                                        class="btn btn-warning">Ubah</a>
                                                    <form
                                                        action="/bank-soal-ci3/index.php/bankSoal/<?= $mataKuliah['id']; ?>/hapus_bab/<?= $k['id']; ?>"
                                                        method="get" class="d-inline">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button type="submit" class="btn btn-danger"
                                                            onclick="return confirm('Hapus Bab ini?');">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
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