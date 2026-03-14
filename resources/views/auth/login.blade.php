<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SEBT - Star Excursion Balance Test</title>

    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/base/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/dashboard/univ.ico') }}" />

    <style>
        body {
            background: linear-gradient(135deg, #4CAF50, #2E7D32);
        }

        .auth-form-light {
            background: #fff;
            border-radius: 12px;
            padding: 40px 30px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease;
        }

        /* .auth-form-light:hover {
            transform: translateY(-5px);
        } */

        .brand-logo img {
            width: 90px;
            margin-bottom: 20px;
        }

        .auth-form input.form-control {
            border-radius: 8px;
            padding: 14px 12px;
            font-size: 14px;
        }

        .auth-form input.form-control:focus {
            box-shadow: 0 0 0 2px rgba(76, 175, 80, 0.3);
            border-color: #4CAF50;
        }

        .auth-form .btn-primary {
            background-color: #4CAF50;
            border-radius: 8px;
            padding: 12px 0;
            font-weight: 600;
            transition: background 0.3s ease;
        }

        .auth-form .btn-primary:hover {
            background-color: #43a047;
        }

        .auth-link {
            font-size: 14px;
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="main-panel">
                <div class="content-wrapper d-flex align-items-center auth px-0" style="min-height: 100vh;">
                    <div class="row w-100 mx-0 justify-content-center">
                        <div class="col-lg-4">
                            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                                <div
                                    class="brand-logo text-center d-flex align-items-center justify-content-center m-0 p-0">

                                    <!-- Logo kiri -->
                                    <img src="{{ asset('assets/images/dashboard/logo.png') }}" alt="logo kiri"
                                        style="width:160px; height:auto; margin-right:10px;">

                                    <!-- Logo kanan -->
                                    <img src="{{ asset('assets/images/dashboard/logo2.png') }}" alt="logo kanan"
                                        style="width:60px; height:auto; margin-left:10px;">

                                </div>
                                <div class="text-center mb-4">
                                    <h3 style="font-weight:700; color:#2C3E50;">
                                        Sistem Analisis Keseimbangan Atlet
                                    </h3>
                                    <h6 style="color:#6c757d;">
                                        Star Excursion Balance Test (SEBT)
                                    </h6>
                                </div>
                                <form class="pt-3" method="POST" action="{{ route('proses-Login') }}">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-lg"
                                            placeholder="Username" name="username">
                                    </div>
                                    <div class="form-group position-relative">
                                        <input type="password" class="form-control form-control-lg pe-5"
                                            placeholder="Password" name="password" id="password">

                                        <span toggle="#password" class="mdi mdi-eye toggle-password"
                                            style="position:absolute; right:15px; top:50%; transform:translateY(-50%); cursor:pointer; font-size:20px;">
                                        </span>
                                    </div>

                                    <div class="mt-3 mb-4">
                                        <button type="submit"
                                            class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
                                            SIGN IN
                                        </button>
                                    </div>
                                    <div class="my-2 d-flex justify-content-between align-items-center">
                                        <div class="form-check">
                                            <label class="form-check-label text-muted">
                                                <input type="checkbox" class="form-check-input">
                                                Keep me signed in
                                            </label>
                                        </div>
                                        <a href="#" class="auth-link text-black">Forgot password?</a>
                                    </div>
                                    <div class="text-center mt-2 font-weight-light">
                                        Don't have an account? <a href="register.html" class="text-primary">Create</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/vendors/base/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('assets/js/template.js') }}"></script>
    <script>
        document.querySelector(".toggle-password").addEventListener("click", function() {
            const input = document.querySelector(this.getAttribute("toggle"));
            const type = input.getAttribute("type") === "password" ? "text" : "password";
            input.setAttribute("type", type);

            this.classList.toggle("mdi-eye");
            this.classList.toggle("mdi-eye-off");
        });
    </script>

</body>

</html>
