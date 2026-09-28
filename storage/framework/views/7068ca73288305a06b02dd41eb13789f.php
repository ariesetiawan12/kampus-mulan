

<?php $__env->startSection('title', 'Riwayat Peminjaman'); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header">

    <div>

        <h2>

            <i class="bi bi-clock-history"></i>

            Riwayat Peminjaman

        </h2>

        <p>

            Melihat seluruh riwayat transaksi peminjaman dan pengembalian.

        </p>

    </div>

</div>





<div class="card shadow border-0 mb-4">

    <div class="card-body">

        <form
            method="GET"
            action="<?php echo e(route('riwayat-peminjaman.index')); ?>">

            <div class="row g-3">


                

                <div class="col-md-4">

                    <label class="form-label">

                        Cari

                    </label>

                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        value="<?php echo e(request('search')); ?>"
                        placeholder="Kode, nama atau NIS...">

                </div>



                

                <div class="col-md-2">

                    <label class="form-label">

                        Status

                    </label>

                    <select
                        name="status"
                        class="form-select">

                        <option value="">

                            Semua

                        </option>

                        <option
                            value="Dipinjam"
                            <?php echo e(request('status') == 'Dipinjam' ? 'selected' : ''); ?>>

                            Dipinjam

                        </option>

                        <option
                            value="Terlambat"
                            <?php echo e(request('status') == 'Terlambat' ? 'selected' : ''); ?>>

                            Terlambat

                        </option>

                        <option
                            value="Dikembalikan"
                            <?php echo e(request('status') == 'Dikembalikan' ? 'selected' : ''); ?>>

                            Dikembalikan

                        </option>

                    </select>

                </div>



                

                <div class="col-md-2">

                    <label class="form-label">

                        Dari

                    </label>

                    <input
                        type="date"
                        name="tanggal_mulai"
                        class="form-control"
                        value="<?php echo e(request('tanggal_mulai')); ?>">

                </div>



                

                <div class="col-md-2">

                    <label class="form-label">

                        Sampai

                    </label>

                    <input
                        type="date"
                        name="tanggal_selesai"
                        class="form-control"
                        value="<?php echo e(request('tanggal_selesai')); ?>">

                </div>



                

                <div class="col-md-2 d-flex align-items-end">

                    <div class="d-flex gap-2 w-100">

                        <button
                            type="submit"
                            class="btn btn-primary flex-fill">

                            <i class="bi bi-search"></i>

                            Cari

                        </button>


                        <a
                            href="<?php echo e(route('riwayat-peminjaman.index')); ?>"
                            class="btn btn-danger">

                            <i class="bi bi-x-lg"></i>

                        </a>

                    </div>

                </div>

            </div>

        </form>

    </div>

</div>





