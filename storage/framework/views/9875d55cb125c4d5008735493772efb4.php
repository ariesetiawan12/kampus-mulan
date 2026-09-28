<nav class="navbar-custom">

    <div class="navbar-left">

        <button type="button" id="toggleSidebar" class="toggle-sidebar">

            <i class="bi bi-list"></i>

        </button>

        <div class="page-title">

            <h4><?php echo $__env->yieldContent('title','Dashboard'); ?></h4>

            <span id="greeting">Selamat Datang 👋</span>

        </div>

    </div>

    <div class="navbar-right">

        <div class="datetime">

            <div id="tanggal"></div>

            <div id="jam"></div>

        </div>

        <div class="profile-box">

            <i class="bi bi-person-circle"></i>

            <div>

                <strong><?php echo e(auth()->user()->nama); ?></strong>

                <small>Administrator</small>

            </div>

        </div>

    </div>

</nav><?php /**PATH C:\Users\LENOVO\Herd\kampus_mulan\resources\views/layouts/navbar.blade.php ENDPATH**/ ?>