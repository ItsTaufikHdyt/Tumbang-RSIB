<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Preview Surat - {{ $certificate->child->name }}
    </title>

    <style>
        body {
            background: #e5e7eb;
        }

        .paper {
            width: 210mm;
            min-height: 297mm;
            margin: 30px auto;
            padding: 15mm 22mm;
            background: white;
            box-sizing: border-box;
            box-shadow: 0 0 15px rgba(0,0,0,.15);
            font-family: "Times New Roman", serif;
            font-size: 16px;
            line-height: 1.45;
        }

        .kop {
            text-align: center;
        }

        .kop-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
        }

        .logo {
            width: 105px;
            height: auto;
        }

        .smart-kids {
            font-family: Arial, sans-serif;
            font-size: 32px;
            font-weight: bold;
            font-style: italic;
            color: #168ac4;
            letter-spacing: 4px;
            margin: 0;
        }

        .clinic-title {
            font-family: Arial, sans-serif;
            font-size: 24px;
            font-weight: bold;
            color: #00a7df;
            margin: 0;
        }

        .address {
            margin-top: 7px;
            font-family: Arial, sans-serif;
            font-size: 14px;
        }

        .province {
            margin-top: 5px;
            font-family: Arial, sans-serif;
            font-size: 15px;
        }

        .kop-line {
            border: none;
            border-top: 4px solid #111;
            margin-top: 7px;
            margin-bottom: 12px;
        }

        .letter-title {
            text-align: center;
            text-decoration: underline;
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 14px;
        }

        .letter-number {
            text-align: center;
            margin-top: -10px;
            margin-bottom: 20px;
        }

        .identity {
            width: 100%;
            margin: 15px 0;
            border-collapse: collapse;
        }

        .identity td {
            vertical-align: top;
            padding: 4px 0;
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
            margin-top: 14px;
        }

        .signature-wrapper {
            margin-top: 65px;
            display: flex;
            justify-content: flex-end;
        }

        .signature {
            width: 360px;
            text-align: center;
        }

        .signature-space {
            height: 90px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .signature-image {
            max-height: 90px;
            max-width: 220px;
        }

        .signer-name {
            font-weight: bold;
            text-decoration: underline;
        }

        .toolbar {
            width: 210mm;
            margin: 20px auto 0;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .btn {
            text-decoration: none;
            padding: 10px 16px;
            border-radius: 8px;
            font-family: Arial, sans-serif;
            font-size: 14px;
            border: none;
            cursor: pointer;
        }

        .btn-back {
            background: #6b7280;
            color: white;
        }

        .btn-print {
            background: #374151;
            color: white;
        }

        .btn-download {
            background: #dc2626;
            color: white;
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
                padding: 10mm 15mm;
                box-shadow: none;
            }
        }
    </style>
</head>

<body>

<div class="toolbar">
    <a
        href="{{ url()->previous() }}"
        class="btn btn-back"
    >
        ← Kembali
    </a>

    <button
        type="button"
        class="btn btn-print"
        onclick="window.print()"
    >
        Print
    </button>

    <a
        href="{{ route('treatment-certificates.pdf', $certificate) }}"
        class="btn btn-download"
    >
        Download PDF
    </a>
</div>

<div class="paper">

    {{-- KOP SURAT --}}
    <div class="kop">

        <div class="kop-wrapper">

            {{-- Simpan logo di public/images/rsib-logo.png --}}
            <img
                src="{{ asset('images/rsib.png') }}"
                alt="Logo RSIB"
                class="logo"
            >

            <div>
                <h1 class="smart-kids">
                    SMART KIDS
                </h1>

                <h2 class="clinic-title">
                    KLINIK TUMBUH KEMBANG RSIB
                </h2>
            </div>

        </div>

        <div class="address">
            Jl. Brigjen Katamso No. 40, Belimbing,
            Bontang Barat, Bontang
        </div>

        <div class="province">
            KALIMANTAN TIMUR
        </div>

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
    @endif

    <p>
        Dengan ini kami menerangkan bahwa:
    </p>

    {{-- DATA PASIEN --}}
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

    {{-- ISI SURAT --}}
    <p class="paragraph">
        {{ $certificate->statement }}
    </p>

    <p class="paragraph">
        Demikian surat ini kami buat, atas perhatiannya
        kami ucapkan banyak terima kasih.
    </p>

    {{-- TANDA TANGAN --}}
    <div class="signature-wrapper">

        <div class="signature">

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
                Jika nanti ada tanda tangan:

                <img
                    src="{{ asset('images/signature.png') }}"
                    class="signature-image"
                >
                --}}

            </div>

            <div class="signer-name">
                {{ $certificate->signer_name }}
            </div>

        </div>

    </div>

</div>

</body>
</html>