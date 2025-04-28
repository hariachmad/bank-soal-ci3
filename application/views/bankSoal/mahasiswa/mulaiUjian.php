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
                    <h1 class="mt-2"><?= $ujian['nama_ujian'] ?></h1><br>
                    <h2 class="mt-2">Sisa Waktu: <span id="countdown"></span></h2><br>
                    <form action="/ujian/hasil_ujian/<?= $id ?>" method="post" id="ujianForm">
                        <?php foreach ($soal as $k):
                            $jawaban_dipilih = null;
                            foreach ($jawaban as $jawaban) {
                                if ($jawaban['id_soal'] === $k->id) {
                                    $jawaban_dipilih = $jawaban['jawaban_dipilih'];
                                    break;
                                }
                            }
                            ?>
                            <div class="row">
                                <div class="col-1">
                                    <div style="display: flex; justify-content: center;">
                                        <h1><?= $currentPage; ?></h1>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <?= $k->soal ?><br>
                                    <div class="btn-group-vertical btn-group-toggle" data-toggle="buttons">
                                        <div>
                                            <label class="btn btn-outline-primary <?php if ($jawaban_dipilih === 'jawaban_a')
                                                echo 'active'; ?>">
                                                <input type="radio" class="btn-check" name="jawaban[<?= $k->id ?>][]"
                                                    value="jawaban_a" <?php if ($jawaban_dipilih === 'jawaban_a')
                                                        echo 'checked'; ?>> A
                                            </label>
                                            <label class="form-check-label ml-2"
                                                for="checkbox_bab_<?= $k->id ?>"><?= $k->jawaban_a ?></label>
                                        </div>
                                        <div>
                                            <label class="btn btn-outline-primary <?php if ($jawaban_dipilih === 'jawaban_b')
                                                echo 'active'; ?>">
                                                <input type="radio" class="btn-check" name="jawaban[<?= $k->id ?>][]"
                                                    value="jawaban_b" <?php if ($jawaban_dipilih === 'jawaban_b')
                                                        echo 'checked'; ?>> B
                                            </label>
                                            <label class="form-check-label ml-2"
                                                for="checkbox_bab_<?= $k->id ?>"><?= $k->jawaban_b ?></label>
                                        </div>
                                        <div>
                                            <label class="btn btn-outline-primary <?php if ($jawaban_dipilih === 'jawaban_c')
                                                echo 'active'; ?>">
                                                <input type="radio" class="btn-check" name="jawaban[<?= $k->id ?>][]"
                                                    value="jawaban_c" <?php if ($jawaban_dipilih === 'jawaban_c')
                                                        echo 'checked'; ?>> C
                                            </label>
                                            <label class="form-check-label ml-2"
                                                for="checkbox_bab_<?= $k->id ?>"><?= $k->jawaban_c ?></label>
                                        </div>
                                        <div>
                                            <label class="btn btn-outline-primary <?php if ($jawaban_dipilih === 'jawaban_d')
                                                echo 'active'; ?>">
                                                <input type="radio" class="btn-check" name="jawaban[<?= $k->id ?>][]"
                                                    value="jawaban_d" <?php if ($jawaban_dipilih === 'jawaban_d')
                                                        echo 'checked'; ?>> D
                                            </label>
                                            <label class="form-check-label ml-2"
                                                for="checkbox_bab_<?= $k->id ?>"><?= $k->jawaban_d ?></label>
                                        </div>
                                    </div>
                                <?php endforeach;
                        ?>
                            </div>
                            <div class="col">
                                <?= $pager; ?>
                                <input type="hidden" name="timer" id="timerInput">
                            </div>
                        </div>
                    </form>
                </div>

                <script>
                    $(document).ready(function () {
                        $('input[name="jawaban[' + <?= $k['id'] ?> + '][]"]').click(function (event) {
                            event.preventDefault(); // Prevent the default form submission
                            var idKodeUsers = <?= $id ?>;
                            var idSoal = <?= $k['id'] ?>;
                            var jawabanDipilih = this.value;
                            $.ajax({
                                url: '/ujian/simpan_jawaban_dipilih',
                                type: 'POST',
                                data: {
                                    id_kode_users: idKodeUsers,
                                    id_soal: idSoal,
                                    jawaban_dipilih: jawabanDipilih
                                },
                                success: function (response) {
                                    console.log('Answer submitted successfully');
                                },
                                error: function (xhr, status, error) {
                                    console.error('Error submitting answer:', error);
                                }
                            });
                        });
                    });

                    // Set the countdown duration in minutes
                    var countdownDuration = <?= $ujian['durasi_ujian'] ?>;

                    // Get the countdown element
                    var countdownElement = document.getElementById('countdown');

                    // Start the countdown immediately
                    startCountdown();

                    function startCountdown() {

                        var remainingTime = <?= $remainingTime ?>;

                        // Calculate the total countdown time in milliseconds
                        var totalTime = countdownDuration * 60 * 1000;

                        // If the remaining time is not set or has expired, calculate and set it
                        if (!remainingTime || remainingTime < 0) {
                            remainingTime = totalTime;
                            $.ajax({
                                url: '/ujian/save_remaining_duration',
                                method: 'POST',
                                data: {
                                    idKodeUsers: <?= $id ?>,
                                    remainingDuration: remainingTime
                                },
                                success: function (response) {
                                    console.log('Remaining duration saved or updated in the database.');
                                },
                                error: function (xhr, status, error) {
                                    console.error('Error saving or updating remaining duration:', error);
                                }
                            });
                        }

                        // Calculate the countdown end time based on the remaining time
                        var endTime = Date.now() + remainingTime;

                        // Update the countdown immediately
                        updateCountdown();

                        // Start the countdown interval
                        var countdown = setInterval(updateCountdown, 1000);

                        // Function to update the countdown
                        function updateCountdown() {
                            // Calculate the remaining time
                            remainingTime = endTime - Date.now();
                            // Check if the countdown has reached 0
                            if (remainingTime < 0) {
                                // Stop the countdown
                                clearInterval(countdown);

                                // Auto-submit the form
                                document.getElementById('ujianForm').submit();
                                return;
                            }
                            var hours = Math.floor(remainingTime / (60 * 60 * 1000));
                            var minutes = Math.floor(remainingTime / (60 * 1000));
                            var seconds = Math.floor((remainingTime % (60 * 1000)) / 1000);

                            // Format the time with leading zeros
                            var formattedTime = ('0' + hours).slice(-2) + ':' + ('0' + minutes).slice(-2) + ':' + ('0' + seconds).slice(-2);

                            // Display the countdown timer
                            countdownElement.textContent = formattedTime;

                            window.onbeforeunload = function () {
                                $.ajax({
                                    url: '/ujian/save_remaining_duration',
                                    method: 'POST',
                                    data: {
                                        idKodeUsers: <?= $id ?>,
                                        remainingDuration: remainingTime
                                    },
                                    success: function (response) {
                                        console.log('Remaining duration saved or updated in the database.');
                                    },
                                    error: function (xhr, status, error) {
                                        console.error('Error saving or updating remaining duration:', error);
                                    }
                                });
                            };
                        }
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