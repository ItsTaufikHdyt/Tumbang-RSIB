<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <title>Laporan Perkembangan {{ $child->name }}</title>

    <style>
        @page {
            margin: 25px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #222;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h2 {
            margin: 0;
        }

        .header p {
            margin: 4px 0;
        }

        .section-title {
            font-size: 13px;
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 8px;
            border-bottom: 1px solid #444;
            padding-bottom: 4px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        th,
        td {
            border: 1px solid #999;
            padding: 6px;
            vertical-align: top;
        }

        th {
            background: #eee;
        }

        .no-border td {
            border: none;
            padding: 3px;
        }

        .text-center {
            text-align: center;
        }

        .page-break {
            page-break-before: always;
        }

        .report-header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0;
        }

        .report-header-table td {
            border: none;
            padding: 0;
            vertical-align: middle;
        }

        .header-logo-cell {
            width: 18%;
            text-align: center;
        }

        .header-content-cell {
            width: 64%;
            text-align: center;
        }

        .header-spacer-cell {
            width: 18%;
        }

        .header-logo-image {
            width: 85px;
            height: auto;
        }

        .hospital-name {
            font-size: 17px;
            font-weight: bold;
        }

        .clinic-name {
            margin-top: 3px;
            font-size: 19px;
            font-weight: bold;
        }

        .report-name {
            margin-top: 5px;
            font-size: 13px;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .header-line {
            border-top: 3px solid #222;
            border-bottom: 1px solid #222;
            height: 4px;
            margin-top: 8px;
            margin-bottom: 25px;
        }
    </style>
</head>

<body>

    <table class="report-header-table">
        <tr>

            <td class="header-logo-cell">

                <img src="{{ public_path('images/rsib.png') }}" alt="Logo RSIB" class="header-logo-image">

            </td>

            <td class="header-content-cell">

                <div class="hospital-name">
                    RUMAH SAKIT ISLAM BONTANG
                </div>

                <div class="clinic-name">
                    TUMBANG SMART KIDS
                </div>

                <div class="report-name">
                    LAPORAN PERKEMBANGAN ANAK
                </div>

            </td>

            <td class="header-spacer-cell">
                &nbsp;
            </td>

        </tr>
    </table>

    <div class="header-line"></div>

    <div class="section-title">
        Identitas Anak
    </div>

    <table class="no-border">

        <tr>
            <td width="25%">Nama Anak</td>
            <td>: {{ $child->name }}</td>
        </tr>

        <tr>
            <td>Tempat, Tanggal Lahir</td>
            <td>
                :
                {{ $child->place_of_birth ?? '-' }}, {{ optional($child->date_of_birth)->format('d-m-Y') }}
            </td>
        </tr>

        <tr>
            <td>Jenis Kelamin</td>
            <td>
                :
                {{ $child->gender === 'L' ? 'Laki-laki' : 'Perempuan' }}
            </td>
        </tr>

        <tr>
            <td>Nama Ayah</td>
            <td>: {{ $child->father ?? '-' }}</td>
        </tr>

        <tr>
            <td>Nama Ibu</td>
            <td>: {{ $child->mother ?? '-' }}</td>
        </tr>

        <tr>
            <td>Alamat</td>
            <td>: {{ $child->address ?? '-' }}</td>
        </tr>

    </table>

    <div class="section-title">
        Keterangan Skor
    </div>

    <table>

        <thead>
            <tr>
                <th width="15%">Skor</th>
                <th>Keterangan</th>
            </tr>
        </thead>

        <tbody>

            <tr>
                <td class="text-center">0</td>
                <td>Full Prompted / Dibantu Penuh</td>
            </tr>

            <tr>
                <td class="text-center">3</td>
                <td>70% Prompted / Dibantu Sebagian Besar</td>
            </tr>

            <tr>
                <td class="text-center">7</td>
                <td>30% Prompted / Dibantu Sedikit</td>
            </tr>

            <tr>
                <td class="text-center">10</td>
                <td>No Prompted / Mandiri</td>
            </tr>

        </tbody>

    </table>


    <div class="section-title">
        Riwayat Perkembangan
    </div>

    @foreach ($child->childActivities as $activity)

    <h4>
        {{ $activity->activity_no }}.
        {{ $activity->activity_name }}
    </h4>

    <table>

        <thead>
            <tr>
                <th width="10%">No</th>
                <th width="25%">Tanggal</th>
                <th width="15%">Skor</th>
                <th>Keterangan</th>
            </tr>
        </thead>

        <tbody>

            @php
            $details = $activity->evaluationDetails
            ->sortBy(
            fn ($detail) =>
            $detail->session->evaluation_date
            );
            @endphp

            @forelse ($details as $detail)

            <tr>

                <td class="text-center">
                    {{ $loop->iteration }}
                </td>

                <td class="text-center">
                    {{
                    $detail
                    ->session
                    ->evaluation_date
                    ->format('d-m-Y')
                    }}
                </td>

                <td class="text-center">
                    {{ $detail->score }}
                </td>

                <td>

                    @switch($detail->score)

                    @case(0)
                    Dibantu penuh
                    @break

                    @case(3)
                    70% prompted
                    @break

                    @case(7)
                    30% prompted
                    @break

                    @case(10)
                    Mandiri
                    @break

                    @default
                    -

                    @endswitch

                </td>

            </tr>

            @empty

            <tr>
                <td colspan="4" class="text-center">
                    Belum ada evaluasi
                </td>
            </tr>

            @endforelse

        </tbody>

    </table>

    @endforeach


    <div class="section-title">
        Riwayat Konsultasi
    </div>

    <table>

        <thead>

            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Terapis</th>
                <th>Catatan</th>
            </tr>

        </thead>

        <tbody>

            @foreach (
            $child->evaluationSessions
            ->sortBy('evaluation_date')
            as $session
            )

            <tr>

                <td class="text-center">
                    {{ $loop->iteration }}
                </td>

                <td class="text-center">
                    {{
                    $session
                    ->evaluation_date
                    ->format('d-m-Y')
                    }}
                </td>

                <td>
                    {{ $session->evaluator?->name ?? '-' }}
                </td>

                <td>
                    {{ $session->notes ?? '-' }}
                </td>

            </tr>

            @endforeach

        </tbody>

    </table>


</body>

</html>