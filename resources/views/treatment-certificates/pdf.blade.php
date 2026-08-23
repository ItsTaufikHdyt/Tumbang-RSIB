<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <title>
        Surat Keterangan Dalam Perawatan
    </title>

    <style>
        @page {
            size: A4 portrait;
            margin: 18mm 20mm 20mm 20mm;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: "Times New Roman", serif;
            font-size: 12pt;
            line-height: 1.45;
            color: #000;
        }

        .kop-table {
            width: 100%;
            border-collapse: collapse;
        }

        .kop-table td {
            border: none;
            vertical-align: middle;
        }

        .logo-cell {
            width: 22%;
            text-align: center;
        }

        .logo {
            width: 95px;
        }

        .title-cell {
            width: 78%;
            text-align: center;
        }

        .smart-kids {
            font-family: DejaVu Sans, sans-serif;
            font-size: 24pt;
            font-weight: bold;
            font-style: italic;
            color: #138cc8;
            letter-spacing: 2px;
            margin: 0;
        }

        .clinic-title {
            font-family: DejaVu Sans, sans-serif;
            font-size: 16pt;
            font-weight: bold;
            color: #00a7df;
            margin: 0;
        }

        .address {
            text-align: center;
            font-family: DejaVu Sans, sans-serif;
            font-size: 9pt;
            margin-top: 4px;
        }

        .province {
            text-align: center;
            font-family: DejaVu Sans, sans-serif;
            font-size: 10pt;
            margin-top: 3px;
        }

        .kop-line {
            border: 0;
            border-top: 3px solid #000;
            margin: 6px 0 10px;
        }

        .letter-title {
            text-align: center;
            text-decoration: underline;
            font-weight: bold;
            font-size: 14pt;
        }

        .letter-number {
            text-align: center;
            margin-top: 2px;
            margin-bottom: 18px;
        }

        .identity {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            margin-bottom: 12px;
        }

        .identity td {
            border: none;
            padding: 3px 0;
            vertical-align: top;
        }

        .identity .label {
            width: 27%;
        }

        .identity .separator {
            width: 4%;
            text-align: center;
        }

        .paragraph {
            text-align: justify;
            margin: 10px 0;
        }

        .signature-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 55px;
        }

        .signature-table td {
            border: none;
        }

        .signature-left {
            width: 50%;
        }

        .signature-right {
            width: 50%;
            text-align: center;
        }

        .signature-space {
            height: 75px;
        }

        .signature-image {
            max-height: 75px;
            max-width: 190px;
        }

        .signer-name {
            font-weight: bold;
            text-decoration: underline;
        }
    </style>

</head>

<body>

{{-- KOP --}}
<table class="kop-table">

    <tr>

        <td class="logo-cell">

            <img
                src="{{ public_path('images/rsib.png') }}"
                class="logo"
                alt="RSIB"
            >

        </td>

        <td class="title-cell">

            <div class="smart-kids">
                SMART KIDS
            </div>

            <div class="clinic-title">
                KLINIK TUMBUH KEMBANG RSIB
            </div>

        </td>

    </tr>

</table>

<div class="address">
    Jl. Brigjen Katamso No. 40, Belimbing,
    Bontang Barat, Bontang
</div>

<div class="province">
    KALIMANTAN TIMUR
</div>

<hr class="kop-line">

{{-- JUDUL --}}
<div class="letter-title">
    SURAT KETERANGAN DALAM PERAWATAN
</div>

@if ($certificate->letter_number)

    <div class="letter-number">
        Nomor: {{ $certificate->letter_number }}
    </div>

@else

    <div style="height: 15px;"></div>

@endif

<p>
    Dengan ini kami menerangkan bahwa:
</p>

{{-- IDENTITAS --}}
<table class="identity">

    <tr>
        <td class="label">Nama</td>

        <td class="separator">:</td>

        <td>
            {{ $certificate->child->name }}
        </td>
    </tr>

    <tr>
        <td class="label">TTL</td>

        <td class="separator">:</td>

        <td>
            @if ($certificate->child->place_of_birth)
                {{ $certificate->child->place_of_birth }},
            @endif

            {{ $certificate->child->date_of_birth
                ?->locale('id')
                ->translatedFormat('d F Y') }}
        </td>
    </tr>

    <tr>
        <td class="label">Alamat</td>

        <td class="separator">:</td>

        <td>
            {{ $certificate->child->address ?? '-' }}
        </td>
    </tr>

    <tr>
        <td class="label">Diagnosis dr. Rehab</td>

        <td class="separator">:</td>

        <td>
            {{ $certificate->diagnosis ?? '-' }}
        </td>
    </tr>

</table>

{{-- ISI --}}
<p class="paragraph">
    {{ $certificate->statement }}
</p>

<p class="paragraph">
    Demikian surat ini kami buat, atas perhatiannya
    kami ucapkan banyak terima kasih.
</p>

{{-- SIGNATURE --}}
<table class="signature-table">

    <tr>

        <td class="signature-left"></td>

        <td class="signature-right">

            <div>
                Bontang,
                {{ $certificate->letter_date
                    ?->locale('id')
                    ->translatedFormat('d F Y') }}
            </div>

            <div style="margin-top: 8px;">
                {{ $certificate->signer_title }}
            </div>

            <div class="signature-space">

                {{--
                Jika sudah punya gambar tanda tangan:

                <img
                    src="{{ public_path('images/signature.png') }}"
                    class="signature-image"
                >
                --}}

            </div>

            <div class="signer-name">
                {{ $certificate->signer_name }}
            </div>

        </td>

    </tr>

</table>

</body>

</html>