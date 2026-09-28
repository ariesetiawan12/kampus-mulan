

<?php $__env->startSection('title', 'Backup Database'); ?>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/css/backup.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<div class="container-fluid backup-page">

    

    <div class="page-header mb-4">

        <div>

            <h3 class="page-title">

                <i class="bi bi-database-fill-down"></i>

                Backup Database

            </h3>

            <p class="page-subtitle">

                Cadangkan seluruh data sistem perpustakaan.

            </p>

        </div>

    </div>


    

    <?php if(session('error')): ?>

        <div class="alert alert-danger alert-dismissible fade show">

            <i class="bi bi-exclamation-triangle-fill"></i>

            <?php echo e(session('error')); ?>


            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    <?php endif; ?>


    

    <div class="row justify-content-center">

        <div class="col-xl-8 col-lg-10">

            <div class="backup-card">

                <div class="backup-icon">

                    <i class="bi bi-database-fill"></i>

                </div>


                <h4>

                    Backup Database Perpustakaan

                </h4>


                <p class="backup-description">

                    Simpan salinan database perpustakaan
                    sebagai file SQL untuk menjaga keamanan
                    data sistem.

                </p>


                

                <div class="backup-info">

                    <div class="info-item">

                        <div class="info-icon">

                            <i class="bi bi-database"></i>

                        </div>

                        <div>

                            <span>
                                Format Backup
                            </span>

                            <strong>
                                SQL Database
                            </strong>

                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-icon">

                            <i class="bi bi-table"></i>

                        </div>

                        <div>

                            <span>
                                Data
                            </span>

                            <strong>
                                Seluruh Tabel
                            </strong>

                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-icon">

                            <i class="bi bi-shield-check"></i>

                        </div>

                        <div>

                            <span>
                                Keamanan
                            </span>

                            <strong>
                                Backup Lokal
                            </strong>

                        </div>

                    </div>

                </div>


                

                <div class="backup-action">

                    <button
                        type="button"
                        class="btn btn-primary btn-lg"
                        id="btnBackup"
                    >

                        <i class="bi bi-cloud-arrow-down-fill"></i>

                        Backup Database

                    </button>

                </div>


                <div class="backup-note">

                    <i class="bi bi-info-circle"></i>

                    File backup akan otomatis diunduh
                    dalam format <strong>.sql</strong>.

                </div>

            </div>

        </div>

    </div>

</div>

<?php $__env->stopSection(); ?>


<?php $__env->startPush('scripts'); ?>

<script src="<?php echo e(asset('assets/js/backup.js')); ?>"></script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\LENOVO\Herd\kampus_mulan\resources\views/backup/index.blade.php ENDPATH**/ ?>