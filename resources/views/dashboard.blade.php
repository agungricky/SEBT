@extends('layout.main')
@section('content')
    @push('styles')
        <style>
            #pieChart {
                margin-top: 20px;
                filter: drop-shadow(0 10px 20px rgba(0, 0, 0, 0.08));
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
                transform: translateY(-10px) scale(1.03);
                filter: drop-shadow(0 20px 25px rgba(15, 157, 88, 0.35));
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
                                <h4 class="card-title mb-0 pb-0">Pengujian</h4>
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

                                <h4 class="card-title mb-0">Data</h4>
                                <hr class="my-3 mb-4">

                                @include('dashboard.data_pengujian')
                                @include('dashboard.data_normalisasi')
                                @include('dashboard.composite_score')
                                @include('dashboard.grafik')

                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
            <footer class="footer">
                <div class="footer-wrap">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © <a
                                href="https://www.bootstrapdash.com/" target="_blank">bootstrapdash.com
                            </a>2021</span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Only the best <a
                                href="https://www.bootstrapdash.com/" target="_blank"> Bootstrap dashboard </a>
                            templates</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>
@endsection
