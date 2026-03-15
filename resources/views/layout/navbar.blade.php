 <div class="horizontal-menu">
     <nav class="navbar top-navbar col-lg-12 col-12 p-0">
         <div class="container-fluid">
             <div class="navbar-menu-wrapper d-flex align-items-center justify-content-between">
                 <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                     <a class="navbar-brand brand-logo ms-3" href="index.html">
                         <img src="{{ asset('assets/images/dashboard/logo.png') }}" alt="logo"
                             style="width:180px; height:auto;">
                     </a>
                     <a class="navbar-brand brand-logo-mini" href="index.html"><img
                             src="{{ asset('assets/images/dashboard/logo.png') }}" alt="logo" /></a>
                 </div>
                 <ul class="navbar-nav navbar-nav-right">
                     <li class="nav-item d-lg-flex d-none me-2">
                         <a href="{{ route('export.excel') }}" type="button"
                             class="btn btn-inverse-success btn-sm d-flex align-items-center">
                             <i class="mdi mdi-file-excel me-1"></i> Export Excel
                         </a>
                     </li>
                     <li class="nav-item d-lg-flex d-none me-2">
                         <button type="button" class="btn btn-inverse-primary btn-sm d-flex align-items-center"
                             data-bs-toggle="modal" data-bs-target="#modalSetting">
                             <i class="mdi mdi-settings me-1"></i> Settings
                         </button>
                     </li>
                     <li class="nav-item dropdown d-lg-flex d-none">
                         <form method="POST" action="{{ route('logout') }}">
                             @csrf
                             <button type="submit" class="btn btn-inverse-danger btn-sm d-flex align-items-center">
                                 <i class="mdi mdi-logout me-1"></i> Logout
                             </button>
                         </form>
                     </li>

                     {{-- <li class="nav-item nav-profile dropdown">
                         <span class="nav-profile-name">Administrator</span>
                         <span class="online-status"></span>
                         <img src="{{ asset('assets/images/faces/face28.png') }}" alt="profile" />
                     </li> --}}
                 </ul>
                 <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                     data-toggle="horizontal-menu-toggle">
                     <span class="mdi mdi-menu"></span>
                 </button>
             </div>
         </div>
     </nav>

     <!-- Modal -->
     <div class="modal fade" id="modalSetting" tabindex="-1" aria-labelledby="modalSettingLabel" aria-hidden="true">
         <div class="modal-dialog">
             <div class="modal-content">

                 <div class="modal-header">
                     <h5 class="modal-title" id="modalSettingLabel">Setting Jeda Waktu</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                 </div>

                 <form id="formSetting">
                     <div class="modal-body">

                         <div class="mb-3">
                             <label class="form-label">Lama Jeda Waktu (detik)</label>
                             <input type="number" name="jeda_waktu" class="form-control" id="jeda_waktu"
                                 placeholder="Masukkan jeda waktu" required>
                         </div>

                     </div>

                     <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                             Batal
                         </button>
                         <button type="submit" class="btn btn-primary">
                             Submit
                         </button>
                     </div>
                 </form>

             </div>
         </div>
     </div>

     @include('layout.menu')

     <style>
         .navbar-nav-right {
             margin-right: 50px;
         }
     </style>
 </div>
