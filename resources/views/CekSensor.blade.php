@extends('layout.main')
@section('content')
    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">

            <div class="content-wrapper">
                <div class="container">
                    <div class="row mt-5">
                        <div class="col-md-5 m-auto">
                            <div class="card ccard radius-t-0 h-100">
                                <div class="position-tl w-102 border-t-3 brc-primary-tp3 ml-n1px mt-n1px"></div>
                                <!-- the blue line on top -->

                                <div class="card-header pb-3 brc-secondary-l3">
                                    <h5 class="card-title mb-2 mb-md-0 text-dark-m3">
                                        Data Sensor
                                    </h5>
                                </div>

                                <div class="card-body pt-2 pb-1">
                                    <div class="row">
                                        <div class="col-6">
                                            <div role="button"
                                                class="d-flex flex-wrap align-items-center my-2 bgc-secondary-l4 bgc-h-secondary-l3 radius-1 p-25 d-style">
                                                <span
                                                    class="mr-25 w-4 h-4 overflow-hidden text-center border-1 brc-secondary-m2 radius-round shadow-sm d-zoom-2">
                                                    <img alt="Alexa's avatar" src="{{ asset('assets/images/list.png') }}"
                                                        class="h-4 w-4" />
                                                </span>

                                                <span class="text-default-d3 text-90 text-600">
                                                    A1
                                                </span>
                                                <span class="mx-1"> ........... </span>
                                                <span class="ml-auto text-dark-l2 text-nowrap">
                                                    <span class="text-primary" id="a1">0</span>
                                                </span>

                                                <span class="ml-2">
                                                    <i class="fa fa-arrow-up text-green-m1 text-95"></i>
                                                </span>
                                            </div>
                                            <div role="button"
                                                class="d-flex flex-wrap align-items-center my-2 bgc-secondary-l4 bgc-h-secondary-l3 radius-1 p-25 d-style">
                                                <span
                                                    class="mr-25 w-4 h-4 overflow-hidden text-center border-1 brc-secondary-m2 radius-round shadow-sm d-zoom-2">
                                                    <img alt="Alexa's avatar" src="{{ asset('assets/images/list.png') }}"
                                                        class="h-4 w-4" />
                                                </span>

                                                <span class="text-default-d3 text-90 text-600">
                                                    A2
                                                </span>
                                                <span class="mx-1"> ........... </span>
                                                <span class="ml-auto text-dark-l2 text-nowrap">
                                                    <span class="text-primary" id="a2">0</span>
                                                </span>

                                                <span class="ml-2">
                                                    <i class="fa fa-arrow-up text-green-m1 text-95"></i>
                                                </span>
                                            </div>
                                            <div role="button"
                                                class="d-flex flex-wrap align-items-center my-2 bgc-secondary-l4 bgc-h-secondary-l3 radius-1 p-25 d-style">
                                                <span
                                                    class="mr-25 w-4 h-4 overflow-hidden text-center border-1 brc-secondary-m2 radius-round shadow-sm d-zoom-2">
                                                    <img alt="Alexa's avatar" src="{{ asset('assets/images/list.png') }}"
                                                        class="h-4 w-4" />
                                                </span>

                                                <span class="text-default-d3 text-90 text-600">
                                                    A3
                                                </span>
                                                <span class="mx-1"> ........... </span>
                                                <span class="ml-auto text-dark-l2 text-nowrap">
                                                    <span class="text-primary" id="a3">0</span>
                                                </span>

                                                <span class="ml-2">
                                                    <i class="fa fa-arrow-up text-green-m1 text-95"></i>
                                                </span>
                                            </div>
                                            <div role="button"
                                                class="d-flex flex-wrap align-items-center my-2 bgc-secondary-l4 bgc-h-secondary-l3 radius-1 p-25 d-style">
                                                <span
                                                    class="mr-25 w-4 h-4 overflow-hidden text-center border-1 brc-secondary-m2 radius-round shadow-sm d-zoom-2">
                                                    <img alt="Alexa's avatar" src="{{ asset('assets/images/list.png') }}"
                                                        class="h-4 w-4" />
                                                </span>

                                                <span class="text-default-d3 text-90 text-600">
                                                    A4
                                                </span>
                                                <span class="mx-1"> ........... </span>
                                                <span class="ml-auto text-dark-l2 text-nowrap">
                                                    <span class="text-primary" id="a4">0</span>
                                                </span>

                                                <span class="ml-2">
                                                    <i class="fa fa-arrow-up text-green-m1 text-95"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div role="button"
                                                class="d-flex flex-wrap align-items-center my-2 bgc-secondary-l4 bgc-h-secondary-l3 radius-1 p-25 d-style">
                                                <span
                                                    class="mr-25 w-4 h-4 overflow-hidden text-center border-1 brc-secondary-m2 radius-round shadow-sm d-zoom-2">
                                                    <img alt="Alexa's avatar" src="{{ asset('assets/images/list.png') }}"
                                                        class="h-4 w-4" />
                                                </span>

                                                <span class="text-default-d3 text-90 text-600">
                                                    B1
                                                </span>
                                                <span class="mx-1"> ........... </span>
                                                <span class="ml-auto text-dark-l2 text-nowrap">
                                                    <span class="text-primary" id="b1">0</span>
                                                </span>

                                                <span class="ml-2">
                                                    <i class="fa fa-arrow-up text-green-m1 text-95"></i>
                                                </span>
                                            </div>
                                            <div role="button"
                                                class="d-flex flex-wrap align-items-center my-2 bgc-secondary-l4 bgc-h-secondary-l3 radius-1 p-25 d-style">
                                                <span
                                                    class="mr-25 w-4 h-4 overflow-hidden text-center border-1 brc-secondary-m2 radius-round shadow-sm d-zoom-2">
                                                    <img alt="Alexa's avatar" src="{{ asset('assets/images/list.png') }}"
                                                        class="h-4 w-4" />
                                                </span>

                                                <span class="text-default-d3 text-90 text-600">
                                                    B2
                                                </span>
                                                <span class="mx-1"> ........... </span>
                                                <span class="ml-auto text-dark-l2 text-nowrap">
                                                    <span class="text-primary" id="b2">0</span>
                                                </span>

                                                <span class="ml-2">
                                                    <i class="fa fa-arrow-up text-green-m1 text-95"></i>
                                                </span>
                                            </div>
                                            <div role="button"
                                                class="d-flex flex-wrap align-items-center my-2 bgc-secondary-l4 bgc-h-secondary-l3 radius-1 p-25 d-style">
                                                <span
                                                    class="mr-25 w-4 h-4 overflow-hidden text-center border-1 brc-secondary-m2 radius-round shadow-sm d-zoom-2">
                                                    <img alt="Alexa's avatar" src="{{ asset('assets/images/list.png') }}"
                                                        class="h-4 w-4" />
                                                </span>

                                                <span class="text-default-d3 text-90 text-600">
                                                    B3
                                                </span>
                                                <span class="mx-1"> ........... </span>
                                                <span class="ml-auto text-dark-l2 text-nowrap">
                                                    <span class="text-primary" id="b3">0</span>
                                                </span>

                                                <span class="ml-2">
                                                    <i class="fa fa-arrow-up text-green-m1 text-95"></i>
                                                </span>
                                            </div>
                                            <div role="button"
                                                class="d-flex flex-wrap align-items-center my-2 bgc-secondary-l4 bgc-h-secondary-l3 radius-1 p-25 d-style">
                                                <span
                                                    class="mr-25 w-4 h-4 overflow-hidden text-center border-1 brc-secondary-m2 radius-round shadow-sm d-zoom-2">
                                                    <img alt="Alexa's avatar" src="{{ asset('assets/images/list.png') }}"
                                                        class="h-4 w-4" />
                                                </span>

                                                <span class="text-default-d3 text-90 text-600">
                                                    B4
                                                </span>
                                                <span class="mx-1"> ........... </span>
                                                <span class="ml-auto text-dark-l2 text-nowrap">
                                                    <span class="text-primary" id="b4">0</span>
                                                </span>

                                                <span class="ml-2">
                                                    <i class="fa fa-arrow-up text-green-m1 text-95"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('layout.footer')
        </div>
    </div>

    <style>
        .card {
            box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
        }

        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0 solid rgba(0, 0, 0, .125);
            border-radius: 1rem;
        }

        .bgc-h-secondary-l3:hover,
        .bgc-secondary-l3 {
            background-color: #ebeff1 !important;
        }

        .h-4 {
            height: 2rem;
        }

        .w-4 {
            width: 2rem;
        }

        .d-zoom-1,
        .d-zoom-2,
        .d-zoom-3,
        .dh-zoom-1,
        .dh-zoom-2,
        .dh-zoom-3 {
            transition: -webkit-transform 180ms;
            transition: transform 180ms;
            transition: transform 180ms, -webkit-transform 180ms;
        }

        .mr-25,
        .mx-25 {
            margin-right: .75rem !important;
        }

        .p-25 {
            padding: .75rem !important;
        }

        .radius-1 {
            border-radius: .25rem !important;
        }

        [class*=bgc-h-] {
            transition: background-color .15s;
        }

        .text-default-d3 {
            color: #416578 !important;
        }

        .font-bolder,
        .text-600 {
            font-weight: 600 !important;
        }

        .text-90 {
            font-size: .9em !important;
        }


        .bgc-h-secondary-l4:hover,
        .bgc-secondary-l4 {
            background-color: #f2f4f6 !important;
        }

        .text-danger-m1 {
            color: #da3636 !important;
        }

        .text-green-m1 {
            color: #2c8d6a !important;
        }

        .text-95 {
            font-size: .95em !important;
        }
    </style>

    <script>
        $(document).ready(function() {
            setInterval(() => {
                $.ajax({
                    url: 'https://setb-dummy-default-rtdb.asia-southeast1.firebasedatabase.app/usDistanceVal.json',
                    method: 'GET',
                    success: function(res) {
                        $('#a1').text(res.a1);
                        $('#a2').text(res.a2);
                        $('#a3').text(res.a3);
                        $('#a4').text(res.a4);
                        $('#b1').text(res.b1);
                        $('#b2').text(res.b2);
                        $('#b3').text(res.b3);
                        $('#b4').text(res.b4);
                    }
                });

                console.log('data updated');
            }, 500);
        });
    </script>
@endsection
