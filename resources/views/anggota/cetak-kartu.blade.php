<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>
        Kartu Anggota - {{ $anggota->nama }}
    </title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
        rel="stylesheet">

    <style>

        * {
            box-sizing: border-box;
        }


        body {

            margin: 0;

            min-height: 100vh;

            background: #f1f4f8;

            font-family:
                Arial,
                Helvetica,
                sans-serif;

            display: flex;

            align-items: center;

            justify-content: center;

        }


        .print-area {

            text-align: center;

        }


        .kartu {

            width: 340px;

            height: 215px;

            background: white;

            border-radius: 15px;

            overflow: hidden;

            box-shadow:
                0 8px 25px rgba(0,0,0,.15);

            position: relative;

        }


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

            text-align: left;

        }


        .kartu-logo {

            width: 45px;

            height: 45px;

            border-radius: 50%;

            background: white;

            padding: 3px;

            object-fit: contain;

        }


        .kartu-header-text strong {

            display: block;

            font-size: 13px;

            letter-spacing: .3px;

        }


        .kartu-header-text small {

            display: block;

            font-size: 9px;

            opacity: .9;

            margin-top: 2px;

        }


        .kartu-body {

            padding: 15px 18px;

            text-align: left;

        }


        .nama {

            color: #173B6C;

            font-size: 18px;

            font-weight: 700;

            margin-bottom: 2px;

            text-transform: uppercase;

        }


        .kode {

            color: #2F6EB8;

            font-size: 11px;

            font-weight: 600;

            margin-bottom: 10px;

        }


        .data {

            display: grid;

            grid-template-columns: 65px 1fr;

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


        .status {

            position: absolute;

            right: 15px;

            bottom: 15px;

            padding: 4px 9px;

            border-radius: 20px;

            font-size: 9px;

            font-weight: 700;

            background: #198754;

            color: white;

        }


        .footer {

            position: absolute;

            left: 0;

            right: 0;

            bottom: 0;

            height: 4px;

            background: #2F6EB8;

        }


        .print-button {

            margin-top: 25px;

            border: none;

            background: #173B6C;

            color: white;

            padding: 10px 20px;

            border-radius: 8px;

            cursor: pointer;

            font-weight: 600;

        }


        .print-button:hover {

            background: #2F6EB8;

        }


 @media print {

    @page {

        size: auto;

        margin: 0;

    }


    * {

        -webkit-print-color-adjust: exact !important;

        print-color-adjust: exact !important;

    }


    html,
    body {

        width: 100%;

        min-height: 100%;

        margin: 0;

        padding: 0;

        background: white !important;

    }


    .print-area {

        width: 100%;

        min-height: 100vh;

        display: flex;

        align-items: flex-start;

        justify-content: center;

        padding-top: 20px;

    }


    .kartu {

        width: 340px;

        height: 215px;

        box-shadow: none !important;

        border: 1px solid #173B6C;

        -webkit-print-color-adjust: exact !important;

        print-color-adjust: exact !important;

    }


    .kartu-header {

        background:
            linear-gradient(
                135deg,
                #173B6C,
                #2F6EB8
            ) !important;

        color: white !important;

        -webkit-print-color-adjust: exact !important;

        print-color-adjust: exact !important;

    }


    .kartu-logo {

        background: white !important;

    }


    .status {

        background: #198754 !important;

        color: white !important;

        -webkit-print-color-adjust: exact !important;

        print-color-adjust: exact !important;

    }


    .footer {

        background: #2F6EB8 !important;

        -webkit-print-color-adjust: exact !important;

        print-color-adjust: exact !important;

    }


    .print-button {

        display: none !important;

    }

}

    </style>

</head>


<body>


<div class="print-area">


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
                <small>
                    Jl. Flamboyan Raya Gg. KH. Ahmad Dahlan No. 22,
                </small>

            </div>

        </div>



        {{-- BODY --}}

        <div class="kartu-body">


            <div class="nama">

                {{ $anggota->nama }}

            </div>


            <div class="kode">

                {{ $anggota->kode_anggota }}

            </div>


            <div class="data">


                <div class="label">
                    NIS
                </div>

                <div class="value">
                    {{ $anggota->nis }}
                </div>


                <div class="label">
                    Kelas
                </div>

                <div class="value">

                    {{ $anggota->kelas->nama_kelas ?? '-' }}

                </div>


                <div class="label">
                    Gender
                </div>

                <div class="value">

                    {{ $anggota->jenis_kelamin === 'L'
                        ? 'Laki-laki'
                        : 'Perempuan' }}

                </div>


                <div class="label">
                    No. HP
                </div>

                <div class="value">

                    {{ $anggota->no_hp ?? '-' }}

                </div>


            </div>

        </div>



        {{-- STATUS --}}

        <div class="status">

            ● {{ $anggota->status }}

        </div>


        <div class="footer"></div>

    </div>



    <button
        type="button"
        class="print-button"
        onclick="window.print()">

        <i class="bi bi-printer"></i>

        Cetak Kartu

    </button>

</div>


</body>

</html>