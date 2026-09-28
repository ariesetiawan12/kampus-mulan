

<?php $__env->startSection('title', 'Petugas Perpustakaan'); ?>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/css/petugas.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<div class="container-fluid">

    

    <div class="page-header mb-4">

        <div>

            <h3 class="page-title">
                <i class="bi bi-person-badge-fill"></i>
                Petugas Perpustakaan
            </h3>

            <p class="page-subtitle">
                Kelola data petugas yang mengelola perpustakaan.
            </p>

        </div>


        <button
            type="button"
            class="btn btn-primary"
            id="btnTambahPetugas"
            data-bs-toggle="modal"
            data-bs-target="#modalPetugas"
        >

            <i class="bi bi-plus-lg"></i>
            Tambah Petugas

        </button>

    </div>


    

    <?php if(session('success')): ?>

        <div
            class="alert alert-success alert-dismissible fade show"
            role="alert"
        >

            <i class="bi bi-check-circle-fill"></i>

            <?php echo e(session('success')); ?>


            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    <?php endif; ?>


    

    <?php if(session('error')): ?>

        <div
            class="alert alert-danger alert-dismissible fade show"
            role="alert"
        >

            <i class="bi bi-exclamation-circle-fill"></i>

            <?php echo e(session('error')); ?>


            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    <?php endif; ?>


    

    <div class="card filter-card border-0 shadow-sm mb-4">

        <div class="card-body">

            <form
                action="<?php echo e(route('petugas.index')); ?>"
                method="GET"
            >

                <div class="row g-3 align-items-end">


                    

                    <div class="col-md-6">

                        <label
                            for="search"
                            class="form-label"
                        >
                            Cari
                        </label>

                        <input
                            type="text"
                            id="search"
                            name="search"
                            class="form-control"
                            value="<?php echo e(request('search')); ?>"
                            placeholder="Nama atau username..."
                        >

                    </div>


                    

                    <div class="col-md-3">

                        <label
                            for="statusFilter"
                            class="form-label"
                        >
                            Status
                        </label>

                        <select
                            id="statusFilter"
                            name="status"
                            class="form-select"
                        >

                            <option value="">
                                Semua
                            </option>

                            <option
                                value="Aktif"
                                <?php echo e(request('status') == 'Aktif' ? 'selected' : ''); ?>

                            >
                                Aktif
                            </option>

                            <option
                                value="Nonaktif"
                                <?php echo e(request('status') == 'Nonaktif' ? 'selected' : ''); ?>

                            >
                                Nonaktif
                            </option>

                        </select>

                    </div>


                    

                    <div class="col-md-3 filter-buttons">

                        <button
                            type="submit"
                            class="btn btn-primary"
                        >

                            <i class="bi bi-search"></i>
                            Cari

                        </button>


                        <a
                            href="<?php echo e(route('petugas.index')); ?>"
                            class="btn btn-secondary"
                            title="Reset"
                        >

                            <i class="bi bi-x-lg"></i>

                        </a>

                    </div>

                </div>

            </form>

        </div>

    </div>


    

    <div class="card table-card border-0 shadow-sm">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>

                        <tr>

                            <th width="60">
                                No
                            </th>

                            <th>
                                Petugas
                            </th>

                            <th>
                                Username
                            </th>

                            <th>
                                Status
                            </th>

                            <th width="150">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        <?php $__empty_1 = true; $__currentLoopData = $petugas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                            <tr>

                                

                                <td>

                                    <?php echo e($petugas->firstItem() + $loop->index); ?>


                                </td>


                                

                                <td>

                                    <div class="petugas-info">


                                        <?php if($item->foto): ?>

                                            <img
                                                src="<?php echo e(asset('storage/' . $item->foto)); ?>"
                                                class="petugas-avatar"
                                                alt="Foto <?php echo e($item->nama); ?>"
                                            >

                                        <?php else: ?>

                                            <div class="petugas-avatar avatar-default">

                                                <i class="bi bi-person-fill"></i>

                                            </div>

                                        <?php endif; ?>


                                        <div>

                                            <div class="petugas-name">
                                                <?php echo e($item->nama); ?>

                                            </div>

                                            <small>
                                                Petugas Perpustakaan
                                            </small>

                                        </div>

                                    </div>

                                </td>


                                

                                <td>

                                    <span class="username-label">

                                        <i class="bi bi-person"></i>

                                        <?php echo e($item->username); ?>


                                    </span>

                                </td>


                                

                                <td>

                                    <?php if($item->status === 'Aktif'): ?>

                                        <span class="status-badge status-active">

                                            <i class="bi bi-check-circle-fill"></i>
                                            Aktif

                                        </span>

                                    <?php else: ?>

                                        <span class="status-badge status-inactive">

                                            <i class="bi bi-x-circle-fill"></i>
                                            Nonaktif

                                        </span>

                                    <?php endif; ?>

                                </td>


                                

                                <td>

                                    <div class="action-buttons">


                                        

                                        <button
                                            type="button"
                                            class="btn btn-info btn-sm btn-show-petugas"
                                            data-id="<?php echo e($item->id); ?>"
                                            title="Detail"
                                        >

                                            <i class="bi bi-eye"></i>

                                        </button>


                                        

                                        <button
                                            type="button"
                                            class="btn btn-warning btn-sm btn-edit-petugas"
                                            data-id="<?php echo e($item->id); ?>"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalPetugas"
                                            title="Edit"
                                        >

                                            <i class="bi bi-pencil-square"></i>

                                        </button>


                                        

                                        <form
                                            action="<?php echo e(route('petugas.destroy', $item->id)); ?>"
                                            method="POST"
                                            class="form-delete-petugas"
                                        >

                                            <?php echo csrf_field(); ?>

                                            <?php echo method_field('DELETE'); ?>

                                            <button
                                                type="submit"
                                                class="btn btn-danger btn-sm btn-delete-petugas"
                                                title="Hapus"
                                            >

                                                <i class="bi bi-trash"></i>

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                            <tr>

                                <td
                                    colspan="5"
                                    class="empty-data"
                                >

                                    <i class="bi bi-person-x"></i>

                                    <h6>
                                        Belum Ada Data Petugas
                                    </h6>

                                    <p>
                                        Silakan tambahkan petugas baru.
                                    </p>

                                </td>

                            </tr>

                        <?php endif; ?>

                    </tbody>

                </table>

            </div>


            

            <?php if($petugas->hasPages()): ?>

                <div class="pagination-wrapper">

                    <?php echo e($petugas->links()); ?>


                </div>

            <?php endif; ?>

        </div>

    </div>

</div>




<?php echo $__env->make('petugas.modal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php $__env->stopSection(); ?>




<?php $__env->startPush('scripts'); ?>

<script src="<?php echo e(asset('assets/js/petugas.js')); ?>"></script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\LENOVO\Herd\kampus_mulan\resources\views/petugas/index.blade.php ENDPATH**/ ?>