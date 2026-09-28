

<?php $__env->startSection('title', 'Data Anggota'); ?>




<?php $__env->startPush('styles'); ?>

<link
    rel="stylesheet"
    href="<?php echo e(asset('assets/css/anggota.css')); ?>">

<?php $__env->stopPush(); ?>


<?php $__env->startSection('content'); ?>

<div class="anggota-page">


    

    <div class="page-header">

        <div>

            <h2>
                <i class="bi bi-people-fill"></i>
                Data Anggota
            </h2>

            <p>
                Kelola seluruh data anggota perpustakaan.
            </p>

        </div>


        

        <div class="anggota-header-actions">


            

            <a
                href="<?php echo e(route('anggota.import.create')); ?>"
                class="btn btn-success">

                <i class="bi bi-file-earmark-excel"></i>

                Import Excel

            </a>


            

            <button
                type="button"
                id="btnTambah"
                class="btn btn-primary"
                data-bs-toggle="modal"
                data-bs-target="#modalAnggota">

                <i class="bi bi-plus-circle"></i>

                Tambah Anggota

            </button>


            

            <div class="btn-group">

                <button
                    type="button"
                    class="btn btn-secondary dropdown-toggle"
                    data-bs-toggle="dropdown"
                    aria-expanded="false">

                    <i class="bi bi-printer-fill"></i>

                    Cetak Kartu

                </button>


                <ul class="dropdown-menu dropdown-menu-end">


                    

                    <li>

                        <a
                            class="dropdown-item"
                            href="<?php echo e(route('anggota.cetak-semua-kartu')); ?>"
                            target="_blank">

                            <i class="bi bi-people-fill text-primary me-2"></i>

                            Cetak Semua Anggota

                        </a>

                    </li>


                    

                    <li>

                        <a
                            class="dropdown-item"
                            href="<?php echo e(route('anggota.cetak-semua-kartu', ['status' => 'aktif'])); ?>"
                            target="_blank">

                            <i class="bi bi-person-check-fill text-success me-2"></i>

                            Cetak Anggota Aktif

                        </a>

                    </li>

                </ul>

            </div>

        </div>

    </div>



    

    <?php if(session('success')): ?>

        <div class="alert alert-success anggota-alert">

            <i class="bi bi-check-circle-fill"></i>

            <?php echo e(session('success')); ?>


        </div>

    <?php endif; ?>



    

    <?php if(session('error')): ?>

        <div class="alert alert-danger anggota-alert">

            <i class="bi bi-exclamation-triangle-fill"></i>

            <?php echo e(session('error')); ?>


        </div>

    <?php endif; ?>



    

    <div class="row anggota-statistik">


        

        <div class="col-md-4 mb-3">

            <div class="dashboard-card bg-primary">

                <div>

                    <h6>
                        Total Anggota
                    </h6>

                    <h2>
                        <?php echo e($anggota->total()); ?>

                    </h2>

                </div>

                <i class="bi bi-people-fill"></i>

            </div>

        </div>


        

        <div class="col-md-4 mb-3">

            <div class="dashboard-card bg-success">

                <div>

                    <h6>
                        Aktif
                    </h6>

                    <h2>
                        <?php echo e($anggota->where('status', 'Aktif')->count()); ?>

                    </h2>

                </div>

                <i class="bi bi-person-check-fill"></i>

            </div>

        </div>


        

        <div class="col-md-4 mb-3">

            <div class="dashboard-card bg-danger">

                <div>

                    <h6>
                        Nonaktif
                    </h6>

                    <h2>
                        <?php echo e($anggota->where('status', 'Nonaktif')->count()); ?>

                    </h2>

                </div>

                <i class="bi bi-person-x-fill"></i>

            </div>

        </div>

    </div>



    

    <div class="card shadow border-0 anggota-card">

        <div class="card-body anggota-card-body">


            

            <form
                method="GET"
                action="<?php echo e(route('anggota.index')); ?>"
                class="anggota-search-form">

                <div class="input-group">

                    <input
                        type="text"
                        name="search"
                        value="<?php echo e(request('search')); ?>"
                        class="form-control"
                        placeholder="Cari kode, NIS, nama, atau nomor HP..."
                        autocomplete="off">


                    <button
                        type="submit"
                        class="btn btn-primary">

                        <i class="bi bi-search"></i>

                    </button>


                    <?php if(request('search')): ?>

                        <a
                            href="<?php echo e(route('anggota.index')); ?>"
                            class="btn btn-danger"
                            title="Reset pencarian">

                            <i class="bi bi-x-lg"></i>

                        </a>

                    <?php endif; ?>

                </div>

            </form>



            

            <div class="table-responsive anggota-table-wrapper">

                <table class="table table-hover align-middle anggota-table">


                    

                    <thead>

                        <tr>

                            <th>No</th>

                            <th>Kode</th>

                            <th>NIS</th>

                            <th>Nama</th>

                            <th>Kelas</th>

                            <th>Jenis Kelamin</th>

                            <th>No HP</th>

                            <th>Status</th>

                            <th>Aksi</th>

                        </tr>

                    </thead>


                    

                    <tbody>


                        <?php $__empty_1 = true; $__currentLoopData = $anggota; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                            <tr>


                                

                                <td>

                                    <?php echo e($anggota->firstItem() + $loop->index); ?>


                                </td>


                                

                                <td>

                                    <span class="badge bg-primary">

                                        <?php echo e($item->kode_anggota); ?>


                                    </span>

                                </td>


                                

                                <td>

                                    <?php echo e($item->nis); ?>


                                </td>


                                

                                <td>

                                    <strong>

                                        <?php echo e($item->nama); ?>


                                    </strong>

                                </td>


                                

                                <td>

                                    <?php if($item->kelas): ?>

                                        <?php echo e($item->kelas->nama_kelas); ?>


                                    <?php else: ?>

                                        <span class="text-muted">
                                            -
                                        </span>

                                    <?php endif; ?>

                                </td>


                                

                                <td>

                                    <?php if(
                                        strtolower($item->jenis_kelamin ?? '') === 'l' ||
                                        strtolower($item->jenis_kelamin ?? '') === 'laki-laki' ||
                                        strtolower($item->jenis_kelamin ?? '') === 'laki laki'
                                    ): ?>

                                        <span class="badge bg-info">

                                            Laki-laki

                                        </span>

                                    <?php else: ?>

                                        <span class="badge bg-warning text-dark">

                                            Perempuan

                                        </span>

                                    <?php endif; ?>

                                </td>


                                

                                <td>

                                    <?php echo e($item->no_hp ?? '-'); ?>


                                </td>


                                

                                <td>

                                    <?php if(
                                        strtolower($item->status ?? '') === 'aktif'
                                    ): ?>

                                        <span class="badge bg-success">

                                            Aktif

                                        </span>

                                    <?php else: ?>

                                        <span class="badge bg-danger">

                                            Nonaktif

                                        </span>

                                    <?php endif; ?>

                                </td>


                                

                                <td>

                                    <div class="anggota-action">


                                        

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
                                            data-bs-target="#modalAnggota"
                                            title="Edit">

                                            <i class="bi bi-pencil"></i>

                                        </button>


                                        

                                        <a
                                            href="<?php echo e(route('anggota.cetak-kartu', $item->id)); ?>"
                                            target="_blank"
                                            class="btn btn-secondary btn-sm"
                                            title="Cetak Kartu">

                                            <i class="bi bi-printer"></i>

                                        </a>


                                        

                                        <form
                                            action="<?php echo e(route('anggota.destroy', $item->id)); ?>"
                                            method="POST"
                                            class="d-inline form-delete">

                                            <?php echo csrf_field(); ?>

                                            <?php echo method_field('DELETE'); ?>

                                            <button
                                                type="button"
                                                class="btn btn-danger btn-sm btn-delete"
                                                title="Hapus">

                                                <i class="bi bi-trash"></i>

                                            </button>

                                        </form>


                                    </div>

                                </td>

                            </tr>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>


                            

                            <tr>

                                <td
                                    colspan="9"
                                    class="text-center anggota-empty">

                                    <div>

                                        <i class="bi bi-people"></i>

                                        <h6>
                                            Belum Ada Data Anggota
                                        </h6>

                                        <p>
                                            Silakan tambahkan anggota
                                            atau import data melalui Excel.
                                        </p>

                                    </div>

                                </td>

                            </tr>


                        <?php endif; ?>


                    </tbody>

                </table>

            </div>



            

            <?php if($anggota->hasPages()): ?>

                <div class="anggota-pagination">


                    

                    <div class="pagination-info">

                        Menampilkan

                        <strong>
                            <?php echo e($anggota->firstItem()); ?>

                        </strong>

                        -

                        <strong>
                            <?php echo e($anggota->lastItem()); ?>

                        </strong>

                        dari

                        <strong>
                            <?php echo e($anggota->total()); ?>

                        </strong>

                        anggota

                    </div>


                    

                    <nav
                        aria-label="Pagination Anggota">

                        <ul class="anggota-pagination-list">


                            

                            <?php if($anggota->onFirstPage()): ?>

                                <li class="disabled">

                                    <span>

                                        <i class="bi bi-chevron-left"></i>

                                    </span>

                                </li>

                            <?php else: ?>

                                <li>

                                    <a
                                        href="<?php echo e($anggota->previousPageUrl()); ?>"
                                        aria-label="Previous">

                                        <i class="bi bi-chevron-left"></i>

                                    </a>

                                </li>

                            <?php endif; ?>



                            

                            <?php for(
                                $page = 1;
                                $page <= $anggota->lastPage();
                                $page++
                            ): ?>

                                <?php if($page == $anggota->currentPage()): ?>

                                    <li class="active">

                                        <span>

                                            <?php echo e($page); ?>


                                        </span>

                                    </li>

                                <?php else: ?>

                                    <li>

                                        <a
                                            href="<?php echo e($anggota->url($page)); ?>">

                                            <?php echo e($page); ?>


                                        </a>

                                    </li>

                                <?php endif; ?>

                            <?php endfor; ?>



                            

                            <?php if($anggota->hasMorePages()): ?>

                                <li>

                                    <a
                                        href="<?php echo e($anggota->nextPageUrl()); ?>"
                                        aria-label="Next">

                                        <i class="bi bi-chevron-right"></i>

                                    </a>

                                </li>

                            <?php else: ?>

                                <li class="disabled">

                                    <span>

                                        <i class="bi bi-chevron-right"></i>

                                    </span>

                                </li>

                            <?php endif; ?>


                        </ul>

                    </nav>

                </div>

            <?php endif; ?>


        </div>

    </div>



    

    <?php echo $__env->make('anggota.modal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>


</div>

<?php $__env->stopSection(); ?>





<?php $__env->startPush('scripts'); ?>

<script src="<?php echo e(asset('assets/js/anggota.js')); ?>"></script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\LENOVO\Herd\kampus_mulan\resources\views/anggota/index.blade.php ENDPATH**/ ?>