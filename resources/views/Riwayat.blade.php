@extends('layout.main')
@section('content')
    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="content-wrapper">

                <div class="row mt-1">
                    @include('riwayat.list')
                    @include('riwayat.form')
                </div>

                <div class="row d-none" id="hasilPengujian">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card shadow-sm">
                            <div class="card-body">

                                <div class="section-title mb-2">
                                    <h3 class="title">Data Hasil Pengujian</h3>
                                    <p class="subtitle">Data hasil pengujian kaki kanan dan kaki kiri.</p>
                                </div>
                                <hr width="100%" class="p-0">

                                @include('dashboard.data_normalisasi')
                                @include('dashboard.composite_score')
                                @include('dashboard.grafik')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('layout.footer')
        </div>
    </div>

    @push('styles')
        <style>
            /* SEARCH BAR */
            .dataTables_wrapper .dataTables_filter {
                width: 100%;
                display: flex;
                justify-content: flex-start;
                margin-bottom: 15px;
            }

            /* label cari */
            .dataTables_wrapper .dataTables_filter label {
                width: 100%;
                display: flex;
                align-items: center;
            }


            /* input search */
            .dataTables_wrapper .dataTables_filter input {
                width: 100%;
                margin-left: 8px;
                height: 38px;
                border-radius: 6px;
                border: 1px solid #ddd;
                padding-left: 10px;
            }

            /* pagination */
            .dataTables_wrapper .dataTables_paginate {
                width: 100%;
                text-align: left !important;
                float: none !important;
                clear: both;
                /* ini yang bikin dia turun */
                margin-top: 0.25rem;
                white-space: nowrap;
                /* ini yang membuat tetap 1 line */
                overflow-x: auto;
            }

            /* style tombol pagination */
            .dataTables_wrapper .dataTables_paginate .paginate_button {
                padding: 6px 14px;
                margin: 5px 4px;
                border-radius: 6px;
                border: 1px solid #ddd;
                background: #f8f9fa;
                transition: 0.2s;
            }

            .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
                background: #4B49AC;
                color: white !important;
            }

            .dataTables_wrapper .dataTables_paginate .paginate_button.current {
                background: #4B49AC !important;
                color: white !important;
                border-color: #4B49AC;
            }

            /* info text */
            .dataTables_wrapper .dataTables_info {
                text-align: center;
            }
        </style>
    @endpush

    @push('scripts')
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

        <script>
            $(document).ready(function() {
                let barChartInstance = null;
                $.fn.DataTable.ext.pager.numbers_length = 5;
                $('#table-atlet').DataTable({
                    pageLength: 13,
                    lengthChange: false,
                    pagingType: "simple_numbers",
                    ordering: false,
                    searching: true,
                    info: true,
                    responsive: true,
                    language: {
                        search: "Cari:",
                        info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                        paginate: {
                            previous: "‹",
                            next: "›"
                        }
                    }
                });

                $(document).on('click', '.btn-view', function() {
                    let id = $(this).data('id');

                    $.ajax({
                        type: "GET",
                        url: "/riwayat/" + id,
                        success: function(response) {
                            // ========================== FORM DATA DIRI ==========================
                            $('#nama').val(response.nama);
                            $('#umur').val(response.umur);
                            $('#jenis_kelamin').val(response.jk);
                            $('#institusi').val(response.tes.institusi);
                            $('#tungkai_kanan').val(response.tes.tungkai_kanan);
                            $('#tungkai_kiri').val(response.tes.tungkai_kiri);
                            $('#keterangan').val(response.tes.keterangan);

                            // ========================== HASIL PENGUJIAN ==========================
                            let kanan = response.tes.data_kanan || response;
                            let kiri = response.tes.data_kiri || response;

                            let urutan = ['a', 'am', 'm', 'pm', 'p', 'pl', 'l', 'al'];
                            let index = 1;
                            urutan.forEach(prefix => {
                                for (let i = 1; i <= 3; i++) {
                                    $('#ka' + index).text(kanan[prefix + i] ?? '-');
                                    index++;
                                }
                            });

                            index = 1;
                            urutan.forEach(prefix => {
                                for (let i = 1; i <= 3; i++) {
                                    $('#ki' + index).text(kiri[prefix + i] ?? '-');
                                    index++;
                                }
                            });

                            $('#hasilPengujian').removeClass('d-none');

                            // ========================== NORMALISASI ==========================
                            let norm = response.tes.normalisasi;

                            let fields = [
                                'a_ka', 'a_ki',
                                'am_ka', 'am_ki',
                                'm_ka', 'm_ki',
                                'pm_ka', 'pm_ki',
                                'p_ka', 'p_ki',
                                'pl_ka', 'pl_ki',
                                'l_ka', 'l_ki',
                                'al_ka', 'al_ki'
                            ];

                            fields.forEach((field, index) => {
                                $('#k' + (index + 1)).text(norm[field] ?? '-');
                            });

                            // ========================== COMPOSITE SCORE ==========================
                            let comp = response.tes.composite_score || {};

                            let sumKiri = [
                                comp.a_ki, comp.am_ki, comp.m_ki, comp.pm_ki,
                                comp.p_ki, comp.pl_ki, comp.l_ki, comp.al_ki
                            ].join(' + ');

                            let sumKanan = [
                                comp.a_ka, comp.am_ka, comp.m_ka, comp.pm_ka,
                                comp.p_ka, comp.pl_ka, comp.l_ka, comp.al_ka
                            ].join(' + ');

                            let panjang_kiri = parseFloat(response.tes.tungkai_kiri || 1);
                            let panjang_kanan = parseFloat(response.tes.tungkai_kanan || 1);

                            let formulaKiri =
                                `\\( CS_L = \\frac{(${sumKiri}) \\times 100}{8 \\times ${panjang_kiri}} \\)`;
                            let formulaKanan =
                                `\\( CS_R = \\frac{(${sumKanan}) \\times 100}{8 \\times ${panjang_kanan}} \\)`;

                            $('#formulaKiri').text(formulaKiri).css('font-size', '20px');
                            $('#formulaKanan').text(formulaKanan).css('font-size', '20px');

                            if (window.MathJax) {
                                MathJax.typesetPromise();
                            }

                            $('#hasilCSL').text(parseFloat(comp.csl || 0).toFixed(2));
                            $('#hasilCSR').text(parseFloat(comp.csr || 0).toFixed(2));

                            function kategori(val) {
                                if (val > 95) return {
                                    text: "Sangat Baik",
                                    color: "success"
                                };
                                if (val >= 90) return {
                                    text: "Baik",
                                    color: "primary"
                                };
                                if (val >= 85) return {
                                    text: "Cukup",
                                    color: "warning"
                                };
                                return {
                                    text: "Kurang",
                                    color: "danger"
                                };
                            }

                            let ksl = kategori(parseFloat(comp.csl || 0));
                            let ksr = kategori(parseFloat(comp.csr || 0));

                            $('#kategoriCSL')
                                .text(ksl.text)
                                .removeClass('text-success text-primary text-warning text-danger')
                                .addClass('text-' + ksl.color + ' fs-5');

                            $('#kategoriCSR')
                                .text(ksr.text)
                                .removeClass('text-success text-primary text-warning text-danger')
                                .addClass('text-' + ksr.color + ' fs-5');

                            let d_kanan = response.tes.data_kanan || {};
                            let d_kiri = response.tes.data_kiri || {};

                            let nilaiPertamaKanan = parseFloat(d_kanan.a1 || 0);
                            let nilaiPertamaKiri = parseFloat(d_kiri.a1 || 0);

                            let selisih = Math.abs(nilaiPertamaKiri - nilaiPertamaKanan);
                            let sisiDominan = nilaiPertamaKiri > nilaiPertamaKanan ?
                                "Kiri lebih baik" :
                                nilaiPertamaKanan > nilaiPertamaKiri ? "Kanan lebih baik" :
                                "Seimbang";

                            let statusCidera = selisih > 4 ? "Cidera" : "Tidak Cidera";

                            let hasil = document.getElementById('hasilComposite');
                            if (hasil) {
                                hasil.innerHTML = `
                                    <div class="text-center my-4">
                                        <h3 class="fw-bold mb-1">Keseimbangan Anterior</h3>
                                        <small class="text-muted">Selisih dari Anterior</small>
                                    </div>

                                    <div class="bg-light rounded-3 p-3">
                                        <div class="row text-center align-items-center">

                                            <div class="col-12 col-sm-3 mb-2 mb-sm-0 border-start">
                                                <div class="text-muted small">Anterior (A)</div>
                                                <div class="fw-bold fs-6">
                                                    <span class="text-primary">${nilaiPertamaKanan.toFixed(2)}</span>
                                                    <span class="mx-1">|</span>
                                                    <span class="text-danger">${nilaiPertamaKiri.toFixed(2)}</span>
                                                </div>
                                            </div>

                                            <div class="col-12 col-sm-3 border-start">
                                                <div class="text-muted small">Selisih</div>
                                                <div class="fs-5 fw-bold">
                                                    ${selisih.toFixed(2)}
                                                </div>
                                            </div>

                                            <div class="col-12 col-sm-3 mb-2 mb-sm-0 border-start">
                                                <div class="text-muted small">Keterangan</div>
                                                <div class="fw-bold">
                                                    ${sisiDominan}
                                                </div>
                                            </div>

                                            <div class="col-12 col-sm-3 mb-2 mb-sm-0 border-start">
                                                <div class="text-muted small">Status</div>
                                                <div class="fw-semibold">
                                                    ${statusCidera}
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                `;
                            }


                            // ========================== GRAFIK ========================== //
                            function renderBarChart(comp) {

                                const canvas = document.getElementById('barChart');

                                // ambil chart yang sudah ada di canvas
                                let existingChart = Chart.getChart(canvas);

                                if (existingChart) {
                                    existingChart.destroy();
                                }

                                const ctx = canvas.getContext('2d');

                                let labels = ['A', 'AM', 'M', 'PM', 'P', 'PL', 'L', 'AL'];

                                let dataKanan = [
                                    parseFloat(comp.a_ka || 0),
                                    parseFloat(comp.am_ka || 0),
                                    parseFloat(comp.m_ka || 0),
                                    parseFloat(comp.pm_ka || 0),
                                    parseFloat(comp.p_ka || 0),
                                    parseFloat(comp.pl_ka || 0),
                                    parseFloat(comp.l_ka || 0),
                                    parseFloat(comp.al_ka || 0)
                                ];

                                let dataKiri = [
                                    parseFloat(comp.a_ki || 0),
                                    parseFloat(comp.am_ki || 0),
                                    parseFloat(comp.m_ki || 0),
                                    parseFloat(comp.pm_ki || 0),
                                    parseFloat(comp.p_ki || 0),
                                    parseFloat(comp.pl_ki || 0),
                                    parseFloat(comp.l_ki || 0),
                                    parseFloat(comp.al_ki || 0)
                                ];

                                barChartInstance = new Chart(ctx, {
                                    type: 'bar',
                                    data: {
                                        labels: labels,
                                        datasets: [{
                                                label: 'Kanan',
                                                data: dataKanan,
                                                backgroundColor: 'rgba(54,162,235,0.7)'
                                            },
                                            {
                                                label: 'Kiri',
                                                data: dataKiri,
                                                backgroundColor: 'rgba(255,99,132,0.7)'
                                            }
                                        ]
                                    },
                                    options: {
                                        responsive: true,
                                        animation: false,
                                        scales: {
                                            y: {
                                                beginAtZero: true,
                                                max: 160
                                            }
                                        }
                                    }
                                });
                            }

                            renderBarChart(comp);
                        }

                    });

                });

                $(document).on('click', '.btn-delete', function() {
                    let id = $(this).data('id');
                    Swal.fire({
                        title: 'Yakin ingin menghapus?',
                        text: "Data yang dihapus tidak bisa dikembalikan",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, hapus',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: "DELETE",
                                url: "/riwayat/" + id,
                                data: {
                                    _token: "{{ csrf_token() }}"
                                },
                                success: function(response) {

                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil',
                                        text: 'Data berhasil dihapus'
                                    }).then(() => {
                                        location.reload();
                                    });

                                },

                                error: function(xhr) {

                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Gagal',
                                        text: 'Data gagal dihapus'
                                    });
                                }
                            });
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
