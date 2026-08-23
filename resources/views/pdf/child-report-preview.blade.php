<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Preview Laporan {{ $child->name }}
    </title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            background: #e5e7eb;
            font-family: Arial, sans-serif;
            color: #222;
        }

        .toolbar {
            width: 210mm;
            margin: 20px auto;

            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .toolbar-title h1 {
            margin: 0;
            font-size: 22px;
        }

        .toolbar-title p {
            margin: 5px 0 0;
            color: #666;
        }

        .actions {
            display: flex;
            gap: 10px;
        }

        .btn {
            display: inline-block;
            padding: 10px 16px;

            border: none;
            border-radius: 6px;

            text-decoration: none;
            cursor: pointer;

            font-size: 14px;
            color: white;
        }

        .btn-back {
            background: #6b7280;
        }

        .btn-print {
            background: #374151;
        }

        .btn-download {
            background: #dc2626;
        }

        .paper {
            width: 210mm;
            min-height: 297mm;

            margin: 0 auto 40px;
            padding: 18mm 20mm;

            background: white;

            box-shadow:
                0 4px 20px rgba(0, 0, 0, 0.15);
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h2 {
            margin: 0;
            font-size: 22px;
        }

        .header p {
            margin: 6px 0 0;
            font-size: 15px;
        }

        .report-header {
            width: 100%;

            display: flex;
            align-items: center;

            padding-bottom: 12px;
        }

        .header-logo {
            width: 120px;

            display: flex;
            align-items: center;
            justify-content: center;
        }

        .header-logo img {
            width: 90px;
            height: auto;

            object-fit: contain;
        }

        .header-content {
            flex: 1;

            text-align: center;
            line-height: 1.35;
        }

        .header-spacer {
            width: 120px;
        }

        .hospital-name {
            font-size: 19px;
            font-weight: bold;
        }

        .clinic-name {
            margin-top: 3px;

            font-size: 21px;
            font-weight: bold;
        }

        .report-name {
            margin-top: 6px;

            font-size: 15px;
            font-weight: bold;

            letter-spacing: 1px;
        }

        .header-line {
            border-top: 3px solid #222;
            border-bottom: 1px solid #222;

            height: 5px;

            margin-bottom: 25px;
        }

        .section-title {
            margin-top: 25px;
            margin-bottom: 12px;

            padding-bottom: 6px;
.report-header {
    width: 100%;

    display: flex;
    align-items: center;

    padding-bottom: 12px;
}

.header-logo {
    width: 120px;

    display: flex;
    align-items: center;
    justify-content: center;
}

.header-logo img {
    width: 90px;
    height: auto;

    object-fit: contain;
}

.header-content {
    flex: 1;

    text-align: center;
    line-height: 1.35;
}

.header-spacer {
    width: 120px;
}

.hospital-name {
    font-size: 19px;
    font-weight: bold;
}

.clinic-name {
    margin-top: 3px;

    font-size: 21px;
    font-weight: bold;
}

.report-name {
    margin-top: 6px;

    font-size: 15px;
    font-weight: bold;

    letter-spacing: 1px;
}

.header-line {
    border-top: 3px solid #222;
    border-bottom: 1px solid #222;

    height: 5px;

    margin-bottom: 25px;
}
            border-bottom: 2px solid #333;

            font-size: 16px;
            font-weight: bold;
        }

        .identity-table {
            width: 100%;
            border-collapse: collapse;
        }

        .identity-table td {
            padding: 5px 0;
            vertical-align: top;
        }

        .identity-table .label {
            width: 170px;
        }

        .identity-table .separator {
            width: 20px;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .data-table th,
        .data-table td {
            border: 1px solid #aaa;
            padding: 8px;
        }

        .data-table th {
            background: #f3f4f6;
            text-align: left;
        }

        .text-center {
            text-align: center;
        }

        .activity {
            margin-top: 20px;
            margin-bottom: 30px;
        }

        .activity-title {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .empty {
            color: #777;
            text-align: center;
        }

        @media print {

            body {
                background: white;
            }

            .toolbar {
                display: none;
            }

            .paper {
                width: auto;
                min-height: auto;

                margin: 0;
                padding: 0;

                box-shadow: none;
            }
        }
    </style>
</head>

<body>

    {{-- Toolbar --}}
    <div class="toolbar">

        <div class="toolbar-title">

            <h1>
                Preview Laporan
            </h1>

            <p>
                {{ $child->name }}
            </p>

        </div>

        <div class="actions">

            <button type="button" class="btn btn-back" onclick="window.close()">
                Kembali
            </button>

            <button type="button" class="btn btn-print" onclick="window.print()">
                Print
            </button>

            <a href="{{ route(
                'children.report.download',
                $child
            ) }}" class="btn btn-download">
                Download PDF
            </a>

        </div>

    </div>


    {{-- Kertas A4 --}}
    <div class="paper">

        {{-- KOP / HEADER LAPORAN --}}
        <div class="report-header">

            <div class="header-logo">
                <img src="{{ asset('images/rsib.png') }}" alt="Logo RSIB">
            </div>

            <div class="header-content">
                <div class="hospital-name">
                    RUMAH SAKIT ISLAM BONTANG
                </div>

                <div class="clinic-name">
                    TUMBANG SMART KIDS
                </div>

                <div class="report-name">
                    LAPORAN PERKEMBANGAN ANAK
                </div>
            </div>

            {{-- Agar judul tetap berada di tengah --}}
            <div class="header-spacer"></div>

        </div>

        <div class="header-line"></div>


        {{-- Identitas --}}
        <div class="section-title">
            Identitas Anak
        </div>

        <table class="identity-table">

            <tr>
                <td class="label">
                    Nama Anak
                </td>

                <td class="separator">
                    :
                </td>

                <td>
                    {{ $child->name }}
                </td>
            </tr>

            <tr>
                <td class="label">
                    Tanggal Lahir
                </td>

                <td class="separator">
                    :
                </td>

                <td>
                    {{ $child->place_of_birth}}, {{ $child->date_of_birth
                    ?->format('d-m-Y') ?? '-' }}
                </td>
            </tr>

            <tr>
                <td class="label">
                    Jenis Kelamin
                </td>

                <td class="separator">
                    :
                </td>

                <td>
                    @if ($child->gender === 'L')
                    Laki-laki
                    @elseif ($child->gender === 'P')
                    Perempuan
                    @else
                    {{ $child->gender ?? '-' }}
                    @endif
                </td>
            </tr>

            <tr>
                <td class="label">
                    Nama Ayah
                </td>

                <td class="separator">
                    :
                </td>

                <td>
                    {{ $child->father ?? '-' }}
                </td>
            </tr>

            <tr>
                <td class="label">
                    Nama Ibu
                </td>

                <td class="separator">
                    :
                </td>

                <td>
                    {{ $child->mother ?? '-' }}
                </td>
            </tr>

            <tr>
                <td class="label">
                    Alamat
                </td>

                <td class="separator">
                    :
                </td>

                <td>
                    {{ $child->address ?? '-' }}
                </td>
            </tr>

        </table>


        {{-- Keterangan skor --}}
        <div class="section-title">
            Keterangan Skor
        </div>

        <table class="data-table">

            <thead>

                <tr>
                    <th style="width: 80px;">
                        Skor
                    </th>

                    <th>
                        Keterangan
                    </th>
                </tr>

            </thead>

            <tbody>

                <tr>
                    <td class="text-center">0</td>
                    <td>Full Prompted / Dibantu penuh</td>
                </tr>

                <tr>
                    <td class="text-center">3</td>
                    <td>70% Prompted</td>
                </tr>

                <tr>
                    <td class="text-center">7</td>
                    <td>30% Prompted</td>
                </tr>

                <tr>
                    <td class="text-center">10</td>
                    <td>No Prompted / Mandiri</td>
                </tr>

            </tbody>

        </table>


        {{-- Riwayat perkembangan --}}
        <div class="section-title">
            Riwayat Perkembangan
        </div>

        @forelse ($child->childActivities as $activity)

        <div class="activity">

            <div class="activity-title">

                {{ $activity->activity_no }}.
                {{ $activity->activity_name }}

            </div>

            @php
            $details = $activity
            ->evaluationDetails
            ->sortBy(
            fn ($detail) =>
            $detail
            ->session
            ->evaluation_date
            );
            @endphp

            <table class="data-table">

                <thead>

                    <tr>

                        <th style="width: 50px;">
                            No
                        </th>

                        <th style="width: 140px;">
                            Tanggal
                        </th>

                        <th style="width: 80px;">
                            Skor
                        </th>

                        <th>
                            Keterangan
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse ($details as $detail)

                    <tr>

                        <td class="text-center">
                            {{ $loop->iteration }}
                        </td>

                        <td class="text-center">

                            {{ $detail
                            ->session
                            ->evaluation_date
                            ->format('d-m-Y') }}

                        </td>

                        <td class="text-center">
                            {{ $detail->score }}
                        </td>

                        <td>

                            @switch((int) $detail->score)

                            @case(0)
                            Dibantu penuh
                            @break

                            @case(3)
                            70% Prompted
                            @break

                            @case(7)
                            30% Prompted
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

                        <td colspan="4" class="empty">
                            Belum ada evaluasi.
                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        @empty

        <p class="empty">
            Belum ada aktivitas.
        </p>

        @endforelse


        {{-- Riwayat konsultasi --}}
        <div class="section-title">
            Riwayat Konsultasi
        </div>

        <table class="data-table">

            <thead>

                <tr>

                    <th style="width: 50px;">
                        No
                    </th>

                    <th style="width: 130px;">
                        Tanggal
                    </th>

                    <th style="width: 160px;">
                        Terapis
                    </th>

                    <th>
                        Catatan
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse (
                $child->evaluationSessions
                ->sortBy('evaluation_date')
                as $session
                )

                <tr>

                    <td class="text-center">
                        {{ $loop->iteration }}
                    </td>

                    <td class="text-center">

                        {{ $session
                        ->evaluation_date
                        ->format('d-m-Y') }}

                    </td>

                    <td>
                        {{ $session->evaluator?->name ?? '-' }}
                    </td>

                    <td>
                        {{ $session->notes ?? '-' }}
                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="4" class="empty">
                        Belum ada riwayat konsultasi.
                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</body>

</html>