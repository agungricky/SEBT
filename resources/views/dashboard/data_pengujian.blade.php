<div class="mb-4" id="target">
    <div class="table-responsive" id="data">
        <table class="table foot-table table-hover text-center align-middle w-100 mb-3">
            <thead class="table-primary">
                <tr>
                    <th>Anterior (A)</th>
                    <th>Anteromedial (AM)</th>
                    <th>Medial (M)</th>
                    <th>Posteromedial (PM)</th>
                    <th>Posterior (P)</th>
                    <th>Posterolateral (PL)</th>
                    <th>Lateral (L)</th>
                    <th>Anterolateral (AL)</th>
                </tr>
            </thead>

            <tbody id="timerBody_kanan">
                <tr>
                    <td id="ka1">-</td>
                    <td id="ka4">-</td>
                    <td id="ka7">-</td>
                    <td id="ka10">-</td>
                    <td id="ka13">-</td>
                    <td id="ka16">-</td>
                    <td id="ka19">-</td>
                    <td id="ka22">-</td>
                </tr>

                <tr>
                    <td id="ka2">-</td>
                    <td id="ka5">-</td>
                    <td id="ka8">-</td>
                    <td id="ka11">-</td>
                    <td id="ka14">-</td>
                    <td id="ka17">-</td>
                    <td id="ka20">-</td>
                    <td id="ka23">-</td>
                </tr>

                <tr>
                    <td id="ka3">-</td>
                    <td id="ka6">-</td>
                    <td id="ka9">-</td>
                    <td id="ka12">-</td>
                    <td id="ka15">-</td>
                    <td id="ka18">-</td>
                    <td id="ka21">-</td>
                    <td id="ka24">-</td>
                </tr>
            </tbody>
        </table>

        <table class="table foot-table table-hover text-center align-middle w-100">
            <thead class="table-primary">
                <tr>
                    <th>Anterior (A)</th>
                    <th>Anteromedial (AM)</th>
                    <th>Medial (M)</th>
                    <th>Posteromedial (PM)</th>
                    <th>Posterior (P)</th>
                    <th>Posterolateral (PL)</th>
                    <th>Lateral (L)</th>
                    <th>Anterolateral (AL)</th>
                </tr>
            </thead>

            <tbody id="timerBody_kiri">
                <tr>
                    <td id="ki1">-</td>
                    <td id="ki4">-</td>
                    <td id="ki7">-</td>
                    <td id="ki10">-</td>
                    <td id="ki13">-</td>
                    <td id="ki16">-</td>
                    <td id="ki19">-</td>
                    <td id="ki22">-</td>
                </tr>

                <tr>
                    <td id="ki2">-</td>
                    <td id="ki5">-</td>
                    <td id="ki8">-</td>
                    <td id="ki11">-</td>
                    <td id="ki14">-</td>
                    <td id="ki17">-</td>
                    <td id="ki20">-</td>
                    <td id="ki23">-</td>
                </tr>

                <tr>
                    <td id="ki3">-</td>
                    <td id="ki6">-</td>
                    <td id="ki9">-</td>
                    <td id="ki12">-</td>
                    <td id="ki15">-</td>
                    <td id="ki18">-</td>
                    <td id="ki21">-</td>
                    <td id="ki24">-</td>
                </tr>
            </tbody>

        </table>
    </div>
</div>

@push('styles')
    <style>
        .foot-table {
            border-collapse: separate;
            border-spacing: 0 10px;
            font-size: 14px;
        }

        .foot-table thead th {
            font-weight: 600;
            color: #64748b;
            padding: 10px;
            border: none;
        }

        .foot-table tbody tr {
            background: #f8fafc;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04);
        }

        .foot-table td {
            padding: 14px;
            font-weight: 500;
            color: #334155;
            border: none;
        }

        .foot-table tbody tr td:first-child {
            border-radius: 10px 0 0 10px;
        }

        .foot-table tbody tr td:last-child {
            border-radius: 0 10px 10px 0;
        }

        .foot-table tbody tr:hover {
            background: #eef2ff;
            transition: .2s;
        }
    </style>

    <style>
        .section-title {
            border-left: 4px solid #4f46e5;
            padding-left: 12px;
        }

        .section-title .title {
            font-size: 20px;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 2px;
        }

        .section-title .subtitle {
            font-size: 13px;
            color: #6b7280;
            margin: 0;
        }
    </style>
@endpush
