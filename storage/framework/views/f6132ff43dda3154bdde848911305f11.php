

<?php $__env->startPush('styles'); ?>

<link rel="stylesheet"
href="<?php echo e(asset('assets/css/buku.css')); ?>">

<?php $__env->stopPush(); ?>

<?php $__env->startSection('title','Data Buku'); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header">

    <div>

        <h2>

            <i class="bi bi-book-fill"></i>

            Data Buku

        </h2>

        <p>

            Kelola seluruh koleksi buku perpustakaan.

        </p>

    </div>

    <button

        id="btnTambah"

        class="btn btn-primary"

        data-bs-toggle="modal"

        data-bs-target="#modalBuku">

        <i class="bi bi-plus-circle"></i>

        Tambah Buku

    </button>

</div>

<div class="row mb-4">

    <div class="col-md-3">

        <div class="dashboard-card bg-primary">

            <div>

                <h6>Total Buku</h6>

                <h2><?php echo e($buku->total()); ?></h2>

            </div>

            <i class="bi bi-book"></i>

        </div>

    </div>

    <div class="col-md-3">

        <div class="dashboard-card bg-success">

            <div>

                <h6>Tersedia</h6>

                <h2>

                    <?php echo e($buku->where('status','Tersedia')->count()); ?>


                </h2>

            </div>

            <i class="bi bi-check-circle"></i>

        </div>

    </div>

    <div class="col-md-3">

        <div class="dashboard-card bg-warning">

            <div>

                <h6>Dipinjam</h6>

                <h2>

                    <?php echo e($buku->where('status','Dipinjam')->count()); ?>


                </h2>

            </div>

            <i class="bi bi-bookmark-check"></i>

        </div>

    </div>

    <div class="col-md-3">

        <div class="dashboard-card bg-danger">

            <div>

                <h6>Rusak</h6>

                <h2>

                    <?php echo e($buku->where('status','Rusak')->count()); ?>


                </h2>

            </div>

            <i class="bi bi-x-circle"></i>

        </div>

    </div>

</div>

<div class="card shadow border-0">

    <div class="card-body">

        <form action="<?php echo e(route('buku.index')); ?>" method="GET">

            <div class="input-group mb-4">

                <input

                    type="text"

                    name="search"

                    value="<?php echo e(request('search')); ?>"

                    class="form-control"

                    placeholder="Cari Judul Buku...">

                <button class="btn btn-primary">

                    <i class="bi bi-search"></i>

                </button>

                <?php if(request('search')): ?>

                <a

                href="<?php echo e(route('buku.index')); ?>"

                class="btn btn-danger">

                    <i class="bi bi-x-lg"></i>

                </a>

                <?php endif; ?>

            </div>

        </form>

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead>

                    <tr>

                        <th>No</th>

                        <th>Cover</th>

                        <th>Kode</th>

                        <th>Judul Buku</th>

                        <th>Kategori</th>

                        <th>Rak</th>

                        <th>Stok</th>

                        <th>Status</th>

                        <th width="180">

                            Aksi

                        </th>

                    </tr>

                </thead>

                <tbody>

                    <?php $__empty_1 = true; $__currentLoopData = $buku; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                    <tr>

                        <td>

                            <?php echo e($loop->iteration); ?>


                        </td>

                        <td>

                            <?php if($item->cover): ?>

                            <img

                            src="<?php echo e(asset('storage/'.$item->cover)); ?>"

                            width="60"

                            class="rounded">

                            <?php else: ?>

                            <i class="bi bi-book fs-1 text-primary"></i>

                            <?php endif; ?>

                        </td>

                        <td>

                            <?php echo e($item->kode_buku); ?>


                        </td>

                        <td>

                            <strong>

                                <?php echo e($item->judul); ?>


                            </strong>

                        </td>

                        <td>

                            <?php echo e($item->kategori->nama_kategori); ?>


                        </td>

                        <td>

                            <?php echo e($item->rak->nama_rak); ?>


                        </td>

                        <td>

                            <?php echo e($item->stok); ?>


                        </td>

                        <td>

                            <span class="badge bg-success">

                                <?php echo e($item->status); ?>


                            </span>

                        </td>

                        <td>

                            <button

                            class="btn btn-info btn-sm btn-show"

                            data-id="<?php echo e($item->id); ?>">

                                <i class="bi bi-eye"></i>

                            </button>

                            <button

                            class="btn btn-warning btn-sm btn-edit"

                            data-id="<?php echo e($item->id); ?>"

                            data-bs-toggle="modal"

                            data-bs-target="#modalBuku">

                                <i class="bi bi-pencil"></i>

                            </button>

                            <form

                            action="<?php echo e(route('buku.destroy',$item->id)); ?>"

                            method="POST"

                            class="d-inline">

                            <?php echo csrf_field(); ?>

                            <?php echo method_field('DELETE'); ?>

                            <button

                            class="btn btn-danger btn-sm btn-delete">

                                <i class="bi bi-trash"></i>

                            </button>

                            </form>

                        </td>

                    </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                    <tr>

                        <td colspan="9"

                        class="text-center py-5">

                            <i class="bi bi-book-half fs-1"></i>

                            <br>

                            Belum ada data buku.

                        </td>

                    </tr>

                    <?php endif; ?>

                </tbody>

            </table>

        </div>

        <?php echo e($buku->links()); ?>


    </div>

</div>

<?php echo $__env->make('buku.modal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>

<script src="<?php echo e(asset('assets/js/buku.js')); ?>"></script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\LENOVO\Herd\kampus_mulan\resources\views/buku/index.blade.php ENDPATH**/ ?>