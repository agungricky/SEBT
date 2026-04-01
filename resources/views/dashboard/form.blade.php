<div class="row mt-1">
    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-1 pb-0">Form Data Diri</h4>
                <p class="card-description mb-3">
                    Mohon masukan data diri atlit dengan data yang BENAR.
                </p>

                <form id="form">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" name="nama" id="nama" class="form-control form-control-sm"
                                    placeholder="" required>
                                <div id="suggestion-box" class="list-group position-absolute" style="width: 250px">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="umur">Umur</label>
                                <input type="text" name="umur" id="umur"
                                    class="form-control form-control-sm only-number" placeholder="" min="1"
                                    required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <select name="jenis_kelamin" id="jenis_kelamin" class="form-select form-select-sm"
                                    required>
                                    <option value="">-</option>
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
                                    class="form-control form-control-sm" placeholder="" required>
                            </div>
                        </div>

                        <!-- Panjang Tungkai -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="tungkai_kanan">Tungkai Kanan(cm)</label>
                                <input type="text" name="tungkai_kanan" id="tungkai_kanan"
                                    class="form-control form-control-sm only-number" placeholder="" step="0.1"
                                    required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="tungkai_kiri">Tungkai Kiri(cm)</label>
                                <input type="text" name="tungkai_kiri" id="tungkai_kiri"
                                    class="form-control form-control-sm only-number" placeholder="" step="0.1"
                                    required>
                            </div>
                        </div>

                        <!-- Keterangan Tambahan -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="keterangan">Keterangan Tambahan</label>
                                <textarea name="keterangan" id="keterangan" class="form-control form-control-sm" rows="2" placeholder=""></textarea>
                            </div>
                        </div>

                    </div>
                </form>

            </div>
        </div>
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

                    <button type="button" class="btn btn-primary btn-sm d-none" id="submitData">
                        Kirim Data
                    </button>

                </div>
                <p id="formText">Lakukan pengujian untuk mengetahui hasil analisis Anda.</p>
            </div>
        </div>
    </div>
</div>

@push('styles')
    <style>
        .form-control,
        .form-select,
        textarea {
            border: 1.5px solid #c3c9cc;
        }

        .form-control:focus,
        .form-select:focus,
        textarea:focus {
            border-color: #0d6efd;
            box-shadow: none;
        }
    </style>
@endpush

@push('scripts')
    <script>
        window.appConfig = {
            jeda: {{ Cache::get('jeda_waktu', 2) }},
            tes: {{ Cache::get('waktu_tes', 2) }}
        };

        $('.only-number').on('input', function() {
            let value = $(this).val();
            value = value.replace(/[^0-9.]/g, '');
            let parts = value.split('.');
            if (parts.length > 2) {
                value = parts[0] + '.' + parts.slice(1).join('');
            }

            $(this).val(value);
        });
    </script>
@endpush
