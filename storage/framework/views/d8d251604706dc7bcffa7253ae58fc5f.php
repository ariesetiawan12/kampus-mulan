<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>
        <?php echo $__env->yieldContent('title', 'Perpustakaan Digital'); ?>
    </title>


    

    <link
        rel="preconnect"
        href="https://fonts.googleapis.com">

    <link
        rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">


    

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
        rel="stylesheet">


    

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
        rel="stylesheet">


    

    <script
        src="https://cdn.jsdelivr.net/npm/sweetalert2@11">
    </script>


    

    <link
        rel="stylesheet"
        href="<?php echo e(asset('assets/css/style.css')); ?>">


    

    <?php echo $__env->yieldPushContent('styles'); ?>

</head>


<body>


    

    <?php echo $__env->make('layouts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>


    

    <div class="main">


        

        <?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>


        

        <div class="page-content">

            <?php echo $__env->yieldContent('content'); ?>

        </div>


        

        <?php echo $__env->make('layouts.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    </div>



    

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js">
    </script>


    

    <script
        src="https://cdn.jsdelivr.net/npm/chart.js">
    </script>


    

    <?php echo $__env->yieldPushContent('scripts'); ?>



    

    <?php if(session('success')): ?>

        <script>

            Swal.fire({

                icon: 'success',

                title: 'Berhasil',

                text: <?php echo json_encode(session('success'), 15, 512) ?>,

                timer: 2000,

                showConfirmButton: false

            });

        </script>

    <?php endif; ?>



    

    <?php if(session('error')): ?>

        <script>

            Swal.fire({

                icon: 'error',

                title: 'Gagal',

                text: <?php echo json_encode(session('error'), 15, 512) ?>

            });

        </script>

    <?php endif; ?>



    

    <?php if($errors->any()): ?>

        <script>

            Swal.fire({

                icon: 'error',

                title: 'Terjadi Kesalahan',

                html: <?php echo json_encode(
                    implode('<br>', $errors->all()), 512) ?>

            });

        </script>

    <?php endif; ?>


</body>

</html><?php /**PATH C:\Users\LENOVO\Herd\kampus_mulan\resources\views/layouts/app.blade.php ENDPATH**/ ?>