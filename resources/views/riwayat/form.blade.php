<div class="col-md-8 grid-margin stretch-card">
    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-body">
                    <div class="section-title mb-2">
                        <h3 class="title">Data Diri</h3>
                        <p class="subtitle">Riwayat data diri atlet.</p>
                    </div>
                    <hr width="100%" class="p-0">

                    <form id="form">
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" name="nama" id="nama"
                                        class="form-control form-control-sm" placeholder="" readonly>
                                    <div id="suggestion-box" class="list-group position-absolute" style="width: 250px"></div>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="umur">Umur</label>
                                    <input type="text" name="umur" id="umur"
                                        class="form-control form-control-sm only-number" placeholder="" min="1"
                                        readonly>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" id="jenis_kelamin"
                                        class="form-select form-control form-control-sm" readonly>
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
                                        class="form-control form-control-sm" placeholder="" readonly>
                                </div>
                            </div>

                            <!-- Panjang Tungkai -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="tungkai_kanan">Tungkai Kanan(cm)</label>
                                    <input type="text" name="tungkai_kanan" id="tungkai_kanan"
                                        class="form-control form-control-sm only-number" placeholder="" step="0.1"
                                        readonly>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="tungkai_kiri">Tungkai Kiri(cm)</label>
                                    <input type="text" name="tungkai_kiri" id="tungkai_kiri"
                                        class="form-control form-control-sm only-number" placeholder="" step="0.1"
                                        readonly>
                                </div>
                            </div>

                            <!-- Keterangan Tambahan -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="keterangan">Keterangan Tambahan</label>
                                    <textarea name="keterangan" id="keterangan" class="form-control form-control-sm" rows="2" placeholder="" readonly></textarea>
                                </div>
                            </div>

                        </div>
                    </form>

                </div>
            </div>

            <div class="card shadow-sm mt-4">
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
</div>
