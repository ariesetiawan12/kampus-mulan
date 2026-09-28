<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>
        Laporan Peminjaman
    </title>


    

    <link
        rel="stylesheet"
        href="<?php echo e(asset('assets/css/laporan-print.css')); ?>">

</head>


<body>


<div class="print-container">


    

    <div class="kop-surat">

        <img
            src="<?php echo e(asset('assets/img/logoo.png')); ?>"
            class="logo"
            alt="Logo">


        <div class="kop-text">

            <h1>
                PERPUSTAKAAN DIGITAL
            </h1>

            <h2>
                SMK MUHAMMADIYAH 9 MEDAN
            </h2>

            <p>
                Sistem Informasi Perpustakaan
            </p>

        </div>

    </div>


    <div class="garis"></div>



    

    <div class="judul-laporan">

        <h3>
            LAPORAN PEMINJAMAN BUKU
        </h3>


        <p>

            <?php if($tanggalMulai && $tanggalSelesai): ?>

                Periode
                <?php echo e(\Carbon\Carbon::parse($tanggalMulai)->format('d-m-Y')); ?>

                s/d
                <?php echo e(\Carbon\Carbon::parse($tanggalSelesai)->format('d-m-Y')); ?>


            <?php elseif($tanggalMulai): ?>

                Mulai
                <?php echo e(\Carbon\Carbon::parse($tanggalMulai)->format('d-m-Y')); ?>


            <?php elseif($tanggalSelesai): ?>

                Sampai
                <?php echo e(\Carbon\Carbon::parse($tanggalSelesai)->format('d-m-Y')); ?>


            <?php else: ?>

                Seluruh Data Peminjaman

            <?php endif; ?>

        </p>

    </div>



    

    <table>

        <thead>

            <tr>

                <th width="40">
                    No
                </th>

                <th>
                    Kode
                </th>

                <th>
                    Nama Anggota
                </th>

                <th>
                    NIS
                </th>

                <th>
                    Kelas
                </th>

                <th>
                    Buku
                </th>

                <th>
                    Tgl Pinjam
                </th>

                <th>
                    Jatuh Tempo
                </th>

                <th>
                    Status
                </th>

            </tr>

        </thead>


        <tbody>

            <?php $__empty_1 = true; $__currentLoopData = $peminjaman; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

            <tr>

                <td class="center">

                    <?php echo e($loop->iteration); ?>


                </td>


                <td>

                    <?php echo e($item->kode_peminjaman); ?>


                </td>


                <td>

                    <?php echo e($item->anggota->nama ?? '-'); ?>


                </td>


                <td>

                    <?php echo e($item->anggota->nis ?? '-'); ?>


                </td>


                <td>

                    <?php echo e($item->anggota->kelas->nama_kelas ?? '-'); ?>


                </td>


                <td>

                    <?php if(
                        $item->detailPeminjamans &&
                        $item->detailPeminjamans->count()
                    ): ?>

                        <?php $__currentLoopData = $item->detailPeminjamans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <div>

                                <?php echo e($detail->buku->judul ?? '-'); ?>


                            </div>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php else: ?>

                        -

                    <?php endif; ?>

                </td>


                <td class="center">

                    <?php echo e($item->tanggal_pinjam
                        ? $item->tanggal_pinjam->format('d-m-Y')
                        : '-'); ?>


                </td>


                <td class="center">

                    <?php echo e($item->tanggal_jatuh_tempo
                        ? $item->tanggal_jatuh_tempo->format('d-m-Y')
                        : '-'); ?>


                </td>


                <td class="center">

                    <?php if($item->status === 'Dipinjam'): ?>

                        <span class="status dipinjam">
                            Dipinjam
                        </span>

                    <?php elseif($item->status === 'Terlambat'): ?>

                        <span class="status terlambat">
                            Terlambat
                        </span>

                    <?php else: ?>

                        <span class="status kembali">
                            Dikembalikan
                        </span>

                    <?php endif; ?>

                </td>

            </tr>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

            <tr>

                <td
                    colspan="9"
                    class="empty">

                    Tidak ada data peminjaman.

                </td>

            </tr>

            <?php endif; ?>

        </tbody>

    </table>



    

    <div class="ringkasan">

        <strong>
            Total Transaksi:
        </strong>

        <?php echo e($peminjaman->count()); ?>


    </div>



    

    <div class="ttd">

        <div>

            <p>
                Medan,
                <?php echo e(now()->format('d-m-Y')); ?>

            </p>

            <p>
                Petugas Perpustakaan
            </p>


            <div class="space"></div>


            <strong>
                __________________________
            </strong>

        </div>

    </div>



    

    <div class="toolbar">

        <button
            onclick="window.print()"
            class="btn-print">

            🖨 Cetak Laporan

        </button>


        <button
            onclick="window.close()"
            class="btn-close">

            Tutup

        </button>

    </div>


</div>


<script
    src="<?php echo e(asset('assets/js/laporan-print.js')); ?>">
</script>


</body>

</html><?php /**PATH C:\Users\LENOVO\Herd\kampus_mulan\resources\views/laporan/cetak-peminjaman.blade.php ENDPATH**/ ?>