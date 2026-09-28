<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>
        Cetak Kartu Anggota
    </title>


    <style>

        * {
            box-sizing: border-box;
        }


        html,
        body {

            margin: 0;

            padding: 0;

        }


        body {

            background: #eef2f7;

            font-family:
                Arial,
                Helvetica,
                sans-serif;

        }


        /* =================================================
           AREA PRINT
        ================================================= */

        .print-page {

            width: 100%;

            min-height: 100vh;

            padding: 30px;

        }


        .print-header {

            max-width: 800px;

            margin: 0 auto 25px;

            text-align: center;

        }


        .print-header h2 {

            margin: 0 0 5px;

            color: #173B6C;

            font-size: 24px;

        }


        .print-header p {

            margin: 0;

            color: #777;

            font-size: 13px;

        }


        /* =================================================
           GRID KARTU
        ================================================= */

        .kartu-grid {

            max-width: 800px;

            margin: 0 auto;

            display: grid;

            grid-template-columns:
                repeat(2, 340px);

            justify-content: center;

            gap: 25px;

        }


        /* =================================================
           KARTU
        ================================================= */

        .kartu {

            width: 340px;

            height: 215px;

            background: white;

            border-radius: 15px;

            overflow: hidden;

            position: relative;

            box-shadow:
                0 8px 25px rgba(0,0,0,.15);

            page-break-inside: avoid;

            break-inside: avoid;

        }


        /* =================================================
           HEADER KARTU
        ================================================= */

        .kartu-header {

            height: 65px;

            padding: 10px 15px;

            background:
                linear-gradient(
                    135deg,
                    #173B6C,
                    #2F6EB8
                );

            color: white;

            display: flex;

            align-items: center;

            gap: 10px;

        }


        .kartu-logo {

            width: 45px;

            height: 45px;

            border-radius: 50%;

            background: white;

            padding: 3px;

            object-fit: contain;

            flex-shrink: 0;

        }


        .kartu-header-text strong {

            display: block;

            font-size: 13px;

            letter-spacing: .3px;

        }


        .kartu-header-text small {

            display: block;

            margin-top: 2px;

            font-size: 9px;

            opacity: .9;

        }


        /* =================================================
           BODY
        ================================================= */

        .kartu-body {

            padding: 15px 18px;

        }


        .nama {

            margin-bottom: 2px;

            color: #173B6C;

            font-size: 18px;

            font-weight: 700;

            text-transform: uppercase;

        }


        .kode {

            margin-bottom: 10px;

            color: #2F6EB8;

            font-size: 11px;

            font-weight: 600;

        }


        .data {

            display: grid;

            grid-template-columns:
                65px 1fr;

            row-gap: 5px;

            font-size: 10px;

        }


        .data .label {

            color: #777;

        }


        .data .value {

            color: #222;

            font-weight: 600;

        }


        /* =================================================
           STATUS
        ================================================= */

        .status {

            position: absolute;

            right: 15px;

            bottom: 15px;

            padding: 4px 9px;

            border-radius: 20px;

            background: #198754;

            color: white;

            font-size: 9px;

            font-weight: 700;

        }


        .status.nonaktif {

            background: #dc3545;

        }


        /* =================================================
           FOOTER KARTU
        ================================================= */

        .footer {

            position: absolute;

            left: 0;

            right: 0;

            bottom: 0;

            height: 4px;

            background: #2F6EB8;

        }


        /* =================================================
           TOOLBAR
        ================================================= */

        .toolbar {

            margin-bottom: 25px;

            text-align: center;

        }


        .print-button {

            border: none;

            padding: 10px 20px;

            border-radius: 8px;

            background: #173B6C;

            color: white;

            font-weight: 600;

            cursor: pointer;

        }


        .print-button:hover {

            background: #2F6EB8;

        }


        .back-button {

            margin-left: 5px;

            padding: 10px 20px;

            border-radius: 8px;

            background: #6c757d;

            color: white;

            text-decoration: none;

            font-size: 14px;

        }


        /* =================================================
           KALAU DATA KOSONG
        ================================================= */

        .empty {

            max-width: 500px;

            margin: 80px auto;

            padding: 40px;

            text-align: center;

            background: white;

            border-radius: 15px;

            color: #777;

        }


        /* =================================================
           PRINT
        ================================================= */

        @media print {

            @page {

                size: A4 portrait;

                margin: 10mm;

            }


            * {

                -webkit-print-color-adjust:
                    exact !important;

                print-color-adjust:
                    exact !important;

            }


            html,
            body {

                width: 100%;

                min-height: 100%;

                background: white !important;

            }


            .print-page {

                padding: 0;

                min-height: auto;

            }


            .print-header {

                margin-bottom: 15px;

            }


            .print-header h2 {

                font-size: 18px;

            }


            .print-header p {

                font-size: 10px;

            }


            .toolbar {

                display: none !important;

            }


            .kartu-grid {

                max-width: none;

                width: 100%;

                margin: 0;

                grid-template-columns:
                    repeat(2, 340px);

                justify-content: center;

                column-gap: 15px;

                row-gap: 15px;

            }


            .kartu {

                box-shadow: none !important;

                border:
                    1px solid #173B6C;

                -webkit-print-color-adjust:
                    exact !important;

                print-color-adjust:
                    exact !important;

            }


            .kartu-header {

                background:
                    linear-gradient(
                        135deg,
                        #173B6C,
                        #2F6EB8
                    ) !important;

                color: white !important;

            }


            .status {

                background:
                    #198754 !important;

                color: white !important;

            }


            .status.nonaktif {

                background:
                    #dc3545 !important;

            }


            .footer {

                background:
                    #2F6EB8 !important;

            }

        }


    </style>