<div class="card shadow border-0">

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead>

                    <tr>

                        <th>No</th>

                        <th>Kode</th>

                        <th>Anggota</th>

                        <th>Buku</th>

                        <th>Tgl Pinjam</th>

                        <th>Jatuh Tempo</th>

                        <th>Tgl Kembali</th>

                        <th>Status</th>

                        <th>Denda</th>

                        <th width="120">Aksi</th>

                    </tr>

                </thead>


                <tbody>

                    <?php $__empty_1 = true; $__currentLoopData = $riwayat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                    <tr>


                        

                        <td>

                            <?php echo e($riwayat->firstItem() + $loop->index); ?>


                        </td>



                        

                        <td>

                            <strong>

                                <?php echo e($item->kode_peminjaman); ?>


                            </strong>

                        </td>



                        

                        <td>

                            <strong>

                                <?php echo e($item->anggota->nama ?? '-'); ?>


                            </strong>

                            <br>

                            <small class="text-muted">

                                NIS:
                                <?php echo e($item->anggota->nis ?? '-'); ?>


                            </small>

                        </td>



                        

                        <td>

                            <?php $__empty_2 = true; $__currentLoopData = $item->detailPeminjamans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>

                                <div class="mb-1">

                                    <i class="bi bi-book"></i>

                                    <?php echo e($detail->buku->judul ?? '-'); ?>


                                </div>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_2): ?>

                                -

                            <?php endif; ?>

                        </td>



                        

                        <td>

                            <?php echo e($item->tanggal_pinjam->format('d-m-Y')); ?>


                        </td>



                        

                        <td>

                            <?php echo e($item->tanggal_jatuh_tempo->format('d-m-Y')); ?>


                        </td>



                        

                        <td>

                            <?php if($item->tanggal_kembali): ?>

                                <?php echo e($item->tanggal_kembali->format('d-m-Y')); ?>


                            <?php else: ?>

                                -

                            <?php endif; ?>

                        </td>



                        

                        <td>

                            <?php if($item->status === 'Dikembalikan'): ?>

                                <span class="badge bg-success">

                                    Dikembalikan

                                </span>

                            <?php elseif($item->status === 'Terlambat'): ?>

                                <span class="badge bg-danger">

                                    Terlambat

                                </span>

                            <?php else: ?>

                                <span class="badge bg-primary">

                                    Dipinjam

                                </span>

                            <?php endif; ?>

                        </td>



                        

                        <td>

                            <?php if($item->denda > 0): ?>

                                <span class="text-danger fw-bold">

                                    Rp

                                    <?php echo e(number_format(
                                        $item->denda,
                                        0,
                                        ',',
                                        '.'
                                    )); ?>


                                </span>

                            <?php else: ?>

                                <span class="text-muted">

                                    Rp0

                                </span>

                            <?php endif; ?>

                        </td>



                        

                        <td>

                            <div class="d-flex gap-1">


                                

                                <button
                                    type="button"
                                    class="btn btn-info btn-sm btn-detail-riwayat"
                                    data-url="<?php echo e(route(
                                        'peminjaman.show',
                                        $item->id
                                    )); ?>"
                                    title="Detail">

                                    <i class="bi bi-eye"></i>

                                </button>



                                

                                <a
                                    href="<?php echo e(route(
                                        'peminjaman.cetak',
                                        $item->id
                                    )); ?>"
                                    target="_blank"
                                    class="btn btn-secondary btn-sm"
                                    title="Cetak">

                                    <i class="bi bi-printer"></i>

                                </a>

                            </div>

                        </td>

                    </tr>


                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                    <tr>

                        <td
                            colspan="10"
                            class="text-center py-5">

                            <i
                                class="bi bi-clock-history fs-1 d-block mb-2">
                            </i>

                            Belum ada riwayat peminjaman.

                        </td>

                    </tr>

                    <?php endif; ?>

                </tbody>

            </table>

        </div>



        

        <?php echo e($riwayat->links()); ?>


    </div>

</div>

<?php $__env->stopSection(); ?>





<?php $__env->startPush('scripts'); ?>

