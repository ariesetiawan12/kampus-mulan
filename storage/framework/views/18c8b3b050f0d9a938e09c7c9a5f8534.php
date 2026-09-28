

<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>



<div class="welcome-section mb-4">

    <div class="welcome-left">

        <img
            src="<?php echo e(asset('assets/img/logoo.png')); ?>"
            class="school-logo"
            alt="Logo Sekolah">

        <div>

            <h2>
                Perpustakaan Digital
            </h2>

            <h5>
                SMK Muhammadiyah 9 Medan
            </h5>

            <p>

                Selamat datang kembali,

                <strong>
                    <?php echo e(auth()->user()->nama); ?>

                </strong>

            </p>

            <small>
                "Membangun Budaya Literasi Digital"
            </small>

        </div>

    </div>


    <div class="welcome-right">

        <img
            src="<?php echo e(asset('assets/img/books.png')); ?>"
            class="banner-image"
            alt="Books">

    </div>

</div>





<div class="row">

    

    <div class="col-lg-3 col-md-6 mb-3">

        <a
            href="<?php echo e(route('buku.index')); ?>"
            class="quick-menu">

            <i class="bi bi-book-fill"></i>

            <span>
                Tambah Buku
            </span>

        </a>

    </div>


    

    <div class="col-lg-3 col-md-6 mb-3">

        <a
            href="<?php echo e(route('anggota.index')); ?>"
            class="quick-menu">

            <i class="bi bi-people-fill"></i>

            <span>
                Tambah Anggota
            </span>

        </a>

    </div>


    

    <div class="col-lg-3 col-md-6 mb-3">

        <a
            href="<?php echo e(route('peminjaman.index')); ?>"
            class="quick-menu">

            <i class="bi bi-box-arrow-in-down"></i>

            <span>
                Peminjaman
            </span>

        </a>

    </div>


    

    <div class="col-lg-3 col-md-6 mb-3">

        <a
            href="<?php echo e(route('pengembalian.index')); ?>"
            class="quick-menu">

            <i class="bi bi-arrow-return-left"></i>

            <span>
                Pengembalian
            </span>

        </a>

    </div>

</div>





<div class="row">

    

    <div class="col-lg-3 col-md-6 mb-3">

        <div class="dashboard-card bg-primary">

            <div>

                <h6>
                    Total Buku
                </h6>

                <h2>
                    <?php echo e($totalBuku); ?>

                </h2>

                <small>
                    Buku terdaftar
                </small>

            </div>

            <i class="bi bi-book-half"></i>

        </div>

    </div>



    

    <div class="col-lg-3 col-md-6 mb-3">

        <div class="dashboard-card bg-success">

            <div>

                <h6>
                    Total Anggota
                </h6>

                <h2>
                    <?php echo e($totalAnggota); ?>

                </h2>

                <small>
                    Anggota aktif
                </small>

            </div>

            <i class="bi bi-people-fill"></i>

        </div>

    </div>



    

    <div class="col-lg-3 col-md-6 mb-3">

        <div class="dashboard-card bg-warning">

            <div>

                <h6>
                    Sedang Dipinjam
                </h6>

                <h2>
                    <?php echo e($sedangDipinjam); ?>

                </h2>

                <small>
                    Buku sedang dipinjam
                </small>

            </div>

            <i class="bi bi-journal-bookmark-fill"></i>

        </div>

    </div>



    

    <div class="col-lg-3 col-md-6 mb-3">

        <div class="dashboard-card bg-danger">

            <div>

                <h6>
                    Terlambat
                </h6>

                <h2>
                    <?php echo e($terlambat); ?>

                </h2>

                <small>

                    <?php if($terlambat > 0): ?>

                        Perlu perhatian

                    <?php else: ?>

                        Tidak ada

                    <?php endif; ?>

                </small>

            </div>

            <i class="bi bi-exclamation-circle-fill"></i>

        </div>

    </div>

</div>





<div class="row">

    

    <div class="col-lg-8 mb-3">

        <div class="card h-100">

            <div class="card-header">

                <i class="bi bi-bar-chart-fill me-2"></i>

                Grafik Peminjaman

            </div>

            <div class="card-body">

                <div
                    style="
                        position: relative;
                        height: 300px;
                    ">

                    <canvas id="chartPinjam"></canvas>

                </div>

            </div>

        </div>

    </div>



    

    <div class="col-lg-4 mb-3">

        <div class="card h-100">

            <div class="card-header">

                <i class="bi bi-clock-history me-2"></i>

                Aktivitas Terbaru

            </div>

            <div class="card-body">

                <ul class="list-group list-group-flush">

                    <?php $__empty_1 = true; $__currentLoopData = $aktivitasTerbaru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $aktivitas): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                        <li class="list-group-item px-0">

                            <div class="d-flex align-items-start">

                                

                                <div class="me-3">

                                    <?php if(
                                        $aktivitas->status ===
                                        'Dikembalikan'
                                    ): ?>

                                        <i
                                            class="
                                                bi
                                                bi-arrow-return-left
                                                text-success
                                                fs-5
                                            ">
                                        </i>

                                    <?php elseif(
                                        $aktivitas->status ===
                                        'Terlambat'
                                    ): ?>

                                        <i
                                            class="
                                                bi
                                                bi-exclamation-circle
                                                text-danger
                                                fs-5
                                            ">
                                        </i>

                                    <?php else: ?>

                                        <i
                                            class="
                                                bi
                                                bi-book
                                                text-primary
                                                fs-5
                                            ">
                                        </i>

                                    <?php endif; ?>

                                </div>


                                

                                <div>

                                    <strong>

                                        <?php echo e($aktivitas->anggota->nama ?? '-'); ?>


                                    </strong>


                                    <?php if(
                                        $aktivitas->status ===
                                        'Dikembalikan'
                                    ): ?>

                                        <span>
                                            mengembalikan buku
                                        </span>

                                    <?php elseif(
                                        $aktivitas->status ===
                                        'Terlambat'
                                    ): ?>

                                        <span>
                                            terlambat mengembalikan buku
                                        </span>

                                    <?php else: ?>

                                        <span>
                                            meminjam buku
                                        </span>

                                    <?php endif; ?>


                                    <br>


                                    <small class="text-muted">

                                        <?php echo e($aktivitas->kode_peminjaman); ?>


                                        <?php if(
                                            $aktivitas->tanggal_pinjam
                                        ): ?>

                                            ·

                                            <?php echo e($aktivitas
                                                    ->tanggal_pinjam
                                                    ->format('d-m-Y')); ?>


                                        <?php endif; ?>

                                    </small>

                                </div>

                            </div>

                        </li>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                        <li
                            class="
                                list-group-item
                                text-muted
                                px-0
                            ">

                            <i
                                class="
                                    bi
                                    bi-info-circle
                                    me-2
                                ">
                            </i>

                            Belum ada aktivitas.

                        </li>

                    <?php endif; ?>

                </ul>

            </div>

        </div>

    </div>

