@extends('layout.main')
@section('content')
    @push('styles')
        <style>
            #pieChart {
                margin-top: 20px;
                /* filter: drop-shadow(0 10px 20px rgba(0, 0, 0, 0.08)); */
            }

            #pieChart text {
                font-weight: 600;
                font-size: 15px;
                fill: #495057;
                text-anchor: middle;
                dominant-baseline: middle;
                pointer-events: none;
                transition: fill 0.3s ease;
            }

            #pieChart path.active+text,
            #pieChart path.active~text {
                fill: #ffffff;
            }

            #activeLabel {
                font-size: 22px;
                color: #0d6efd;
                letter-spacing: 1px;
            }

            #countdown {
                margin-top: 5px;
                font-size: 18px;
                font-weight: 500;
                color: #6c757d;
                letter-spacing: 2px;
            }

            h4 {
                font-weight: 500;
                color: #343a40;
            }

            #pieChart path {
                fill: url(#sliceGradient);
                stroke: #ffffff;
                stroke-width: 2;
                transition: all 0.3s ease;
                transform-origin: 150px 150px;
                filter: drop-shadow(0 6px 10px rgba(0, 0, 0, 0.08));
            }

            #pieChart path.active {
                fill: url(#sliceGradientActive);
                /* transform: translateY(-10px) scale(1.03); */
                /* filter: drop-shadow(0 20px 25px rgba(15, 157, 88, 0.35)); */
            }

            .card {
                border-radius: 10px !important;
            }

            .formula {
                display: block;
                max-width: 100%;
                font-size: clamp(11px, 1.4vw, 18px);
                line-height: 1.3;
            }

            .formula mjx-container {
                max-width: 100% !important;
            }

            .score-text {
                font-size: clamp(12px, 1.6vw, 16px);
            }

            .score-value {
                font-size: clamp(14px, 2vw, 18px);
            }
        </style>
    @endpush

    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="content-wrapper">
                @include('dashboard.form')

                <div class="row mt-1">
                    <div class="col-md-4 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="section-title">
                                    <h3 class="title">Pengujian</h3>
                                    <p class="subtitle">Chart Pemandu Pengujian.</p>
                                </div>
                                <hr width="100%" class="my-3 p-0">

                                <div class="text-center">
                                    <div class="container mt-4">
                                        <div class="row text-center align-items-center g-3">

                                            <div class="col-md">
                                                <div class="p-3 rounded-4 shadow-sm bg-light">
                                                    <div class="text-muted small">Kaki</div>
                                                    <div class="fw-bold fs-5" id="rkaki">-</div>
                                                </div>
                                            </div>

                                            <div class="col-md">
                                                <div class="p-3 rounded-4 shadow-sm bg-light">
                                                    <div class="text-muted small">Step</div>
                                                    <div class="fw-bold fs-5" id="steps">-</div>
                                                </div>
                                            </div>

                                            <div class="col-md">
                                                <div class="p-3 rounded-4 shadow-sm bg-light">
                                                    <div class="text-muted small">Active</div>
                                                    <div class="fw-bold fs-5 text-primary" id="activeLabel">-</div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>


                                    <svg id="pieChart" width="300" height="320" viewBox="0 0 300 300">
                                        <linearGradient id="sliceGradient" x1="0%" y1="0%" x2="100%"
                                            y2="100%">
                                            <stop offset="0%" stop-color="#c8f7dc" />
                                            <stop offset="100%" stop-color="#7ed6a5" />
                                        </linearGradient>

                                        <linearGradient id="sliceGradientActive" x1="0%" y1="0%"
                                            x2="100%" y2="100%">
                                            <stop offset="0%" stop-color="#34d399" />
                                            <stop offset="100%" stop-color="#0f9d58" />
                                        </linearGradient>
                                    </svg>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-8 grid-margin stretch-card">
                        <div class="card shadow-sm">
                            <div class="card-body">

                                <div class="section-title mb-2">
                                    <h3 class="title">Data Pengujian</h3>
                                    <p class="subtitle">Data pengujian kaki kanan dan kaki kiri.</p>
                                </div>
                                <hr width="100%" class="p-0">

                                @include('dashboard.data_pengujian')
                            </div>
                        </div>
                    </div>
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

                <div class="row d-none" id="bottom_simpan">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card shadow-sm">
                            <div
                                class="d-flex flex-column flex-md-row justify-content-center gap-md-3 align-items-center p-3 text-center text-md-center">

                                <p class="mb-3 mb-md-0">
                                    Data tes selesai dan berhasil melakukan kalkulasi. Simpan sekarang?
                                </p>

                                <button type="button" class="btn btn-primary submitData">
                                    Simpan Sekarang
                                </button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('layout.footer')
        </div>
    </div>
@endsection