<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {


        /*
        |--------------------------------------------------------------------------
        | TOMBOL DETAIL RIWAYAT
        |--------------------------------------------------------------------------
        */

        document
            .querySelectorAll(
                '.btn-detail-riwayat'
            )
            .forEach(
                function (button) {


                    button.addEventListener(
                        'click',
                        function () {


                            const url =
                                this.dataset.url;


                            /*
                            |--------------------------------------------------------------------------
                            | CEK URL
                            |--------------------------------------------------------------------------
                            */

                            if (!url) {

                                Swal.fire({

                                    icon: 'error',

                                    title: 'Error',

                                    text:
                                        'URL detail riwayat tidak ditemukan.'

                                });

                                return;

                            }


                            /*
                            |--------------------------------------------------------------------------
                            | LOADING
                            |--------------------------------------------------------------------------
                            */

                            Swal.fire({

                                title: 'Memuat Data',

                                text:
                                    'Sedang mengambil detail riwayat...',

                                allowOutsideClick:
                                    false,

                                allowEscapeKey:
                                    false,

                                didOpen:
                                    function () {

                                        Swal.showLoading();

                                    }

                            });


                            /*
                            |--------------------------------------------------------------------------
                            | AMBIL DATA
                            |--------------------------------------------------------------------------
                            */

                            fetch(
                                url,
                                {

                                    method: 'GET',

                                    headers: {

                                        'Accept':
                                            'application/json',

                                        'X-Requested-With':
                                            'XMLHttpRequest'

                                    }

                                }
                            )


                            .then(
                                function (response) {


                                    if (
                                        !response.ok
                                    ) {

                                        throw new Error(
                                            'HTTP Error ' +
                                            response.status
                                        );

                                    }


                                    return response.json();

                                }
                            )


                            .then(
                                function (data) {


                                    console.log(
                                        'DATA RIWAYAT:',
                                        data
                                    );


                                    /*
                                    |--------------------------------------------------------------------------
                                    | DAFTAR BUKU
                                    |--------------------------------------------------------------------------
                                    */

                                    let daftarBuku =
                                        '';


                                    if (
                                        data.buku &&
                                        data.buku.length > 0
                                    ) {


                                        daftarBuku =
                                            '<ul class="mb-0 ps-3">';


                                        data.buku.forEach(
                                            function (buku) {


                                                daftarBuku += `

                                                    <li class="mb-1">

                                                        <i class="bi bi-book-fill text-primary"></i>

                                                        <strong>

                                                            ${escapeHtml(
                                                                buku.judul ?? '-'
                                                            )}

                                                        </strong>

                                                        <small class="text-muted">

                                                            (
                                                            ${escapeHtml(
                                                                buku.kode_buku ?? '-'
                                                            )}
                                                            )

                                                        </small>

                                                    </li>

                                                `;

                                            }
                                        );


                                        daftarBuku +=
                                            '</ul>';


                                    } else {


                                        daftarBuku = '-';

                                    }



                                    /*
                                    |--------------------------------------------------------------------------
                                    | STATUS
                                    |--------------------------------------------------------------------------
                                    */

                                    let statusBadge = `

                                        <span class="badge bg-secondary">

                                            ${escapeHtml(
                                                data.status ?? '-'
                                            )}

                                        </span>

                                    `;


                                    if (
                                        data.status ===
                                        'Dipinjam'
                                    ) {

                                        statusBadge = `

                                            <span class="badge bg-primary">

                                                Dipinjam

                                            </span>

                                        `;

                                    }


                                    else if (
                                        data.status ===
                                        'Terlambat'
                                    ) {

                                        statusBadge = `

                                            <span class="badge bg-danger">

                                                Terlambat

                                            </span>

                                        `;

                                    }


                                    else if (
                                        data.status ===
                                        'Dikembalikan'
                                    ) {

                                        statusBadge = `

                                            <span class="badge bg-success">

                                                Dikembalikan

                                            </span>

                                        `;

                                    }



                                    /*
                                    |--------------------------------------------------------------------------
                                    | DENDA
                                    |--------------------------------------------------------------------------
                                    */

                                    const denda =
                                        Number(
                                            data.denda ?? 0
                                        ).toLocaleString(
                                            'id-ID'
                                        );



                                    /*
                                    |--------------------------------------------------------------------------
                                    | SWEETALERT DETAIL
                                    |--------------------------------------------------------------------------
                                    */

                                    Swal.fire({

                                        title: `

                                            <i class="bi bi-clock-history text-primary"></i>

                                            Detail Riwayat Peminjaman

                                        `,

                                        icon: 'info',

                                        width: 800,

                                        html: `

                                            <div class="text-start">

                                                <table
                                                    class="table table-bordered align-middle">


                                                    <tr>

                                                        <th width="190">

                                                            Kode Peminjaman

                                                        </th>

                                                        <td>

                                                            ${escapeHtml(
                                                                data.kode_peminjaman ?? '-'
                                                            )}

                                                        </td>

                                                    </tr>


                                                    <tr>

                                                        <th>

                                                            Nama Anggota

                                                        </th>

                                                        <td>

                                                            ${escapeHtml(
                                                                data.anggota?.nama ?? '-'
                                                            )}

                                                        </td>

                                                    </tr>


                                                    <tr>

                                                        <th>

                                                            NIS

                                                        </th>

                                                        <td>

                                                            ${escapeHtml(
                                                                data.anggota?.nis ?? '-'
                                                            )}

                                                        </td>

                                                    </tr>


                                                    <tr>

                                                        <th>

                                                            Kelas

                                                        </th>

                                                        <td>

                                                            ${escapeHtml(
                                                                data.anggota?.kelas?.nama_kelas ?? '-'
                                                            )}

                                                        </td>

                                                    </tr>


                                                    <tr>

                                                        <th>

                                                            Tanggal Pinjam

                                                        </th>

                                                        <td>

                                                            ${escapeHtml(
                                                                data.tanggal_pinjam ?? '-'
                                                            )}

                                                        </td>

                                                    </tr>


                                                    <tr>

                                                        <th>

                                                            Jatuh Tempo

                                                        </th>

                                                        <td>

                                                            ${escapeHtml(
                                                                data.tanggal_jatuh_tempo ?? '-'
                                                            )}

                                                        </td>

                                                    </tr>


                                                    <tr>

                                                        <th>

                                                            Tanggal Kembali

                                                        </th>

                                                        <td>

                                                            ${escapeHtml(
                                                                data.tanggal_kembali ?? '-'
                                                            )}

                                                        </td>

                                                    </tr>


                                                    <tr>

                                                        <th>

                                                            Status

                                                        </th>

                                                        <td>

                                                            ${statusBadge}

                                                        </td>

                                                    </tr>


                                                    <tr>

                                                        <th>

                                                            Buku

                                                        </th>

                                                        <td>

                                                            ${daftarBuku}

                                                        </td>

                                                    </tr>


                                                    <tr>

                                                        <th>

                                                            Denda

                                                        </th>

                                                        <td>

                                                            <strong
                                                                class="text-danger">

                                                                Rp ${denda}

                                                            </strong>

                                                        </td>

                                                    </tr>


                                                    <tr>

                                                        <th>

                                                            Keterangan

                                                        </th>

                                                        <td>

                                                            ${escapeHtml(
                                                                data.keterangan ?? '-'
                                                            )}

                                                        </td>

                                                    </tr>


                                                </table>

                                            </div>

                                        `,

                                        confirmButtonColor:
                                            '#173B6C',

                                        confirmButtonText: `

                                            <i class="bi bi-x-circle me-1"></i>

                                            Tutup

                                        `,

                                        showCloseButton:
                                            true

                                    });

                                }
                            )


                            /*
                            |--------------------------------------------------------------------------
                            | ERROR
                            |--------------------------------------------------------------------------
                            */

                            .catch(
                                function (error) {


                                    console.error(
                                        'ERROR DETAIL RIWAYAT:',
                                        error
                                    );


                                    Swal.fire({

                                        icon: 'error',

                                        title: 'Gagal',

                                        text:
                                            'Data riwayat gagal diambil.'

                                    });

                                }
                            );

                        }
                    );

                }
            );



        /*
        |--------------------------------------------------------------------------
        | ESCAPE HTML
        |--------------------------------------------------------------------------
        */

        function escapeHtml(value) {


            if (
                value === null ||
                value === undefined
            ) {

                return '';

            }


            return String(value)

                .replace(
                    /&/g,
                    '&amp;'
                )

                .replace(
                    /</g,
                    '&lt;'
                )

                .replace(
                    />/g,
                    '&gt;'
                )

                .replace(
                    /"/g,
                    '&quot;'
                )

                .replace(
                    /'/g,
                    '&#039;'
                );

        }

    }

);

</script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\LENOVO\Herd\kampus_mulan\resources\views/riwayat-peminjaman/index.blade.php ENDPATH**/ ?>