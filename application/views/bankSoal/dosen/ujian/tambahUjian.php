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
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="/bank-soal-ci3-dosen/index.php/banksoal"><img
                        src="https://cdn-icons-png.flaticon.com/512/5/5178.png" class="ms-2" alt="Logo"
                        style="width: 30px;"><span class="ms-2 fs-8">Quiz</span></a>
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
            <div class="container mb-4">
                <div class="row">
                    <div class="col-12">
                        <h2 class="my-3">Tambah Quiz</h2>
                        <!-- <a class="btn btn-primary" href="/bank-soal-ci3-dosen/index.php/bankSoal/<?= $id; ?>">Kembali ke Halaman Sebelumnya</a> -->
                        <!-- <br><br> -->
                        <form action="/bank-soal-ci3-dosen/index.php/bankSoal/<?= $id ?>/simpan_ujian/<?= $idKelas ?>" method="post">
                            <div class="col mb-3">
                                <label for="nama_ujian" class="col-sm-2 col-form-label fw-bold">Judul Quiz</label>
                                <div class="col-sm-10">
                                    <input type="text"
                                        id="nama_ujian" name="nama_ujian" value="" class="w-100">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col mb-3">
                                <div for="deskripsi_ujian" class="col-sm-2 col-form-label fw-bold">isi Quiz</div>
                                <!-- <div class="col-sm-10">
                                    <input type="text"
                                        id="deskripsi_ujian" name="deskripsi_ujian"
                                        value="">
                                    <div class="invalid-feedback">
                                    </div>
                                </div> -->
                                <div class="col-sm-10">
                                    <textarea contenteditable="true"
                                        class="summernote form-control "
                                        id="soal" name="soal">
                                </textarea>
                                </div>
                            </div>
                            <div class="row mb-3 ml-3">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="jenisJawaban" class="form-label fw-bold">Jenis Jawaban dari mahasiswa</label>
                                        <select class="form-select w-100" id="jenisJawaban" name="jenisJawaban">
                                            <option value="">Pilih jenis jawaban...</option>
                                            <option value="benar">Pilihan Ganda</option>
                                            <option value="salah">Esay</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row ml-3">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="waktu_buka_ujian" class="form-label">Waktu Buka Quiz</label>
                                        <input type="datetime-local"
                                            class="form-control"
                                            id="waktu_buka_ujian"
                                            name="waktu_buka_ujian"
                                            required>
                                        <div class="invalid-feedback">
                                            Waktu buka quiz harus diisi
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="waktu_tutup_ujian" class="form-label">Waktu Tutup Quiz</label>
                                        <input type="datetime-local"
                                            class="form-control"
                                            id="waktu_tutup_ujian"
                                            name="waktu_tutup_ujian"
                                            required>
                                        <div class="invalid-feedback">
                                            Waktu tutup quiz harus diisi
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row ml-3">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="jenisJawaban" class="form-label">Jenis Jawaban dari mahasiswa</label>
                                        <select class="form-select w-100" id="jenisJawaban" name="jenisJawaban">
                                            <option value="">Pilih jenis jawaban...</option>
                                            <option value="benar">Benar</option>
                                            <option value="salah">Salah</option>
                                            <option value="tidak_menjawab">Tidak Menjawab</option>
                                            <option value="ragu_ragu">Ragu-ragu</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- <div class="row mb-3">
                                <label for="durasi_ujian" class="col-sm-2 col-form-label">Durasi Quiz</label>
                                <div class="col-sm-2">
                                    <input type="number"
                                        id="durasi_ujian" name="durasi_ujian" value="">
                                    <div class="invalid-feedback">
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <span id="menit" class="form-text">
                                        Menit
                                    </span>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="nilai_minimum_kelulusan" class="col-sm-2 col-form-label">Nilai Minimum
                                    Kelulusan</label>
                                <div class="col-sm-2 mt-4">
                                    <input type="number"
                                        id="nilai_minimum_kelulusan" name="nilai_minimum_kelulusan"
                                        value="">
                                    <div class="invalid-feedback">
                                    </div>
                                </div>
                                <div class="col-auto mt-4">
                                    <span id="menit" class="form-text">%</span>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="jumlah_soal" class="col-sm-2 col-form-label">Jumlah Soal Untuk Quiz</label>
                                <div class="col-sm-2 mt-4">
                                    <input type="number"
                                        id="jumlah_soal" name="jumlah_soal" value="">
                                    <div class="invalid-feedback">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="pilih_soal_dari_bab" class="col-sm-2 col-form-label">Pilih Soal Dari
                                    Bab</label>
                                <div class="col">
                                    <ul class="list-group list-group-flush" id="pilih_soal_dari_bab">
                                        <?php foreach ($bab as $bab): ?>
                                            <?php if ($bab['id_mata_kuliah'] == $id): ?>
                                                <li class="list-group-item border-0" style="background-color: #f4f6f9;">
                                                    <div>
                                                        <input class="form-check-input" type="checkbox"
                                                            value="<?= $bab['id'] ?>" name="bab[]">
                                                        <label class="form-check-label ml-2"
                                                            for="checkbox_bab_<?= $bab['id'] ?>">BAB <?= $bab['nomor_bab'] ?> -
                                                            <?= $bab['nama_bab'] ?></label>
                                                    </div>
                                                </li>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div> -->
                            <!-- <div class="row mb-3">
                                <label for="tunjukkan_nilai" class="col-sm-2 col-form-label">Tunjukkan Nilai</label>
                                <div class="col-sm-2 mt-2">
                                    <input class="form-check-input col-sm-3" type="checkbox" id="tunjukkan_nilai"
                                        name="tunjukkan_nilai" checked>
                                    <br>
                                </div>
                            </div> -->
                            <!-- <div class="row mb-3">
                                <label for="random" class="col-sm-2 col-form-label">Acak Soal</label>
                                <div class="col-sm-2 mt-2">
                                    <input class="form-check-input col-sm-3" type="checkbox" id="random" name="random"
                                        checked>
                                    <br>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="menggunakan_ruang_ujian" class="col-sm-2 col-form-label">Menggunakan Ruang
                                    Ujian</label>
                                <div class="col-sm-2 mt-3">
                                    <input class="form-check-input col-sm-3" type="checkbox"
                                        id="menggunakan_ruang_ujian" name="menggunakan_ruang_ujian">
                                    <br>
                                </div>
                            </div>

                            <div id="menudiv" style="display:none;" class="row mb-3">
                                <div class="col-sm-2"> <label for="ruang_ujian" class="col-form-label">Pilih
                                        Ruang</label> </div>
                                <div class="col-sm-10"> <select id="ruang_ujian" name="ruang_ujian"
                                        class="form-control">
                                        <option value="">Plih Ruang :</option>
                                        <option value="ruang1">Ruang 1</option>
                                        <option value="ruang2">Ruang 2</option>
                                        <option value="ruang3">Ruang 3</option>
                                    </select> </div>
                            </div> -->
                            <br>
                            <script>
                                var checkbox = document.getElementById("menggunakan_ruang_ujian");
                                var menudiv = document.getElementById("menudiv");

                                checkbox.addEventListener("change", function() {
                                    if (checkbox.checked) {
                                        menudiv.style.display = "flex";
                                    } else {
                                        menudiv.style.display = "none";
                                    }
                                });
                            </script>

                            <button type="submit" class="btn btn-primary ml-4">Tambah Quiz</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                    console.error("error" + textStatus + " " + errorThrown);
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