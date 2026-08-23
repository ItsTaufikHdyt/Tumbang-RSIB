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
    </style>
</head>

<body>

<div class="header">
    <h2>TUMBANG SMART KIDS RSIB</h2>

    <p>
        Laporan Perkembangan Anak
    </p>
</div>

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
                <td
                    colspan="4"
                    class="text-center"
                >
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