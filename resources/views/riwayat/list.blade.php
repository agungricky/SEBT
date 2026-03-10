<div class="col-md-4 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">

            <div class="section-title mb-2">
                <h3 class="title">Daftar Atlet</h3>
                <p class="subtitle">Riwayat tes atlet.</p>
            </div>
            <hr width="100%" class="p-0">

            <div class="table-responsive">
                <table id="table-atlet" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Tanggal</th>
                            <th width="100">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataUser as $item)
                            <tr>
                                <td>{{ $item->nama }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->tes->tanggal_tes)->format('d-m-Y') }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <button class="btn btn-sm btn-info btn-view" data-id="{{ $item->id }}">
                                            <i class="mdi mdi-eye"></i>
                                        </button>

                                        <button class="btn btn-sm btn-danger btn-delete" data-id="{{ $item->id }}">
                                            <i class="mdi mdi-delete"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
