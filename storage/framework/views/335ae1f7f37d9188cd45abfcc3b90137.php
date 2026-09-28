<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Bukti Peminjaman - <?php echo e($peminjaman->kode_peminjaman); ?>

    </title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 30px;
            color: #222;
            background: white;
        }

        .container {
            max-width: 800px;
            margin: auto;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0 0 5px;
            font-size: 24px;
        }

        .header p {
            margin: 0;
            font-size: 14px;
        }

        .line {
            border-bottom: 2px solid #222;
            margin: 15px 0 25px;
        }

        .title {
            text-align: center;
            margin-bottom: 25px;
        }

        .title h2 {
            margin: 0;
            font-size: 20px;
        }

        .info {
            width: 100%;
            margin-bottom: 25px;
            border-collapse: collapse;
        }

        .info td {
            padding: 6px 4px;
            vertical-align: top;
        }

        .info td:first-child {
            width: 180px;
            font-weight: bold;
        }

        .books {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .books th,
        .books td {
            border: 1px solid #555;
            padding: 8px;
        }

        .books th {
            text-align: center;
        }

        .status {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #555;
        }

        .footer {
            margin-top: 60px;
        }

        .signature {
            width: 100%;
            display: flex;
            justify-content: space-between;
            text-align: center;
        }

        .signature-box {
            width: 40%;
        }

        .signature-space {
            height: 80px;
        }

        .buttons {
            text-align: center;
            margin-bottom: 25px;
        }

        .btn {
            padding: 9px 18px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            margin: 3px;
        }

        .btn-print {
            background: #173f73;
            color: white;
        }

        .btn-back {
            background: #777;
            color: white;
            text-decoration: none;
            display: inline-block;
        }

        @media print {

            body {
                padding: 0;
            }

            .buttons {
                display: none;
            }

            .container {
                max-width: none;
            }

        }
        .logo {
            width: 80px;
            height: 80px;
            object-fit: contain;
            margin-bottom: 8px;
    }

    </style>

</head>


<body>


<div class="container">


    

    <div class="buttons">

        <button
            onclick="window.print()"
            class="btn btn-print">

            🖨️ Cetak

        </button>


        <a
            href="<?php echo e(route(
                'peminjaman.index'
            )); ?>"
            class="btn btn-back">

            Kembali

        </a>

    </div>


    

    <div class="header">

            <img
        src="<?php echo e(asset('assets/img/logoo.png')); ?>"
        alt="Logo Sekolah"
        class="logo">

        <h1>
            PERPUSTAKAAN SMKS Muhammadiyah 9 Medan
        </h1>

        <p>
            Bukti sah Peminjaman Buku di perpustaka SMKS Muhammadiyah 9 medan
        </p>

    </div>


    <div class="line"></div>


    

    <div class="title">

        <h2>

            BUKTI PEMINJAMAN

        </h2>

    </div>


    

    <table class="info">

        <tr>

            <td>
                Kode Peminjaman
            </td>

            <td>
                : <?php echo e($peminjaman->kode_peminjaman); ?>

            </td>

        </tr>


        <tr>

            <td>
                Nama Anggota
            </td>

            <td>
                : <?php echo e($peminjaman->anggota->nama ?? '-'); ?>

            </td>

        </tr>


        <tr>

            <td>
                NIS
            </td>

            <td>
                : <?php echo e($peminjaman->anggota->nis ?? '-'); ?>

            </td>

        </tr>


        <tr>

            <td>
                Kelas
            </td>

            <td>
                : <?php echo e($peminjaman->anggota->kelas->nama_kelas ?? '-'); ?>

            </td>

        </tr>


        <tr>

            <td>
                Tanggal Pinjam
            </td>

            <td>
                :
                <?php echo e($peminjaman->tanggal_pinjam->format('d-m-Y')); ?>

            </td>

        </tr>


        <tr>

            <td>
                Jatuh Tempo
            </td>

            <td>
                :
                <?php echo e($peminjaman->tanggal_jatuh_tempo->format('d-m-Y')); ?>

            </td>

        </tr>


        <?php if($peminjaman->tanggal_kembali): ?>

        <tr>

            <td>
                Tanggal Kembali
            </td>

            <td>
                :
                <?php echo e($peminjaman->tanggal_kembali->format('d-m-Y')); ?>

            </td>

        </tr>

        <?php endif; ?>

    </table>


    

    <h3>
        Daftar Buku
    </h3>


    <table class="books">

        <thead>

            <tr>

                <th width="60">
                    No
                </th>

                <th>
                    Kode Buku
                </th>

                <th>
                    Judul Buku
                </th>

            </tr>

        </thead>


        <tbody>

            <?php $__currentLoopData = $peminjaman->detailPeminjamans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <tr>

                <td style="text-align:center">

                    <?php echo e($loop->iteration); ?>


                </td>

                <td>

                    <?php echo e($detail->buku->kode_buku ?? '-'); ?>


                </td>

                <td>

                    <?php echo e($detail->buku->judul ?? '-'); ?>


                </td>

            </tr>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </tbody>

    </table>


    

    <div class="status">

        <strong>
            Status:
        </strong>

        <?php echo e($peminjaman->status); ?>



        <br>


        <strong>
            Denda:
        </strong>

        Rp
        <?php echo e(number_format(
            $peminjaman->denda ?? 0,
            0,
            ',',
            '.'
        )); ?>


    </div>


    

    <?php if($peminjaman->keterangan): ?>

        <p>

            <strong>
                Keterangan:
            </strong>

            <?php echo e($peminjaman->keterangan); ?>

            </p>
         <p>
            <strong>
                NB: apa bila ada kerusakan dan kehilangan buku semua tanggung jawab peminjam buku
            </strong>
        </p>

    <?php endif; ?>


    

    <div class="footer">

        <div class="signature">


            <div class="signature-box">

                <div>
                    Petugas Perpustakaan
                </div>

                <div class="signature-space"></div>

                <strong>
                    (____________________)
                </strong>

            </div>


            <div class="signature-box">

                <div>
                    Peminjam
                </div>

                <div class="signature-space"></div>

                <strong>

                    (
                    <?php echo e($peminjaman->anggota->nama ?? '____________________'); ?>

                    )

                </strong>

            </div>


        </div>

    </div>


</div>


</body>

</html><?php /**PATH C:\Users\LENOVO\Herd\kampus_mulan\resources\views/peminjaman/cetak.blade.php ENDPATH**/ ?>