

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/css/kategori.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('title', 'Data Kategori'); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header">

    <div>
        <h3><i class="bi bi-book-half"></i> Data Kategori Buku</h3>
        <p>Kelola semua kategori buku perpustakaan.</p>
    </div>

    <button
        class="btn btn-primary"
        id="btnTambah"
        data-bs-toggle="modal"
        data-bs-target="#modalKategori">

        <i class="bi bi-plus-circle"></i>
        Tambah Kategori

    </button>

</div>

<?php if(session('success')): ?>

<div class="alert alert-success alert-dismissible fade show">

    <i class="bi bi-check-circle-fill"></i>

    <?php echo e(session('success')); ?>


    <button
        type="button"
        class="btn-close"
        data-bs-dismiss="alert"></button>

</div>

<?php endif; ?>

<div class="card shadow border-0">

    <div class="card-body">

        <form method="GET" action="<?php echo e(route('kategori.index')); ?>">

            <div class="row mb-3">

                <div class="col-md-4">

                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        value="<?php echo e(request('search')); ?>"
                        placeholder="🔍 Cari kategori...">

                </div>

                <div class="col-md-2">

                    <button class="btn btn-primary w-100">

                        <i class="bi bi-search"></i>

                        Cari

                    </button>

                </div>

            </div>

        </form>

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead class="table-primary">

                    <tr>

                        <th width="60">No</th>

                        <th>Kode</th>

                        <th>Nama Kategori</th>

                        <th>Status</th>

                        <th width="180" class="text-center">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                <?php $__empty_1 = true; $__currentLoopData = $kategori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                    <tr>

                        <td>

                            <?php echo e($kategori->firstItem() + $loop->index); ?>


                        </td>

                        <td>

                            <?php echo e($item->kode_kategori); ?>


                        </td>

                        <td>

                            <?php echo e($item->nama_kategori); ?>


                        </td>

                        <td>

                            <?php if($item->status=='Aktif'): ?>

                                <span class="badge bg-success">

                                    Aktif

                                </span>

                            <?php else: ?>

                                <span class="badge bg-danger">

                                    Nonaktif

                                </span>

                            <?php endif; ?>

                        </td>

                        <td class="text-center">

                            <button
                                type="button"
                                class="btn btn-info btn-sm btn-show"
                                data-id="<?php echo e($item->id); ?>"
                                title="Detail">

                                <i class="bi bi-eye"></i>

                            </button>

                            <button
                                type="button"
                                class="btn btn-warning btn-sm btn-edit"
                                data-id="<?php echo e($item->id); ?>"
                                data-bs-toggle="modal"
                                data-bs-target="#modalKategori"
                                title="Edit">

                                <i class="bi bi-pencil-square"></i>

                            </button>

                            <form
                                action="<?php echo e(route('kategori.destroy',$item->id)); ?>"
                                method="POST"
                                class="d-inline">

                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>

                                <button
                                    type="submit"
                                    class="btn btn-danger btn-sm btn-delete"
                                    title="Hapus">

                                    <i class="bi bi-trash"></i>

                                </button>

                            </form>

                        </td>

                    </tr>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                    <tr>

                        <td colspan="5" class="text-center text-muted">

                            Belum ada data kategori.

                        </td>

                    </tr>

                <?php endif; ?>

                </tbody>

            </table>

        </div>

        <div class="mt-3">

            <?php echo e($kategori->links()); ?>


        </div>

    </div>

</div>

<?php echo $__env->make('kategori.modal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>

<script src="<?php echo e(asset('assets/js/kategori.js')); ?>"></script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\LENOVO\Herd\kampus_mulan\resources\views/kategori/index.blade.php ENDPATH**/ ?>