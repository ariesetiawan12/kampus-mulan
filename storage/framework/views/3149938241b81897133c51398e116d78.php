<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login | Sistem Informasi Perpustakaan</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icon -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Login CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/login.css')); ?>">

</head>

<body>

<div class="overlay"></div>

<div class="container-fluid vh-100">

    <div class="row h-100">

        <!-- =======================
                KIRI
        ======================== -->

        <div class="col-lg-7 left-panel">

            <div class="branding">

                <img src="<?php echo e(asset('assets/img/logoo.png')); ?>" class="logo">

                <h1>PERPUSTAKAAN DIGITAL</h1>

                <h4>SMKS Muhammadiyah 9 Medan </h4>

                <p>

                    Membangun Budaya Literasi Digital

                </p>

            </div>

        </div>

        <!-- =======================
                KANAN
        ======================== -->

        <div class="col-lg-5 d-flex align-items-center justify-content-center">

            <div class="login-card">

                <h3>

                    LOGIN ADMIN

                </h3>

                <p>

                    Silakan login untuk melanjutkan

                </p>

                <?php if(session('error')): ?>

                <div class="alert alert-danger d-flex align-items-center">

                    <i class="bi bi-exclamation-triangle-fill me-2"></i>

                    <?php echo e(session('error')); ?>


                </div>

                <?php endif; ?>

                <form action="<?php echo e(url('/login')); ?>" method="POST">

                    <?php echo csrf_field(); ?>

                <div class="mb-3">

                    <label class="form-label">Username</label>

                    <div class="input-group">

                        <span class="input-group-text">

                            <i class="bi bi-person-fill"></i>

                        </span>

                        <input
                            type="text"
                            class="form-control"
                            name="username"
                            placeholder="Masukkan Username"
                            required
                        >

                    </div>

                </div>

                    <div class="mb-4">

                    <label class="form-label">Password</label>

                    <div class="input-group">

                        <span class="input-group-text">

                            <i class="bi bi-lock-fill"></i>

                        </span>

                        <input
                            type="password"
                            id="password"
                            class="form-control"
                            name="password"
                            placeholder="Masukkan Password"
                            required
                        >

                        <button
                            class="btn btn-outline-secondary"
                            type="button"
                            id="togglePassword">

                            <i class="bi bi-eye"></i>

                        </button>

                    </div>

                </div>
            <button type="submit" class="btn-login">

                <i class="bi bi-box-arrow-in-right"></i>

                Masuk ke Dashboard

            </button>

                </form>

                <div class="datetime">

                    <div id="tanggal"></div>

                    <div id="jam"></div>

                </div>
                <hr>

            <div class="login-footer">

                © <?php echo e(date('Y')); ?>


                Perpustakaan Digital

                <br>

                SMK Muhammadiyah 9 Medan

            </div>

            </div>

        </div>

    </div>

</div>

<script src="<?php echo e(asset('assets/js/login.js')); ?>"></script>

</body>

</html><?php /**PATH C:\Users\LENOVO\Herd\kampus_mulan\resources\views/auth/login.blade.php ENDPATH**/ ?>