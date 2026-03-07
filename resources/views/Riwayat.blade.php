@extends('layout.main')
@section('content')
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
