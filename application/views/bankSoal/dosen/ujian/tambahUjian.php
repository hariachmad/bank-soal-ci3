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
    <style>
        .question-card {
            margin-bottom: 20px;
            border-left: 4px solid #007bff;
        }

        .option-group {
            background-color: #f8f9fa;
            padding: 10px;
            border-radius: 5px;
            margin: 10px 0;
        }

        .correct-answer {
            border-left: 3px solid #28a745;
        }

        #questionContainer {
            max-height: 80vh;
            overflow-y: auto;
        }
    </style>
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
                        <form action="/bank-soal-ci3-dosen/index.php/bankSoal/simpan_ujian/<?= $id;?>/<?= $idKelas ?>" method="post">
                        <input type="hidden" name="data_collection" id="data_collection">    
                        <div class="col mb-3">
                                <label for="nama_ujian" class="col-sm-2 col-form-label fw-bold">Judul Quiz</label>
                                <div class="col-sm-10">
                                    <input type="text"
                                        id="nama_ujian" name="nama_ujian" value="" class="w-100">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="row mb-3 ml-3">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="jenisJawaban" class="form-label fw-bold">Jenis Jawaban dari mahasiswa</label>
                                        <select class="form-select w-100" id="jenisJawaban" name="jenisJawaban">
                                            <option value="">Pilih jenis jawaban...</option>
                                            <option value="Pilihan Ganda">Pilihan Ganda</option>
                                            <option value="Esay">Esay</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row ml-3">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="waktu_buka_ujian" class="form-label fw-bold">Waktu Buka Quiz</label>
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
                                        <label for="waktu_tutup_ujian" class="form-label fw-bold">Waktu Tutup Quiz</label>
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
                            <div class="container mt-5">
                                <div class="row justify-content-center">
                                    <div class="col-md-8">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="mb-4">
                                                    <label for="questionCount" class="form-label">Masukkan Jumlah Soal:</label>
                                                    <div class="input-group">
                                                        <input type="number"
                                                            class="form-control"
                                                            id="questionCount"
                                                            placeholder="Contoh: 100"
                                                            min="1"
                                                            max="500">
                                                        <button class="btn btn-primary" id="generateBtn" type="button">
                                                            Generate Form
                                                        </button>
                                                    </div>
                                                    <div class="form-text">Tekan Enter atau klik tombol untuk membuat form soal</div>
                                                </div>

                                                <div id="questionContainer"></div>

                                                <div id="submitSection" class="mt-4" style="display: none;">
                                                    <hr>
                                                    <div class="d-flex justify-content-between">
                                                        <button type="button" class="btn btn-success btn-lg" id="saveQuestions">
                                                            <i class="fas fa-save"></i> Simpan Semua Soal
                                                        </button>
                                                        <button type="button" class="btn btn-secondary" id="clearAll">
                                                            <i class="fas fa-trash"></i> Bersihkan Semua
                                                        </button>

                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary ml-4">Tambah Quiz</button>


                            <br>
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
                            <script>
                                let questionsData = {};

                                // Event listener untuk input number (Enter key)
                                document.getElementById('questionCount').addEventListener('keypress', function(e) {
                                    if (e.key === 'Enter') {
                                        generateQuestions();
                                    }
                                });

                                // Event listener untuk tombol generate
                                document.getElementById('generateBtn').addEventListener('click', generateQuestions);

                                // Event listener untuk tombol clear
                                document.getElementById('clearAll').addEventListener('click', function() {
                                    if (confirm('Apakah Anda yakin ingin menghapus semua soal?')) {
                                        document.getElementById('questionContainer').innerHTML = '';
                                        document.getElementById('submitSection').style.display = 'none';
                                        document.getElementById('questionCount').value = '';
                                        questionsData = {};
                                    }
                                });

                                // Event listener untuk tombol save
                                document.getElementById('saveQuestions').addEventListener('click', function() {
                                    collectAllData();
                                });

                                function generateQuestions() {
                                    const count = parseInt(document.getElementById('questionCount').value);

                                    if (!count || count <= 0) {
                                        alert('Masukkan jumlah soal yang valid (angka positif)');
                                        return;
                                    }

                                    if (count > 500) {
                                        alert('Maksimal 500 soal untuk performa yang optimal');
                                        return;
                                    }

                                    const container = document.getElementById('questionContainer');
                                    container.innerHTML = '';
                                    questionsData = {};

                                    // Generate form untuk setiap soal
                                    for (let i = 1; i <= count; i++) {
                                        const questionHtml = createQuestionForm(i);
                                        container.innerHTML += questionHtml;
                                    }

                                    // Tampilkan section submit
                                    document.getElementById('submitSection').style.display = 'block';

                                    // Scroll ke form yang dibuat
                                    container.scrollIntoView({
                                        behavior: 'smooth'
                                    });

                                    // Setup event listeners untuk semua form
                                    setupFormListeners();
                                }

                                function createQuestionForm(number) {
                                    return `
                <div class="card question-card" data-question="${number}">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Soal ${number}</h5>
                    </div>
                    <div class="card-body">
                       <div class="col-sm-10">
                                <textarea contenteditable="true"
                                    class="summernote form-control question-text"
                                    id="soal" name="soal">
                                </textarea>
                                <div class="invalid-feedback">
                                </div>
                            </div>
                        
                        <div class="option-group">
                            <label class="form-label">Pilihan Jawaban:</label>
                            
                            <div class="mb-2">
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <input class="form-check-input mt-0" 
                                               type="radio" 
                                               name="correct_${number}" 
                                               value="A"
                                               data-question="${number}">
                                    </div>
                                    <span class="input-group-text">A.</span>
                                    <input type="text" 
                                           class="form-control option-input" 
                                           placeholder="Pilihan A"
                                           data-question="${number}"
                                           data-option="A"
                                           id="A${number}"
                                           name="A${number}"
                                           >
                                </div>
                            </div>
                            
                            <div class="mb-2">
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <input class="form-check-input mt-0" 
                                               type="radio" 
                                               name="correct_${number}" 
                                               value="B"
                                               data-question="${number}">
                                    </div>
                                    <span class="input-group-text">B.</span>
                                    <input type="text" 
                                           class="form-control option-input" 
                                           placeholder="Pilihan B"
                                           data-question="${number}"
                                           data-option="B"
                                           id="B${number}"
                                           name="B${number}"
                                </div>
                            </div>
                            
                            <div class="mb-2">
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <input class="form-check-input mt-0" 
                                               type="radio" 
                                               name="correct_${number}" 
                                               value="C"
                                               data-question="${number}">
                                    </div>
                                    <span class="input-group-text">C.</span>
                                    <input type="text" 
                                           class="form-control option-input" 
                                           placeholder="Pilihan C"
                                           data-question="${number}"
                                           data-option="C"
                                           id="C${number}"
                                           name="C${number}"
                                </div>
                            </div>
                            
                            <div class="mb-2">
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <input class="form-check-input mt-0" 
                                               type="radio" 
                                               name="correct_${number}" 
                                               value="D"
                                               data-question="${number}">
                                    </div>
                                    <span class="input-group-text">D.</span>
                                    <input type="text" 
                                           class="form-control option-input" 
                                           placeholder="Pilihan D"
                                           data-question="${number}"
                                           data-option="D"
                                           id="D${number}"
                                           name="D${number}"
                                </div>
                            </div>
                            
                            <small class="form-text text-muted">
                                <i class="fas fa-info-circle"></i> 
                                Pilih radio button di samping jawaban yang benar
                            </small>
                        </div>
                    </div>
                </div>
            `;
                                }

                                function setupFormListeners() {
                                    // Setup listener untuk semua input
                                    const inputs = document.querySelectorAll('.question-text, .option-input, .explanation-text, input[type="radio"]');
                                    inputs.forEach(input => {
                                        input.addEventListener('input', updateProgress);
                                        input.addEventListener('change', updateProgress);
                                    });
                                }

                                function updateProgress(e) {
                                    const questionNumber = e.target.dataset.question;
                                    const card = document.querySelector(`.question-card[data-question="${questionNumber}"]`);

                                    // Hitung progress
                                    const questionText = card.querySelector('.soal').value.trim();
                                    const optionA = card.querySelector('input[data-option="A"]').value.trim();
                                    const optionB = card.querySelector('input[data-option="B"]').value.trim();
                                    const optionC = card.querySelector('input[data-option="C"]').value.trim();
                                    const optionD = card.querySelector('input[data-option="D"]').value.trim();
                                    const correctAnswer = card.querySelector(`input[name="correct_${questionNumber}"]:checked`);

                                    let completedFields = 0;
                                    const totalFields = 6; // pertanyaan + 4 opsi + jawaban benar

                                    if (questionText) completedFields++;
                                    if (optionA) completedFields++;
                                    if (optionB) completedFields++;
                                    if (optionC) completedFields++;
                                    if (optionD) completedFields++;
                                    if (correctAnswer) completedFields++;

                                    const percentage = (completedFields / totalFields) * 100;

                                    // Update progress bar
                                    const progressBar = card.querySelector('.progress-bar');
                                    const progressText = card.querySelector('.progress-text');

                                    progressBar.style.width = percentage + '%';
                                    progressText.textContent = `Progress: ${Math.round(percentage)}% (${completedFields}/${totalFields} field terisi)`;

                                    if (percentage === 100) {
                                        progressBar.className = 'progress-bar bg-success';
                                        card.classList.add('border-success');
                                    } else if (percentage >= 50) {
                                        progressBar.className = 'progress-bar bg-warning';
                                        card.classList.remove('border-success');
                                    } else {
                                        progressBar.className = 'progress-bar';
                                        card.classList.remove('border-success');
                                    }
                                }

                                function collectAllData() {
                                    const questions = document.querySelectorAll('.question-card');
                                    const allQuestionsData = [];
                                    let completedCount = 0;

                                    questions.forEach(card => {
                                        const questionNumber = card.dataset.question;
                                        const questionText = card.querySelector('.question-text').value.trim();
                                        const optionA = card.querySelector('input[data-option="A"]').value.trim();
                                        const optionB = card.querySelector('input[data-option="B"]').value.trim();
                                        const optionC = card.querySelector('input[data-option="C"]').value.trim();
                                        const optionD = card.querySelector('input[data-option="D"]').value.trim();
                                        const correctAnswerElement = card.querySelector(`input[name="correct_${questionNumber}"]:checked`);
                                        // const explanation = card.querySelector('.explanation-text').value.trim();

                                        const questionData = {
                                            number: questionNumber,
                                            question: questionText,
                                            options: {
                                                A: optionA,
                                                B: optionB,
                                                C: optionC,
                                                D: optionD
                                            },
                                            correctAnswer: correctAnswerElement ? correctAnswerElement.value : '',
                                            // explanation: explanation,
                                            isComplete: questionText && optionA && optionB && optionC && optionD && correctAnswerElement
                                        };

                                        if (questionData.isComplete) completedCount++;
                                        allQuestionsData.push(questionData);
                                    });

                                    // Tampilkan hasil
                                    const result = {
                                        totalQuestions: allQuestionsData.length,
                                        completedQuestions: completedCount,
                                        data: allQuestionsData
                                    };

                                    console.log('Data Soal:', JSON.stringify(result));
                                    document.getElementById("data_collection").value = JSON.stringify(result);

                                    // Tampilkan ringkasan
                                    alert(`Berhasil mengumpulkan data:\n- Total soal: ${result.totalQuestions}\n- Soal lengkap: ${result.completedQuestions}\n- Soal belum lengkap: ${result.totalQuestions - result.completedQuestions}\n\nData lengkap tersimpan di console browser (F12)`);

                                    // Simpan ke variabel global untuk akses lebih lanjut
                                    window.questionsResult = result;
                                }
                            </script>
                        </form>
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
    <script>
        function initSummernote() {
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
        };
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

        let summernoteCheckInterval = setInterval(function() {
            if ($('.summernote').length > 0) {
                clearInterval(summernoteCheckInterval); // Hentikan interval
                initSummernote(); // Inisialisasi Summernote
            }
        }, 100); // Cek setiap 100ms

        // Timeout fallback (opsional)
        setTimeout(function() {
            clearInterval(summernoteCheckInterval);
            console.log("Elemen .summernote tidak ditemukan setelah waktu tunggu");
        }, 5000);
    </script>
</body>

</html>