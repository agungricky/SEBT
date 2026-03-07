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
                                    <div id="suggestion-box" class="list-group position-absolute" style="width: 250px"></div>
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

                    <button type="button" class="btn btn-primary btn-sm d-none" id="submitData">
                        Kirim Data
                    </button>

                </div>
                <p id="formText">Lakukan pengujian untuk mengetahui hasil analisis Anda.</p>
            </div>
        </div>
    </div>
</div>


@push('scripts')
    <script>
        window.appConfig = {
            jeda: {{ Cache::get('jeda_waktu', 5) }}
        };

        $('#nama').on('keyup', function() {

            let keyword = $(this).val();

            if (keyword.length < 2) {
                $('#suggestion-box').empty();
                return;
            }

            $.ajax({
                url: '/user',
                type: 'GET',
                data: {
                    q: keyword
                },
                success: function(data) {

                    let box = $('#suggestion-box');
                    box.empty();

                    data.forEach(function(user) {
                        box.append(`
                    <a href="#" class="list-group-item list-group-item-action pilih-user"
                        data-id="${user.id}"
                        data-nama="${user.nama}">
                        ${user.nama}
                    </a>
                `);
                    });

                }
            });

        });

        // klik salah satu nama
        $(document).on('click', '.pilih-user', function(e) {
            e.preventDefault();

            let nama = $(this).data('nama');
            $('#nama').val(nama);

            $('#suggestion-box').empty();
        });
    </script>
@endpush
