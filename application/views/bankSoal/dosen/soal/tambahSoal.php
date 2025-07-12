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
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="/bank-soal-ci3-dosen/index.php/banksoal"><img
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
                                    <!-- <small><span
                                            class="text-uppercase"><?= $this->session->userdata("fullname") ?></span></small><br> -->
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
                <div class="row">
                    <div class="col">
                        <h2 class="my-3">Tambah Soal</h2>
                        <a href="/bank-soal-ci3-dosen/index.php/bankSoal/<?= $id_mata_kuliah; ?>/bab/<?= $id; ?>" class="btn btn-primary">Kembali ke
                            Daftar
                            Soal</a>
                    </div>
                </div>
                <br><br>
                <div class="row-12">
                    <form action="/bank-soal-ci3-dosen/index.php/bankSoal/<?= $id_mata_kuliah; ?>/bab/<?= $id; ?>/simpan_soal" method="post">
                        <div class="row mb-3">
                            <label for="soal" class="col-sm-2 col-form-label">Soal</label>
                            <div class="col-sm-10">
                                <textarea contenteditable="true"
                                    class="summernote form-control <?= (form_error('soal')) ? 'is-invalid' : ''; ?> "
                                    id="soal" name="soal"><?= set_value('soal'); ?>
                                </textarea>
                                <div class="invalid-feedback">
                                    <?= form_error('soal'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="jawaban_a" class="col-sm-2 col-form-label">Jawaban A</label>
                            <div class="col-sm-10">
                                <textarea
                                    class="summernote form-control <?= (form_error('jawaban_a')) ? 'is-invalid' : ''; ?> "
                                    id="jawaban_a" name="jawaban_a"><?= set_value('jawaban_a'); ?></textarea>
                                <div class="invalid-feedback">
                                    <?= form_error('jawaban_a'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="jawaban_b" class="col-sm-2 col-form-label">Jawaban B</label>
                            <div class="col-sm-10">
                                <textarea
                                    class="summernote form-control <?= (form_error('jawaban_b')) ? 'is-invalid' : ''; ?> "
                                    id="jawaban_b" name="jawaban_b"><?= set_value('jawaban_b'); ?></textarea>
                                <div class="invalid-feedback">
                                    <?= form_error('jawaban_b'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="jawaban_c" class="col-sm-2 col-form-label">Jawaban C</label>
                            <div class="col-sm-10">
                                <textarea
                                    class="summernote form-control <?= (form_error('jawaban_c')) ? 'is-invalid' : ''; ?> "
                                    id="jawaban_c" name="jawaban_c"><?= set_value('jawaban_c'); ?></textarea>
                                <div class="invalid-feedback">
                                    <?= form_error('jawaban_c'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="jawaban_d" class="col-sm-2 col-form-label">Jawaban D</label>
                            <div class="col-sm-10">
                                <textarea
                                    class="summernote form-control <?= (form_error('jawaban_d')) ? 'is-invalid' : ''; ?> "
                                    id="jawaban_d" name="jawaban_d"><?= set_value('jawaban_d'); ?></textarea>
                                <div class="invalid-feedback">
                                    <?= form_error('jawaban_d'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="jawaban_benar" class="col-form-label col-sm-2">Jawaban Benar</label>
                            <div class="col-sm-10">
                                <?php
                                $jawabanOptions = ['jawaban_a', 'jawaban_b', 'jawaban_c', 'jawaban_d'];
                                foreach ($jawabanOptions as $option) {
                                    echo '<div class="form-check form-check-inline col-sm-1 mt-2">';
                                    echo '<input class="form-check-input" type="radio" id="jawaban_benar" name="jawaban_benar" value="' . $option . '">';
                                    echo '<label class="form-check-label" for="jawaban_benar"> ' . strtoupper(substr($option, -1)) . '</label>';
                                    echo '</div>';
                                }
                                ?>
                            </div>
                        </div><br>
                        <button type="submit" class="btn btn-primary">Tambah Soal</button>
                    </form>
                </div><br>
            </div>

            <script>
                $(document).ready(function() {
                    $('.summernote').each(function() {
                        var elementId = $(this).attr('id');
                        var height = (elementId === 'soal') ? 300 : null;

                        $(this).summernote({
                            callbacks: {
                                onImageUpload: function(files) {
                                    for (let i = 0; i < files.length; i++) {
                                        $.upload(files[i]);
                                    }
                                },
                                onMediaDelete: function(target) {
                                    $.delete(target[0].src);
                                },
                                onPaste: function(e) {
                                    var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                                    e.preventDefault();
                                    document.execCommand('insertText', false, bufferText);
                                }
                            },
                            tabsize: 2,
                            height: height
                        });
                    });
                });
                $.upload = function(file) {
                    console.log(file);
                    let out = new FormData();
                    out.append('file', file, file.name);
                    $.ajax({
                        method: 'POST',
                        url: '<?php echo site_url('banksoal/upload_gambar') ?>',
                        contentType: false,
                        cache: false,
                        processData: false,
                        data: out,
                        success: function(url) {
                            let html = $('.summernote').summernote('code');
                            $('.summernote').summernote('code', html + '<img src="' + url + '"/>');
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.error("error"+ textStatus + " " + errorThrown);
                        }
                    });
                };
                $.delete = function(src) {
                    $.ajax({
                        method: 'POST',
                        url: '<?php echo site_url('banksoal/delete_gambar') ?>',
                        cache: false,
                        data: {
                            src: src
                        },
                        success: function(response) {
                            console.log(response);
                        }

                    });
                };
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