</div>





<div class="row">

    

    <div class="col-lg-8 mb-3">

        <div class="card h-100">

            <div class="card-header">

                <i class="bi bi-book me-2"></i>

                Buku Terbaru

            </div>

            <div class="card-body">

                <?php $__empty_1 = true; $__currentLoopData = $bukuTerbaru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $buku): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                    <div
                        class="
                            d-flex
                            align-items-center
                            mb-3
                        ">

                        

                        <div class="me-3">

                            <div
                                class="
                                    rounded-circle
                                    bg-primary
                                    text-white
                                    d-flex
                                    align-items-center
                                    justify-content-center
                                "
                                style="
                                    width: 42px;
                                    height: 42px;
                                ">

                                <i class="bi bi-book"></i>

                            </div>

                        </div>


                        

                        <div>

                            <strong>

                                <?php echo e($buku->judul); ?>


                            </strong>

                            <br>

                            <small class="text-muted">

                                Kode:

                                <?php echo e($buku->kode_buku ?? '-'); ?>


                                <?php if(
                                    isset($buku->pengarang)
                                    &&
                                    $buku->pengarang
                                ): ?>

                                    ·

                                    <?php echo e($buku->pengarang); ?>


                                <?php endif; ?>

                            </small>

                        </div>

                    </div>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                    <div class="text-muted">

                        <i
                            class="
                                bi
                                bi-info-circle
                                me-2
                            ">
                        </i>

                        Belum ada data buku.

                    </div>

                <?php endif; ?>

            </div>

        </div>

    </div>



    

    <div class="col-lg-4 mb-3">

        <div class="card h-100">

            <div class="card-header">

                <i class="bi bi-stars me-2"></i>

                Quote Hari Ini

            </div>

            <div class="card-body d-flex align-items-center">

                <div>

                    <h6
                        id="quote"
                        class="mb-0">

                        "Membaca adalah jendela dunia."

                    </h6>

                </div>

            </div>

        </div>

    </div>

</div>



<?php $__env->stopSection(); ?>





<?php $__env->startPush('scripts'); ?>

<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {


        /* ==================================================
           QUOTE HARI INI
        ================================================== */

        const quotes = [

            'Membaca adalah jendela dunia.',

            'Buku adalah teman terbaik untuk belajar.',

            'Literasi membuka masa depan.',

            'Satu buku dapat membuka banyak wawasan.',

            'Belajar hari ini untuk masa depan yang lebih baik.',

            'Membaca hari ini, membuka peluang esok hari.',

            'Ilmu bertambah ketika kita mau membaca.'

        ];


        const quoteElement =
            document.getElementById('quote');


        if (quoteElement) {

            const randomIndex =
                Math.floor(
                    Math.random() * quotes.length
                );


            quoteElement.innerHTML =
                '✨ ' + quotes[randomIndex];

        }



        /* ==================================================
           GRAFIK PEMINJAMAN
        ================================================== */

        const canvas =
            document.getElementById(
                'chartPinjam'
            );


        if (
            canvas &&
            typeof Chart !== 'undefined'
        ) {


            new Chart(
                canvas,
                {

                    type: 'line',


                    data: {

                        labels:
                            <?php echo json_encode($chartLabels, 15, 512) ?>,


                        datasets: [

                            {

                                label:
                                    'Jumlah Peminjaman',


                                data:
                                    <?php echo json_encode($chartData, 15, 512) ?>,


                                fill: true,


                                tension:
                                    0.4,


                                borderWidth:
                                    3,


                                pointRadius:
                                    4,


                                pointHoverRadius:
                                    6

                            }

                        ]

                    },


                    options: {

                        responsive:
                            true,


                        maintainAspectRatio:
                            false,


                        interaction: {

                            intersect:
                                false,


                            mode:
                                'index'

                        },


                        plugins: {

                            legend: {

                                display:
                                    false

                            },


                            tooltip: {

                                callbacks: {

                                    label:
                                        function (
                                            context
                                        ) {

                                            return (
                                                ' ' +
                                                context.parsed.y +
                                                ' peminjaman'
                                            );

                                        }

                                }

                            }

                        },


                        scales: {

                            y: {

                                beginAtZero:
                                    true,


                                ticks: {

                                    precision:
                                        0

                                }

                            }

                        }

                    }

                }
            );

        }


    }

);

</script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\LENOVO\Herd\kampus_mulan\resources\views/dashboard/index.blade.php ENDPATH**/ ?>