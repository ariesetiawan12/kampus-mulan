

<?php $__env->startSection('title', 'Data Peminjaman'); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header">

    <div>

        <h2>

            <i class="bi bi-journal-bookmark-fill"></i>

            Data Peminjaman

        </h2>

        <p>

            Kelola seluruh transaksi peminjaman buku.

        </p>

    </div>


    <a
        href="<?php echo e(route('peminjaman.create')); ?>"
        class="btn btn-primary">

        <i class="bi bi-plus-circle"></i>

        Peminjaman Baru

    </a>

</div>




<?php if(session('success')): ?>

<div class="alert alert-success">

    <i class="bi bi-check-circle-fill"></i>

    <?php echo e(session('success')); ?>


</div>

<?php endif; ?>




<?php if(session('error')): ?>

<div class="alert alert-danger">

    <i class="bi bi-exclamation-triangle-fill"></i>

    <?php echo e(session('error')); ?>


</div>

<?php endif; ?>


<div class="card shadow border-0">

    <div class="card-body">


        

        <form
            method="GET"
            action="<?php echo e(route('peminjaman.index')); ?>">

            <div class="row mb-4">


                <div class="col-md-6">

                    <div class="input-group">

                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            value="<?php echo e(request('search')); ?>"
                            placeholder="Cari kode, nama atau NIS...">

                        <button
                            class="btn btn-primary"
                            type="submit">

                            <i class="bi bi-search"></i>

                        </button>

                    </div>

                </div>


                <div class="col-md-3">

                    <select
                        name="status"
                        class="form-select"
                        onchange="this.form.submit()">

                        <option value="">

                            Semua Status

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


                <div class="col-md-3">

                    <?php if(request('search') || request('status')): ?>

                        <a
                            href="<?php echo e(route('peminjaman.index')); ?>"
                            class="btn btn-danger w-100">

                            <i class="bi bi-x-lg"></i>

                            Reset

                        </a>

                    <?php endif; ?>

                </div>

            </div>

        </form>


        

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead>

                    <tr>

                        <th>No</th>

                        <th>Kode</th>

                        <th>Anggota</th>

                        <th>Buku</th>

                        <th>Tanggal Pinjam</th>

                        <th>Jatuh Tempo</th>

                        <th>Status</th>

                        <th width="100">Aksi</th>

                    </tr>

                </thead>


                <tbody>

                    <?php $__empty_1 = true; $__currentLoopData = $peminjamans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                    <tr>

                        <td>

                            <?php echo e($peminjamans->firstItem() + $loop->index); ?>


                        </td>


                        <td>

                            <strong>

                                <?php echo e($item->kode_peminjaman); ?>


                            </strong>

                        </td>


                        <td>

                            <?php echo e($item->anggota->nama ?? '-'); ?>


                            <br>

                            <small class="text-muted">

                                NIS:
                                <?php echo e($item->anggota->nis ?? '-'); ?>


                            </small>

                        </td>


                        <td>

                            <?php $__empty_2 = true; $__currentLoopData = $item->detailPeminjamans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>

                                <div>

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

                            <?php if($item->status == 'Dipinjam'): ?>

                                <span class="badge bg-primary">

                                    Dipinjam

                                </span>

                            <?php elseif($item->status == 'Terlambat'): ?>

                                <span class="badge bg-danger">

                                    Terlambat

                                </span>

                            <?php else: ?>

                                <span class="badge bg-success">

                                    Dikembalikan

                                </span>

                            <?php endif; ?>

                        </td>


                        <td>

                        <div class="d-flex gap-1">

                            

                            <button
                                type="button"
                                class="btn btn-info btn-sm btn-detail-peminjaman"
                                data-url="<?php echo e(route('peminjaman.show', $item->id)); ?>"
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


                            

                            <?php if(
                                $item->status === 'Dipinjam' ||
                                $item->status === 'Terlambat'
                            ): ?>

                                <a
                                    href="<?php echo e(route(
                                        'pengembalian.create',
                                        $item->id
                                    )); ?>"
                                    class="btn btn-success btn-sm"
                                    title="Kembalikan">

                                    <i class="bi bi-arrow-return-left"></i>

                                </a>

                            <?php endif; ?>


                            

                            <?php if(
                                $item->status === 'Dipinjam' ||
                                $item->status === 'Terlambat'
                            ): ?>

                                <form
                                    action="<?php echo e(route(
                                        'peminjaman.destroy',
                                        $item->id
                                    )); ?>"
                                    method="POST"
                                    class="d-inline form-batal-peminjaman">

                                    <?php echo csrf_field(); ?>

                                    <?php echo method_field('DELETE'); ?>

                                    <button
                                        type="submit"
                                        class="btn btn-danger btn-sm"
                                        title="Batalkan">

                                        <i class="bi bi-trash"></i>

                                    </button>

                                </form>

                            <?php endif; ?>

                        </div>

                    </td>

                    </tr>


                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                    <tr>

                        <td
                            colspan="8"
                            class="text-center py-4">

                            <i
                                class="bi bi-journal-x fs-2 d-block mb-2">
                            </i>

                            Belum ada data peminjaman.

                        </td>

                    </tr>

                    <?php endif; ?>

                </tbody>

            </table>

        </div>


        

        <?php echo e($peminjamans->links()); ?>


    </div>

</div>
<?php $__env->startPush('scripts'); ?>

<script>

document.querySelectorAll('.form-batal-peminjaman')
    .forEach(function(form) {

        form.addEventListener('submit', function(event) {

            const yakin = confirm(
                'Yakin ingin membatalkan peminjaman ini?\n\n' +
                'Buku yang dipinjam akan dikembalikan menjadi Tersedia.'
            );

            if (!yakin) {

                event.preventDefault();

            }

        });

    });

</script>

<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>

<script src="<?php echo e(asset('assets/js/peminjaman.js')); ?>"></script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\LENOVO\Herd\kampus_mulan\resources\views/peminjaman/index.blade.php ENDPATH**/ ?>