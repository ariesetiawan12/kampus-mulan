

<?php $__env->startSection('title', 'Peminjaman Baru'); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header">

    <div>

        <h2>
            <i class="bi bi-journal-plus"></i>
            Peminjaman Baru
        </h2>

        <p>
            Catat transaksi peminjaman buku anggota.
        </p>

    </div>

    <a
        href="<?php echo e(route('peminjaman.index')); ?>"
        class="btn btn-secondary">

        <i class="bi bi-arrow-left"></i>

        Kembali

    </a>

</div>




<?php if($errors->any()): ?>

<div class="alert alert-danger">

    <strong>
        <i class="bi bi-exclamation-triangle-fill"></i>
        Terjadi kesalahan
    </strong>

    <ul class="mb-0 mt-2">

        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <li><?php echo e($error); ?></li>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </ul>

</div>

<?php endif; ?>




<?php if(session('error')): ?>

<div class="alert alert-danger">

    <i class="bi bi-exclamation-triangle-fill"></i>

    <?php echo e(session('error')); ?>


</div>

<?php endif; ?>


<div class="card shadow border-0 peminjaman-card">

    <div class="card-body">

        <form
            action="<?php echo e(route('peminjaman.store')); ?>"
            method="POST"
            id="formPeminjaman">

            <?php echo csrf_field(); ?>


            

            <h5 class="section-title mb-3">

                <i class="bi bi-person-vcard"></i>

                Data Peminjaman

            </h5>


            <div class="row">


                

                <div class="col-md-6 mb-3">

                    <label
                        for="searchAnggota"
                        class="form-label">

                        Anggota
                        <span class="text-danger">*</span>

                    </label>


                    

                    <div class="search-wrapper anggota-search-wrapper">

                        <i class="bi bi-search search-icon"></i>

                        <input
                            type="text"
                            id="searchAnggota"
                            class="form-control search-input"
                            placeholder="Cari nama atau NIS anggota..."
                            autocomplete="off">

                    </div>


                    

                    <div
                        id="hasilAnggota"
                        class="anggota-dropdown d-none">

                        

                    </div>


                    

                    <input
                        type="hidden"
                        name="anggota_id"
                        id="anggota_id"
                        value="<?php echo e(old('anggota_id')); ?>">


                    

                    <div
                        id="anggotaTerpilih"
                        class="anggota-selected d-none">

                        <div class="anggota-selected-icon">

                            <i class="bi bi-person-check-fill"></i>

                        </div>

                        <div class="anggota-selected-content">

                            <strong
                                id="namaAnggotaTerpilih">
                            </strong>

                            <small
                                id="detailAnggotaTerpilih">
                            </small>

                        </div>

                        <button
                            type="button"
                            id="btnHapusAnggota"
                            class="btn btn-sm btn-outline-danger"
                            title="Ganti anggota">

                            <i class="bi bi-x-lg"></i>

                        </button>

                    </div>


                    <small class="text-muted d-block mt-1">

                        <i class="bi bi-info-circle"></i>

                        Ketik nama atau NIS, lalu klik anggota
                        yang ingin dipilih.

                    </small>


                    

                    <div
                        id="anggotaSearchInfo"
                        class="search-info d-none">

                        <i class="bi bi-search"></i>

                        <span></span>

                    </div>


                    

                    <div
                        id="anggotaTidakDitemukan"
                        class="anggota-empty d-none">

                        <i class="bi bi-person-x"></i>

                        <strong>Anggota tidak ditemukan</strong>

                        <small>
                            Coba gunakan nama atau NIS lain.
                        </small>

                    </div>


                    <?php if($anggota->isEmpty()): ?>

                        <div class="alert alert-warning mt-2 mb-0 py-2">

                            <i class="bi bi-exclamation-triangle"></i>

                            Belum ada anggota aktif.

                        </div>

                    <?php endif; ?>


                    

                    <div
                        id="dataAnggota"
                        class="d-none">

                        <?php $__currentLoopData = $anggota; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <div
                                class="data-anggota-item"
                                data-id="<?php echo e($item->id); ?>"
                                data-nama="<?php echo e($item->nama); ?>"
                                data-nis="<?php echo e($item->nis); ?>"
                                data-kelas="<?php echo e($item->kelas->nama_kelas ?? '-'); ?>">

                            </div>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </div>

                </div>


                

                <div class="col-md-3 mb-3">

                    <label
                        for="tanggal_pinjam"
                        class="form-label">

                        Tanggal Pinjam
                        <span class="text-danger">*</span>

                    </label>

                    <input
                        type="date"
                        name="tanggal_pinjam"
                        id="tanggal_pinjam"
                        class="form-control"
                        value="<?php echo e(old('tanggal_pinjam', $tanggalPinjam)); ?>"
                        required>

                </div>


                

                <div class="col-md-3 mb-3">

                    <label
                        for="tanggal_jatuh_tempo"
                        class="form-label">

                        Jatuh Tempo
                        <span class="text-danger">*</span>

                    </label>

                    <input
                        type="date"
                        name="tanggal_jatuh_tempo"
                        id="tanggal_jatuh_tempo"
                        class="form-control"
                        value="<?php echo e(old('tanggal_jatuh_tempo', $tanggalJatuhTempo)); ?>"
                        required>

                </div>

            </div>


            <hr>


            

            <h5 class="section-title mb-3">

                <i class="bi bi-book"></i>

                Buku yang Dipinjam

            </h5>


            <div class="mb-3">

                <label
                    for="searchBuku"
                    class="form-label">

                    Pilih Buku
                    <span class="text-danger">*</span>

                </label>


                

                <div class="search-wrapper mb-2">

                    <i class="bi bi-search search-icon"></i>

                    <input
                        type="text"
                        id="searchBuku"
                        class="form-control search-input"
                        placeholder="Cari kode atau judul buku..."
                        autocomplete="off">

                </div>


                

                <div class="book-toolbar">

                    <div
                        id="jumlahBukuInfo"
                        class="selected-book-info">

                        <i class="bi bi-check2-square"></i>

                        <span>
                            0 buku dipilih
                        </span>

                    </div>


                    <button
                        type="button"
                        id="btnResetBuku"
                        class="btn btn-sm btn-outline-secondary">

                        <i class="bi bi-arrow-counterclockwise"></i>

                        Reset Pilihan

                    </button>

                </div>


                

                <div
                    id="daftarBuku"
                    class="book-list">


                    <?php $__empty_1 = true; $__currentLoopData = $buku; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                        <label
                            class="book-item"
                            data-search="<?php echo e(strtolower($item->kode_buku . ' ' . $item->judul)); ?>">

                            <div class="book-checkbox">

                                <input
                                    type="checkbox"
                                    name="buku_id[]"
                                    value="<?php echo e($item->id); ?>"
                                    class="form-check-input buku-checkbox-input"
                                    <?php if(
                                        is_array(old('buku_id')) &&
                                        in_array($item->id, old('buku_id'))
                                    ): ?>
                                        checked
                                    <?php endif; ?>>

                            </div>


                            <div class="book-content">

                                <div class="book-title">

                                    <span class="book-code">

                                        <?php echo e($item->kode_buku); ?>


                                    </span>

                                    <span>

                                        <?php echo e($item->judul); ?>


                                    </span>

                                </div>


                                <?php if(isset($item->stok)): ?>

                                    <div class="book-stock">

                                        <i class="bi bi-box-seam"></i>

                                        Stok tersedia:

                                        <strong>
                                            <?php echo e($item->stok); ?>

                                        </strong>

                                    </div>

                                <?php endif; ?>

                            </div>


                            <div class="book-check-icon">

                                <i class="bi bi-check-circle-fill"></i>

                            </div>

                        </label>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                        <div class="empty-book">

                            <i class="bi bi-book"></i>

                            <h6>Tidak Ada Buku Tersedia</h6>

                            <p>
                                Belum ada buku yang bisa dipinjam.
                            </p>

                        </div>

                    <?php endif; ?>


                    

                    <div
                        id="bukuTidakDitemukan"
                        class="empty-book d-none">

                        <i class="bi bi-search"></i>

                        <h6>Buku Tidak Ditemukan</h6>

                        <p>
                            Coba gunakan kata pencarian lain.
                        </p>

                    </div>

                </div>


                <small class="text-muted d-block mt-2">

                    <i class="bi bi-info-circle"></i>

                    Centang buku yang ingin dipinjam.
                    Kamu dapat memilih lebih dari satu buku.

                </small>

            </div>


            

            <div class="mb-4">

                <label
                    for="keterangan"
                    class="form-label">

                    Keterangan

                </label>

                <textarea
                    name="keterangan"
                    id="keterangan"
                    class="form-control"
                    rows="3"
                    placeholder="Keterangan tambahan jika diperlukan..."><?php echo e(old('keterangan')); ?></textarea>

            </div>


            

            <div class="d-flex justify-content-end gap-2">

                <a
                    href="<?php echo e(route('peminjaman.index')); ?>"
                    class="btn btn-secondary">

                    <i class="bi bi-x-circle"></i>

                    Batal

                </a>


                <button
                    type="submit"
                    class="btn btn-primary"
                    id="btnSimpanPeminjaman">

                    <i class="bi bi-save"></i>

                    Simpan Peminjaman

                </button>

            </div>

        </form>

    </div>

</div>

<?php $__env->stopSection(); ?>




<?php $__env->startPush('styles'); ?>

<link
    rel="stylesheet"
    href="<?php echo e(asset('assets/css/peminjaman.css')); ?>">

<?php $__env->stopPush(); ?>




<?php $__env->startPush('scripts'); ?>

<script src="<?php echo e(asset('assets/js/peminjaman.js')); ?>"></script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\LENOVO\Herd\kampus_mulan\resources\views/peminjaman/create.blade.php ENDPATH**/ ?>