</head>


<body>


<div class="print-page">


    {{-- =================================================
        HEADER
    ================================================== --}}

    <div class="print-header">

        <h2>
            Kartu Anggota Perpustakaan
        </h2>

        <p>

            @if($status === 'aktif')

                Daftar Anggota Aktif

            @else

                Seluruh Anggota Perpustakaan

            @endif

        </p>

    </div>



    {{-- =================================================
        TOOLBAR
    ================================================== --}}

    <div class="toolbar">

        <button
            type="button"
            class="print-button"
            onclick="window.print()">

            🖨 Cetak Kartu

        </button>


        <a
            href="{{ route('anggota.index') }}"
            class="back-button">

            Kembali

        </a>

    </div>



    {{-- =================================================
        KARTU
    ================================================== --}}

    @if($anggota->count())


        <div class="kartu-grid">


            @foreach($anggota as $item)


                <div class="kartu">


                    {{-- HEADER --}}

                    <div class="kartu-header">


                        <img
                            src="{{ asset('assets/img/logoo.png') }}"
                            class="kartu-logo"
                            alt="Logo">


                        <div class="kartu-header-text">

                            <strong>
                                PERPUSTAKAAN DIGITAL
                            </strong>

                            <small>
                                SMK Muhammadiyah 9 Medan
                            </small>

                        </div>


                    </div>



                    {{-- BODY --}}

                    <div class="kartu-body">


                        <div class="nama">

                            {{ $item->nama }}

                        </div>


                        <div class="kode">

                            {{ $item->kode_anggota }}

                        </div>


                        <div class="data">


                            <div class="label">
                                NIS
                            </div>

                            <div class="value">
                                {{ $item->nis }}
                            </div>


                            <div class="label">
                                Kelas
                            </div>

                            <div class="value">

                                {{ $item->kelas->nama_kelas ?? '-' }}

                            </div>


                            <div class="label">
                                Gender
                            </div>

                            <div class="value">

                                {{
                                    $item->jenis_kelamin === 'L'
                                    ? 'Laki-laki'
                                    : 'Perempuan'
                                }}

                            </div>


                            <div class="label">
                                No. HP
                            </div>

                            <div class="value">

                                {{ $item->no_hp ?? '-' }}

                            </div>


                        </div>

                    </div>



                    {{-- STATUS --}}

                    <div
                        class="status
                        {{ $item->status !== 'Aktif'
                            ? 'nonaktif'
                            : '' }}">

                        ● {{ $item->status }}

                    </div>


                    <div class="footer"></div>


                </div>


            @endforeach


        </div>


    @else


        <div class="empty">

            Tidak ada anggota yang dapat dicetak.

        </div>


    @endif


</div>


</body>

</html>