<div class="row mt-1">
    <div class="col-md-8 grid-margin stretch-card">
        <form action="" method="POST">
            @csrf
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-1 pb-0">Form Data Diri</h4>
                    <p class="card-description mb-3">
                        Mohon masukan data diri atlit dengan data yang BENAR.
                    </p>

                    <form id="form">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" name="nama" id="nama"
                                        class="form-control form-control-sm" placeholder="Masukkan nama lengkap"
                                        required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="umur">Umur</label>
                                    <input type="number" name="umur" id="umur"
                                        class="form-control form-control-sm" placeholder="Masukkan umur" min="1"
                                        required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" id="jenis_kelamin"
                                        class="form-select form-control form-control-sm" required>
                                        <option value="">-- Pilih Jenis Kelamin --</option>
                                        <option value="L">Laki-laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Institusi -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="institusi">Institusi</label>
                                    <input type="text" name="institusi" id="institusi"
                                        class="form-control form-control-sm" placeholder="Nama sekolah / klub" required>
                                </div>
                            </div>

                            <!-- Panjang Tungkai -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="panjang_tungkai">Panjang Tungkai (cm)</label>
                                    <input type="number" name="panjang_tungkai" id="panjang_tungkai"
                                        class="form-control form-control-sm" placeholder="Masukkan panjang tungkai"
                                        step="0.1" required>
                                </div>
                            </div>

                            <!-- Keterangan Tambahan -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="keterangan">Keterangan Tambahan</label>
                                    <textarea name="keterangan" id="keterangan" class="form-control form-control-sm" rows="2"
                                        placeholder="Tambahkan keterangan jika ada"></textarea>
                                </div>
                            </div>

                        </div>
                    </form>

                </div>
            </div>
        </form>
    </div>

    <div class="col-lg-4 mb-3 mb-lg-0">
        <div class="card congratulation-bg text-center my-0 py-4">
            <div class="card-body my-0 py-0">
                <img src="{{ asset('assets/images/dashboard/KAKI2.png') }}" class="kaki-img" alt=""
                    width="130px" id="kakiImg">

                <h2 class="mt-2 text-white mb-3 font-weight-bold" id="text-kaki">Sudah Siap?</h2>
                <div class="my-2">
                    <button type="button" class="btn btn-primary btn-sm" id="runTest">
                        Jalankan Pengujian
                    </button>
                </div>
                <p>Lakukan pengujian untuk mengetahui hasil analisis Anda.</p>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        // ======================= Menampilkan nilai Jeda Waktu ======================= //
        $('#modalSetting').on('shown.bs.modal', function() {
            if (window.appConfig && window.appConfig.jeda) {
                $('#jeda_waktu').val(window.appConfig.jeda);
            } else if (window.durationMs) {
                $('#jeda_waktu').val(window.durationMs / 1000);
            }

        });

        // ======================= Setting Jeda Waktu ======================= //
        window.appConfig = {
            jeda: @json(Cache::get('jeda_waktu', 5000))
        };

        window.durationMs = window.appConfig.jeda * 1000;

        $("#formSetting").submit(function(e) {
            e.preventDefault();

            $.ajax({
                url: "{{ url('/update-setting') }}",
                type: "POST",
                data: $(this).serialize(),
                success: function(response) {

                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: response.message,
                        showConfirmButton: false,
                        timer: 1000,
                        timerProgressBar: false,
                    });

                    window.appConfig.jeda = parseInt(response.jeda_waktu);
                    window.durationMs = parseInt(response.jeda_waktu) * 1000;

                    var modal = bootstrap.Modal.getInstance(
                        document.getElementById('modalSetting')
                    );
                    modal.hide();
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Terjadi kesalahan!',
                    });
                    console.log(xhr.responseText);
                }
            });
        });
        // ======================= Setting Jeda Waktu ======================= //

        let dataFirebase = {};
        let nilai_kanan = new Array(24).fill(0);
        let nilai_kiri = new Array(24).fill(0);
        let normalisasi = new Array(16).fill(0);
        let maxKananGlobal = [];
        let maxKiriGlobal = [];

        $(document).ready(function() {
            var firebaseConfig = {
                apiKey: "AIzaSyAwhN0Yx8LDPCsELAiyN2HJT1grBina2Os",
                authDomain: "setb-dummy.firebaseapp.com",
                databaseURL: "https://setb-dummy-default-rtdb.asia-southeast1.firebasedatabase.app",
                projectId: "setb-dummy",
            };

            firebase.initializeApp(firebaseConfig);
            const database = firebase.database();
            const usDistanceRef = database.ref('usDistanceVal');

            usDistanceRef.on('value', function(snapshot) {
                dataFirebase = snapshot.val() || {};

                const event = new CustomEvent('firebaseDataUpdate', {
                    detail: dataFirebase
                });
                document.dispatchEvent(event);
            });

            //=================================================== //
            //== render pie chart setelah data firebase update == //
            //=================================================== //
            $(document).on('firebaseDataUpdate', function(e) {
                // ======================= Menampilkan Pie Chart ======================= //
                const svg = document.getElementById("pieChart");
                if (!svg) return;

                const centerX = 150;
                const centerY = 150;
                const radius = 140;

                const letters = ['A', 'AM', 'M', 'PM', 'P', 'PL', 'L', 'AL'];
                const anglePerSlice = 360 / letters.length;
                const offsetAngle = -90 - (anglePerSlice / 2);

                function polarToCartesian(cx, cy, r, angle) {
                    const rad = angle * Math.PI / 180.0;
                    return {
                        x: cx + (r * Math.cos(rad)),
                        y: cy + (r * Math.sin(rad))
                    };
                }

                function setActive(letter) {
                    $("#pieChart path").removeClass("active");
                    $("#pieChart path[data-letter='" + letter + "']").addClass("active");
                    $("#activeLabel").text(letter);
                }

                letters.forEach((letter, i) => {
                    const startAngle = (anglePerSlice * i) + offsetAngle;
                    const endAngle = startAngle + anglePerSlice;
                    const midAngle = startAngle + (anglePerSlice / 2);

                    const start = polarToCartesian(centerX, centerY, radius, endAngle);
                    const end = polarToCartesian(centerX, centerY, radius, startAngle);

                    const largeArcFlag = anglePerSlice > 180 ? 1 : 0;

                    const d = [
                        "M", centerX, centerY,
                        "L", start.x, start.y,
                        "A", radius, radius, 0, largeArcFlag, 0, end.x, end.y,
                        "Z"
                    ].join(" ");

                    const path = document.createElementNS("http://www.w3.org/2000/svg", "path");
                    path.setAttribute("d", d);
                    path.setAttribute("data-letter", letter);

                    svg.appendChild(path);

                    const textPos = polarToCartesian(centerX, centerY, radius * 0.8, midAngle);

                    const text = document.createElementNS("http://www.w3.org/2000/svg", "text");
                    text.setAttribute("x", textPos.x);
                    text.setAttribute("y", textPos.y);
                    text.textContent = letter;

                    svg.appendChild(text);
                });
                // ======================= Menampilkan Pie Chart ======================= //

                // ======================= Logic Cek Form Input ======================= //
                const $btnSubmit = $('#runTest');
                const requiredFields = ['#nama', '#umur', '#jenis_kelamin', '#institusi',
                    '#panjang_tungkai'
                ];

                function checkForm() {
                    let allFilled = true;
                    requiredFields.forEach(function(selector) {
                        if ($(selector).val().trim() === '') {
                            allFilled = false;
                        }
                    });

                    $btnSubmit.prop('disabled', !allFilled);
                }

                checkForm();

                requiredFields.forEach(function(selector) {
                    $(selector).on('input change', checkForm);
                });
                // ======================= Logic Cek Form Input ======================= //

                // ======================= Button Pengujian di Jalankan ======================= //
                $('#runTest').click(function() {
                    let formData = {
                        nama: $('#nama').val(),
                        umur: $('#umur').val(),
                        jenis_kelamin: $('#jenis_kelamin').val(),
                        institusi: $('#institusi').val(),
                        panjang_tungkai: $('#panjang_tungkai').val(),
                        keterangan: $('#keterangan').val(),
                    };

                    function kaki() {
                        $('#kakiImg').attr('src',
                            "{{ asset('assets/images/dashboard/KAKI2.png') }}");
                        $('#text-kaki').text('SUDAH SIAP?');
                        $('#nama').prop('disabled', false);
                        $('#umur').prop('disabled', false);
                        $('#jenis_kelamin').prop('disabled', false);
                        $('#institusi').prop('disabled', false);
                        $('#panjang_tungkai').prop('disabled', false);
                        $('#keterangan').prop('disabled', false);
                        $('#runTest').text('Jalankan Pengujian').prop('disabled', false);
                        $('#rkaki').text('-');
                    }

                    function kanan() {
                        $('#kakiImg').attr('src', "{{ asset('assets/images/dashboard/KA2.png') }}");
                        $('#text-kaki').text('KAKI KANAN');
                        Swal.fire({
                            title: 'Kaki Kanan',
                            text: 'Kita akan mulai pengujian dengan kaki sebelah kanan.',
                            imageUrl: "{{ asset('assets/images/dashboard/KA2.png') }}",
                            imageWidth: 200,
                            imageHeight: 150,
                            imageAlt: 'Confirmation image',
                            showCancelButton: true,
                            confirmButtonText: 'Ya, lanjutkan',
                            cancelButtonText: 'Batal',
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $('#nama').prop('disabled', true);
                                $('#umur').prop('disabled', true);
                                $('#jenis_kelamin').prop('disabled', true);
                                $('#institusi').prop('disabled', true);
                                $('#panjang_tungkai').prop('disabled', true);
                                $('#keterangan').prop('disabled', true);
                                $('#runTest').text('Proses berlangsung...').prop('disabled',
                                    true);
                                $('#rkaki').text('KANAN');

                                setTimeout(() => {
                                    pengujian_kanan(() => {
                                        kiri();
                                    });
                                }, 2000);
                            } else {
                                $('#runTest').text('Jalankan Pengujian').prop('disabled',
                                    false);
                                Swal.fire({
                                    icon: 'info',
                                    title: 'Dibatalkan',
                                    text: 'Pengujian dibatalkan oleh pengguna.'
                                });
                                kaki();
                            }
                        });
                    }

                    function kiri() {
                        $('#kakiImg').attr('src',
                            "{{ asset('assets/images/dashboard/KI2.png') }}");
                        $('#text-kaki').text('KAKI KIRI');
                        Swal.fire({
                            title: 'Kaki Kiri',
                            text: 'Kita akan melanjutkan pengujian dengan kaki sebelah kiri.',
                            imageUrl: "{{ asset('assets/images/dashboard/KI2.png') }}",
                            imageWidth: 200,
                            imageHeight: 150,
                            imageAlt: 'Confirmation image',
                            showCancelButton: true,
                            confirmButtonText: 'Ya, lanjutkan',
                            cancelButtonText: 'Batal',
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $('#rkaki').text('KIRI');

                                setTimeout(() => {
                                    pengujian_kiri(() => {
                                        normalisasi();
                                    });
                                }, 2000);
                            } else {
                                $('#runTest').text('Jalankan Pengujian').prop('disabled',
                                    false);
                                Swal.fire({
                                    icon: 'info',
                                    title: 'Dibatalkan',
                                    text: 'Pengujian dibatalkan oleh pengguna.'
                                });

                                kaki();
                            }
                        });
                    }

                    kanan();
                });
                // ======================= Button Pengujian di Jalankan ======================= //

                // ======================= Fungsi Pengujian ======================= //
                function pengujian_kanan(onComplete) {
                    nilai_kanan = new Array(24).fill(0);

                    const labels = [
                        'A', 'A', 'A', 'AM', 'AM', 'AM', 'M', 'M', 'M',
                        'PM', 'PM', 'PM', 'P', 'P', 'P',
                        'PL', 'PL', 'PL', 'L', 'L', 'L',
                        'AL', 'AL', 'AL'
                    ];

                    const steps = [
                        '1', '2', '3', '1', '2', '3', '1', '2', '3',
                        '1', '2', '3', '1', '2', '3',
                        '1', '2', '3', '1', '2', '3',
                        '1', '2', '3'
                    ];

                    const cellIds = [
                        'ka1', 'ka2', 'ka3', 'ka4', 'ka5', 'ka6', 'ka7', 'ka8',
                        'ka9', 'ka10', 'ka11', 'ka12', 'ka13', 'ka14', 'ka15', 'ka16',
                        'ka17', 'ka18', 'ka19', 'ka20', 'ka21', 'ka22', 'ka23', 'ka24'
                    ];

                    const durationMs = window.durationMs;

                    let currentIndex = 0;
                    let endTime = Date.now() + durationMs;

                    // Reset semua sel
                    cellIds.forEach(id => $('#' + id).text('-'));
                    $("#pieChart path").removeClass("active");
                    $("#steps").text("-");

                    // Aktifkan pertama
                    setActive(labels[currentIndex]);
                    $("#steps").text(steps[currentIndex]);

                    const autoInterval = setInterval(() => {
                        let remaining = endTime - Date.now();

                        if (remaining <= 0) {
                            $('#' + cellIds[currentIndex]).text(nilai_kanan[currentIndex]);

                            currentIndex++;
                            if (currentIndex >= labels.length) {
                                clearInterval(autoInterval);
                                $("#pieChart path").removeClass("active");
                                $("#activeLabel").text("-");
                                $("#steps").text("-");

                                if (typeof onComplete === "function") onComplete();
                                return;
                            }

                            setActive(labels[currentIndex]);
                            $("#steps").text(steps[currentIndex]);
                            endTime = Date.now() + durationMs;
                            remaining = durationMs;
                        } else {
                            // tampilkan countdown sementara
                            let seconds = Math.floor(remaining / 1000);
                            let milliseconds = Math.floor((remaining % 1000) / 10);
                            const timeText = String(seconds).padStart(2, '0') + ":" + String(
                                milliseconds).padStart(2, '0');
                            $('#' + cellIds[currentIndex]).text(timeText);

                            const mapping = {
                                ka1: {
                                    firebaseKey: 'a1',
                                    index: 0
                                },
                                ka2: {
                                    firebaseKey: 'a1',
                                    index: 1
                                },
                                ka3: {
                                    firebaseKey: 'a1',
                                    index: 2
                                },
                                ka4: {
                                    firebaseKey: 'a2',
                                    index: 3
                                },
                                ka5: {
                                    firebaseKey: 'a2',
                                    index: 4
                                },
                                ka6: {
                                    firebaseKey: 'a2',
                                    index: 5
                                },
                                ka7: {
                                    firebaseKey: 'a3',
                                    index: 6
                                },
                                ka8: {
                                    firebaseKey: 'a3',
                                    index: 7
                                },
                                ka9: {
                                    firebaseKey: 'a3',
                                    index: 8
                                },
                                ka10: {
                                    firebaseKey: 'a4',
                                    index: 9
                                },
                                ka11: {
                                    firebaseKey: 'a4',
                                    index: 10
                                },
                                ka12: {
                                    firebaseKey: 'a4',
                                    index: 11
                                },
                                ka13: {
                                    firebaseKey: 'b1',
                                    index: 12
                                },
                                ka14: {
                                    firebaseKey: 'b1',
                                    index: 13
                                },
                                ka15: {
                                    firebaseKey: 'b1',
                                    index: 14
                                },
                                ka16: {
                                    firebaseKey: 'b2',
                                    index: 15
                                },
                                ka17: {
                                    firebaseKey: 'b2',
                                    index: 16
                                },
                                ka18: {
                                    firebaseKey: 'b2',
                                    index: 17
                                },
                                ka19: {
                                    firebaseKey: 'b3',
                                    index: 18
                                },
                                ka20: {
                                    firebaseKey: 'b3',
                                    index: 19
                                },
                                ka21: {
                                    firebaseKey: 'b3',
                                    index: 20
                                },
                                ka22: {
                                    firebaseKey: 'b4',
                                    index: 21
                                },
                                ka23: {
                                    firebaseKey: 'b4',
                                    index: 22
                                },
                                ka24: {
                                    firebaseKey: 'b4',
                                    index: 23
                                },
                            };

                            const map = mapping[cellIds[currentIndex]];
                            if (map) {
                                let nilai = dataFirebase[map.firebaseKey] ?? 0;
                                if (nilai > nilai_kanan[map.index]) {
                                    nilai_kanan[map.index] = nilai;
                                }
                            }
                        }
                    }, 50);
                }

                function pengujian_kiri(onComplete) {
                    nilai_kiri = new Array(24).fill(0);
                    const labels = [
                        'A', 'A', 'A', 'AM', 'AM', 'AM', 'M', 'M', 'M',
                        'PM', 'PM', 'PM', 'P', 'P', 'P',
                        'PL', 'PL', 'PL', 'L', 'L', 'L',
                        'AL', 'AL', 'AL'
                    ];

                    const steps = [
                        '1', '2', '3', '1', '2', '3', '1', '2', '3',
                        '1', '2', '3', '1', '2', '3',
                        '1', '2', '3', '1', '2', '3',
                        '1', '2', '3'
                    ];

                    const cellIds = [
                        'ki1', 'ki2', 'ki3', 'ki4', 'ki5', 'ki6', 'ki7', 'ki8',
                        'ki9', 'ki10', 'ki11', 'ki12', 'ki13', 'ki14', 'ki15', 'ki16',
                        'ki17', 'ki18', 'ki19', 'ki20', 'ki21', 'ki22', 'ki23', 'ki24'
                    ];

                    const durationMs = window.durationMs;

                    let currentIndex = 0;
                    let endTime = Date.now() + durationMs;

                    // Reset semua sel
                    cellIds.forEach(id => $('#' + id).text('-'));
                    $("#pieChart path").removeClass("active");
                    $("#steps").text("-");

                    // Aktifkan pertama
                    setActive(labels[currentIndex]);
                    $("#steps").text(steps[currentIndex]);

                    const autoInterval = setInterval(() => {
                        let remaining = endTime - Date.now();

                        if (remaining <= 0) {
                            $('#' + cellIds[currentIndex]).text(nilai_kiri[currentIndex]);

                            currentIndex++;
                            if (currentIndex >= labels.length) {
                                clearInterval(autoInterval);
                                $("#pieChart path").removeClass("active");
                                $("#activeLabel").text("-");
                                $("#steps").text("-");
                                if (typeof onComplete === "function") onComplete();
                                return;
                            }

                            setActive(labels[currentIndex]);
                            $("#steps").text(steps[currentIndex]);
                            endTime = Date.now() + durationMs;
                            remaining = durationMs;
                        } else {
                            // tampilkan countdown sementara
                            let seconds = Math.floor(remaining / 1000);
                            let milliseconds = Math.floor((remaining % 1000) / 10);
                            const timeText = String(seconds).padStart(2, '0') + ":" + String(
                                milliseconds).padStart(2, '0');
                            $('#' + cellIds[currentIndex]).text(timeText);

                            const mapping = {
                                ki1: {
                                    firebaseKey: 'a1',
                                    index: 0
                                },
                                ki2: {
                                    firebaseKey: 'a1',
                                    index: 1
                                },
                                ki3: {
                                    firebaseKey: 'a1',
                                    index: 2
                                },
                                ki4: {
                                    firebaseKey: 'a2',
                                    index: 3
                                },
                                ki5: {
                                    firebaseKey: 'a2',
                                    index: 4
                                },
                                ki6: {
                                    firebaseKey: 'a2',
                                    index: 5
                                },
                                ki7: {
                                    firebaseKey: 'a3',
                                    index: 6
                                },
                                ki8: {
                                    firebaseKey: 'a3',
                                    index: 7
                                },
                                ki9: {
                                    firebaseKey: 'a3',
                                    index: 8
                                },
                                ki10: {
                                    firebaseKey: 'a4',
                                    index: 9
                                },
                                ki11: {
                                    firebaseKey: 'a4',
                                    index: 10
                                },
                                ki12: {
                                    firebaseKey: 'a4',
                                    index: 11
                                },
                                ki13: {
                                    firebaseKey: 'b1',
                                    index: 12
                                },
                                ki14: {
                                    firebaseKey: 'b1',
                                    index: 13
                                },
                                ki15: {
                                    firebaseKey: 'b1',
                                    index: 14
                                },
                                ki16: {
                                    firebaseKey: 'b2',
                                    index: 15
                                },
                                ki17: {
                                    firebaseKey: 'b2',
                                    index: 16
                                },
                                ki18: {
                                    firebaseKey: 'b2',
                                    index: 17
                                },
                                ki19: {
                                    firebaseKey: 'b3',
                                    index: 18
                                },
                                ki20: {
                                    firebaseKey: 'b3',
                                    index: 19
                                },
                                ki21: {
                                    firebaseKey: 'b3',
                                    index: 20
                                },
                                ki22: {
                                    firebaseKey: 'b4',
                                    index: 21
                                },
                                ki23: {
                                    firebaseKey: 'b4',
                                    index: 22
                                },
                                ki24: {
                                    firebaseKey: 'b4',
                                    index: 23
                                },
                            };

                            const map = mapping[cellIds[currentIndex]];
                            if (map) {
                                let nilai = dataFirebase[map.firebaseKey] ?? 0;
                                if (nilai > nilai_kiri[map.index]) {
                                    nilai_kiri[map.index] = nilai;
                                }
                            }

                        }
                    }, 50);
                }
                // ======================= Fungsi Pengujian ======================= //

                // ======================= Fungsi normalisasi ======================= //
                function normalisasi() {
                    let panjang = parseFloat($('#panjang_tungkai').val());
                    if (!panjang || panjang <= 0) return;

                    let kananCol = [1, 3, 5, 7, 9, 11, 13, 15];
                    let kiriCol = [2, 4, 6, 8, 10, 12, 14, 16];

                    for (let i = 0; i < 8; i++) {

                        // ambil 3 data kanan
                        let kr1 = Number(nilai_kanan[i * 3]) || 0;
                        let kr2 = Number(nilai_kanan[i * 3 + 1]) || 0;
                        let kr3 = Number(nilai_kanan[i * 3 + 2]) || 0;
                        let maxKanan = Math.max(kr1, kr2, kr3);

                        // ambil 3 data kiri
                        let ki1 = Number(nilai_kiri[i * 3]) || 0;
                        let ki2 = Number(nilai_kiri[i * 3 + 1]) || 0;
                        let ki3 = Number(nilai_kiri[i * 3 + 2]) || 0;
                        let maxKiri = Math.max(ki1, ki2, ki3);

                        maxKananGlobal[i] = maxKanan;
                        maxKiriGlobal[i] = maxKiri;

                        let persenKanan = (maxKanan / panjang) * 100;
                        let persenKiri = (maxKiri / panjang) * 100;

                        // tampilkan ke kolom Ka dulu
                        $('#k' + kananCol[i]).html(persenKanan.toFixed(2) + '<br>%');
                        $('#k' + kiriCol[i]).html(persenKiri.toFixed(2) + '<br>%');
                        renderCompositeFormula();
                    }
                }
                // ======================= Fungsi normalisasi ======================= //

                function renderCompositeFormula() {

                    const kiri = document.getElementById("formulaKiri");
                    const kanan = document.getElementById("formulaKanan");
                    const hasil = document.getElementById("hasilComposite");

                    if (!kiri || !kanan) return;

                    let formulaKiri, formulaKanan;

                    // ===============================
                    // CEK apakah data sudah lengkap
                    // ===============================
                    if (maxKananGlobal.length === 8 && maxKiriGlobal.length === 8) {

                        let panjang = parseFloat($('#panjang_tungkai').val()) || 1;

                        let sumKanan = maxKananGlobal.join(" + ");
                        let sumKiri = maxKiriGlobal.join(" + ");

                        // ===============================
                        // RUMUS (Lebih besar sedikit)
                        // ===============================
                        formulaKiri =
                            `\\( CS_L =
                                \\frac{(${sumKiri}) \\times 100}
                                {8 \\times ${panjang}} \\)`;

                        formulaKanan =
                            `\\( CS_R =
                                \\frac{(${sumKanan}) \\times 100}
                                {8 \\times ${panjang}} \\)`;

                        // ===============================
                        // HITUNG NILAI
                        // ===============================
                        let totalKanan = maxKananGlobal.reduce((a, b) => a + b, 0);
                        let totalKiri = maxKiriGlobal.reduce((a, b) => a + b, 0);

                        let csl = (totalKiri / (8 * panjang)) * 100;
                        let csr = (totalKanan / (8 * panjang)) * 100;

                        // ===============================
                        // FUNGSI KATEGORI
                        // ===============================
                        function kategori(nilai) {
                            if (nilai > 95) return {
                                text: "Sangat Baik",
                                color: "success"
                            };
                            if (nilai >= 90) return {
                                text: "Baik",
                                color: "primary"
                            };
                            if (nilai >= 85) return {
                                text: "Cukup",
                                color: "warning"
                            };
                            return {
                                text: "Kurang",
                                color: "danger"
                            };
                        }

                        let kategoriKiri = kategori(csl);
                        let kategoriKanan = kategori(csr);

                        // ===============================
                        // HITUNG PERBANDINGAN (Selisih)
                        // ===============================
                        // bandingkan hanya elemen pertama dari max array
                        let selisih = Math.abs(maxKiriGlobal[0] - maxKananGlobal[0]);

                        let sisiDominan = maxKiriGlobal[0] > maxKananGlobal[0] ? "Kiri lebih baik" :
                            maxKananGlobal[0] > maxKiriGlobal[0] ? "Kanan lebih baik" :
                            "Seimbang";

                        // ===============================
                        // CEK CIDER
                        // ===============================
                        let statusCidera = selisih > 4 ? "Cidera" : "Tidak Cidera";

                        // ===============================
                        // TAMPILKAN HASIL
                        // ===============================
                        if (hasil) {
                            hasil.innerHTML = `
                                <div class="row text-center align-items-center mb-3">

                                    <div class="col-12 col-md-6 mb-2 mb-md-0">
                                        <div>
                                            <span class="text-muted">CSL :</span>
                                            <strong>${csl.toFixed(2)}%</strong> →
                                            <span class="text-${kategoriKiri.color} fw-semibold">
                                                ${kategoriKiri.text}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <div>
                                            <span class="text-muted">CSR :</span>
                                            <strong>${csr.toFixed(2)}%</strong> →
                                            <span class="text-${kategoriKanan.color} fw-semibold">
                                                ${kategoriKanan.text}
                                            </span>
                                        </div>
                                    </div>

                                </div>

                                <hr class="my-2">

                                <div class="text-center">
                                    Selisih : <strong>${selisih.toFixed(2)}</strong><br>
                                    <span class="fw-bold">${sisiDominan}</span><br>
                                    Status : <strong>${statusCidera}</strong>
                                </div>
                            `;
                        }
                    } else {

                        // ===============================
                        // DEFAULT RUMUS (BELUM ADA DATA)
                        // ===============================
                        formulaKiri =
                            `\\( \\small CS_L =
                                \\frac{(A_L + AM_L + M_L + PM_L + P_L + PL_L + L_L + AL_L) \\times 100}
                                {8 \\times PT} \\)`;

                        formulaKanan =
                            `\\( \\small CS_R =
                        \\frac{(A_R + AM_R + M_R + PM_R + P_R + PL_R + L_R + AL_R) \\times 100}
                        {8 \\times PT} \\)`;

                        if (hasil) {
                            hasil.innerHTML = "";
                        }
                    }

                    // ===============================
                    // TAMPILKAN RUMUS
                    // ===============================
                    kiri.innerHTML = formulaKiri;
                    kanan.innerHTML = formulaKanan;

                    // ===============================
                    // RENDER MATHJAX
                    // ===============================
                    if (window.MathJax) {
                        MathJax.typesetClear();
                        MathJax.typesetPromise([kiri, kanan]);
                    }
                }

                console.log("kanan", maxKananGlobal);
                console.log("kiri", maxKiriGlobal);

                renderCompositeFormula();
            });
        });
    </script>
@endpush
