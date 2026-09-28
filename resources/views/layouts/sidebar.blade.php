<aside class="sidebar">

    <!-- ===========================
            SIDEBAR BODY
    ============================ -->

    <div class="sidebar-body">

        <!-- ===========================
                HEADER
        ============================ -->

        <div class="sidebar-header">

            <img
                src="{{ asset('assets/img/logoo.png') }}"
                alt="Logo Sekolah"
                class="logo">

            <h3>
                PERPUSTAKAAN
            </h3>

            <p>
                Digital Library
            </p>

            <small>
                SMK Muhammadiyah 9 Medan
            </small>

        </div>


        <!-- ===========================
                MENU
        ============================ -->

        <div class="menu">


            <!-- =========================
                    MENU UTAMA
            ========================== -->

            <div class="menu-label">

                MENU UTAMA

            </div>


            <a
                href="{{ route('dashboard') }}"
                class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">

                <i class="bi bi-grid-fill"></i>

                <span>
                    Dashboard
                </span>

            </a>



            <!-- =========================
                    MASTER DATA
            ========================== -->

            <div class="menu-label mt-4">

                MASTER DATA

            </div>



            <a
                href="{{ route('rak.index') }}"
                class="{{ request()->routeIs('rak.*') ? 'active' : '' }}">

                <i class="bi bi-bookshelf"></i>

                <span>
                    Rak Buku
                </span>

            </a>

                        <a
                href="{{ route('kategori.index') }}"
                class="{{ request()->routeIs('kategori.*') ? 'active' : '' }}">

                <i class="bi bi-tags-fill"></i>

                <span>
                    Kategori
                </span>

            </a>


            <a
                href="{{ route('buku.index') }}"
                class="{{ request()->routeIs('buku.*') ? 'active' : '' }}">

                <i class="bi bi-book-fill"></i>

                <span>
                    Data Buku
                </span>

            </a>

            <a
                href="{{ route('kelas.index') }}"
                class="{{ request()->routeIs('kelas.*') ? 'active' : '' }}">

                <i class="bi bi-building-fill"></i>

                <span>
                    Kelas
                </span>

            </a>


            <a
                href="{{ route('anggota.index') }}"
                class="{{ request()->routeIs('anggota.*') ? 'active' : '' }}">

                <i class="bi bi-people-fill"></i>

                <span>
                    Anggota
                </span>

            </a>



            <!-- =========================
                    TRANSAKSI
            ========================== -->

            <div class="menu-label mt-4">

                TRANSAKSI

            </div>


            <a
                href="{{ route('peminjaman.index') }}"
                class="{{ request()->routeIs('peminjaman.*') ? 'active' : '' }}">

                <i class="bi bi-box-arrow-in-down"></i>

                <span>
                    Peminjaman
                </span>

            </a>


            <a
                href="{{ route('pengembalian.index') }}"
                class="{{ request()->routeIs('pengembalian.*') ? 'active' : '' }}">

                <i class="bi bi-arrow-return-left"></i>

                <span>
                    Pengembalian
                </span>

            </a>


            <a
                href="{{ route('riwayat-peminjaman.index') }}"
                class="{{ request()->routeIs('riwayat-peminjaman.*') ? 'active' : '' }}">

                <i class="bi bi-clock-history"></i>

                <span>
                    Riwayat
                </span>

            </a>



            <!-- =========================
                    LAPORAN
            ========================== -->

            <div class="menu-label mt-4">

                LAPORAN

            </div>


            <a
                href="{{ route('statistik.index') }}"
                class="{{ request()->routeIs('statistik.*') ? 'active' : '' }}">

                <i class="bi bi-bar-chart-fill"></i>

                <span>
                    Statistik
                </span>

            </a>


            <a 
            href="{{ route('laporan.index') }}"

                <i class="bi bi-file-earmark-text-fill"></i>

                <span>
                    Laporan
                </span>

            </a>



            <!-- =========================
                    MENU LAINNYA
            ========================== -->
                        <div class="menu-label mt-4">

                SISTEM

            </div>

            <a 
            href="{{ route('pengaturan.admin.index') }}"

                <i class="bi bi-gear-fill"></i>

                <span>
                Manajemen Admin
                </span>

            </a>


            <a 
            href="{{ route('petugas.index') }}">


                <i class="bi bi-person-workspace"></i>

                <span>
                    Petugas
                </span>

            </a>




            <a 
            href="{{ route('backup.index') }}">

                <i class="bi bi-database-fill"></i>

                <span>
                    Backup Database
                </span>

            </a>





            <a 
            href="{{ route('tentang-aplikasi') }}"

                <i class="bi bi-info-circle-fill"></i>

                <span>
                    Tentang Aplikasi
                </span>

            </a>


        </div>

    </div>



    <!-- ===========================
            FOOTER
    ============================ -->

    <div class="sidebar-footer">


        <div class="user-info">

            <i class="bi bi-person-circle"></i>

            <div>

                <strong>
                    {{ auth()->user()->nama }}
                </strong>

                <small>
                    Administrator
                </small>

            </div>

        </div>


        <form
            action="{{ route('logout') }}"
            method="POST">

            @csrf

            <button
                type="submit"
                class="logout-btn">

                <i class="bi bi-box-arrow-right"></i>

                <span>
                    Logout
                </span>

            </button>

        </form>

    </div>

</aside>



<!-- =====================================================
     LOADING NAVIGASI SIDEBAR
====================================================== -->

<style>

    #sidebarPageLoader {

        position: fixed;

        top: 0;

        left: 280px;

        right: 0;

        bottom: 0;

        background:
            rgba(245, 247, 251, 0.75);

        backdrop-filter:
            blur(3px);

        display: none;

        align-items: center;

        justify-content: center;

        z-index: 999;

        opacity: 0;

        transition:
            opacity .2s ease,
            left .35s ease;

    }


    #sidebarPageLoader.show {

        display: flex;

        opacity: 1;

    }


    .sidebar-loader-box {

        background: white;

        padding: 25px 35px;

        border-radius: 18px;

        box-shadow:
            0 10px 35px rgba(0, 0, 0, .12);

        text-align: center;

    }


    .sidebar-loader-spinner {

        width: 42px;

        height: 42px;

        border: 4px solid #e5eaf2;

        border-top-color: #173B6C;

        border-radius: 50%;

        animation:
            sidebarSpin .7s linear infinite;

        margin:
            0 auto 12px;

    }


    .sidebar-loader-box span {

        color: #173B6C;

        font-size: 14px;

        font-weight: 600;

    }


    @keyframes sidebarSpin {

        to {

            transform:
                rotate(360deg);

        }

    }


    @media (max-width: 768px) {

        #sidebarPageLoader {

            left: 0;

        }

    }

</style>



<div id="sidebarPageLoader">

    <div class="sidebar-loader-box">

        <div class="sidebar-loader-spinner"></div>

        <span>
            Memuat halaman...
        </span>

    </div>

</div>



<!-- =====================================================
     SIDEBAR JAVASCRIPT
====================================================== -->

<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {


        /*
        |--------------------------------------------------------------------------
        | ELEMENT SIDEBAR
        |--------------------------------------------------------------------------
        */

        const sidebar =
            document.querySelector(
                '.sidebar'
            );


        const main =
            document.querySelector(
                '.main'
            );


        const menu =
            document.querySelector(
                '.menu'
            );


        const toggleButton =
            document.querySelector(
                '.toggle-sidebar'
            );


        const loader =
            document.getElementById(
                'sidebarPageLoader'
            );



        /*
        |--------------------------------------------------------------------------
        | CEK SIDEBAR
        |--------------------------------------------------------------------------
        */

        if (!sidebar) {

            console.log(
                'Sidebar tidak ditemukan.'
            );

            return;

        }



        /*
        |--------------------------------------------------------------------------
        | SIDEBAR COLLAPSE
        |--------------------------------------------------------------------------
        */

        if (
            toggleButton &&
            main
        ) {


            /*
            |--------------------------------------------------------------------------
            | AMBIL STATUS TERAKHIR
            |--------------------------------------------------------------------------
            */

            const savedCollapsed =
                localStorage.getItem(
                    'sidebarCollapsed'
                );


            /*
            |--------------------------------------------------------------------------
            | KEMBALIKAN STATUS
            |--------------------------------------------------------------------------
            */

            if (
                savedCollapsed === 'true'
            ) {

                sidebar.classList.add(
                    'collapsed'
                );

                main.classList.add(
                    'collapsed'
                );

            }



            /*
            |--------------------------------------------------------------------------
            | TOMBOL HAMBURGER
            |--------------------------------------------------------------------------
            */

            toggleButton.addEventListener(
                'click',
                function () {


                    sidebar.classList.toggle(
                        'collapsed'
                    );


                    main.classList.toggle(
                        'collapsed'
                    );


                    /*
                    |--------------------------------------------------------------------------
                    | SIMPAN STATUS
                    |--------------------------------------------------------------------------
                    */

                    const isCollapsed =
                        sidebar.classList.contains(
                            'collapsed'
                        );


                    localStorage.setItem(
                        'sidebarCollapsed',
                        isCollapsed
                    );


                    /*
                    |--------------------------------------------------------------------------
                    | SESUAIKAN LOADING
                    |--------------------------------------------------------------------------
                    */

                    if (loader) {

                        if (
                            isCollapsed
                        ) {

                            loader.style.left =
                                '85px';

                        } else {

                            loader.style.left =
                                '280px';

                        }

                    }

                }
            );



            /*
            |--------------------------------------------------------------------------
            | POSISI LOADING SAAT HALAMAN DIBUKA
            |--------------------------------------------------------------------------
            */

            if (loader) {

                if (
                    sidebar.classList.contains(
                        'collapsed'
                    )
                ) {

                    loader.style.left =
                        '85px';

                } else {

                    loader.style.left =
                        '280px';

                }

            }

        }



        /*
        |--------------------------------------------------------------------------
        | SCROLL SIDEBAR
        |--------------------------------------------------------------------------
        */

        if (menu) {


            /*
            |--------------------------------------------------------------------------
            | KEMBALIKAN SCROLL TERAKHIR
            |--------------------------------------------------------------------------
            */

            const savedScroll =
                sessionStorage.getItem(
                    'sidebarScroll'
                );


            if (
                savedScroll !== null
            ) {

                requestAnimationFrame(
                    function () {

                        menu.scrollTop =
                            parseInt(
                                savedScroll,
                                10
                            );

                    }
                );

            }



            /*
            |--------------------------------------------------------------------------
            | SIMPAN SAAT SCROLL
            |--------------------------------------------------------------------------
            */

            menu.addEventListener(
                'scroll',
                function () {

                    sessionStorage.setItem(
                        'sidebarScroll',
                        menu.scrollTop
                    );

                }
            );



            /*
            |--------------------------------------------------------------------------
            | SIMPAN SAAT MENU DIKLIK
            |--------------------------------------------------------------------------
            */

            menu.querySelectorAll('a')
                .forEach(
                    function (link) {

                        link.addEventListener(
                            'click',
                            function () {

                                sessionStorage.setItem(
                                    'sidebarScroll',
                                    menu.scrollTop
                                );

                            }
                        );

                    }
                );

        }



        /*
        |--------------------------------------------------------------------------
        | LOADING KHUSUS MENU SIDEBAR
        |--------------------------------------------------------------------------
        */

        if (
            loader &&
            sidebar
        ) {


            const sidebarLinks =
                sidebar.querySelectorAll(
                    '.menu a'
                );


            sidebarLinks.forEach(
                function (link) {


                    link.addEventListener(
                        'click',
                        function () {


                            const href =
                                this.getAttribute(
                                    'href'
                                );


                            /*
                            |--------------------------------------------------------------------------
                            | LINK YANG TIDAK PERLU LOADING
                            |--------------------------------------------------------------------------
                            */

                            if (
                                !href ||
                                href === '#' ||
                                href.startsWith(
                                    'javascript:'
                                ) ||
                                this.target === '_blank'
                            ) {

                                return;

                            }



                            /*
                            |--------------------------------------------------------------------------
                            | SIMPAN SCROLL
                            |--------------------------------------------------------------------------
                            */

                            if (menu) {

                                sessionStorage.setItem(
                                    'sidebarScroll',
                                    menu.scrollTop
                                );

                            }



                            /*
                            |--------------------------------------------------------------------------
                            | TAMPILKAN LOADING
                            |--------------------------------------------------------------------------
                            */

                            loader.style.display =
                                'flex';


                            requestAnimationFrame(
                                function () {

                                    loader.classList.add(
                                        'show'
                                    );

                                }
                            );

                        }
                    );

                }
            );



            /*
            |--------------------------------------------------------------------------
            | HILANGKAN LOADING SAAT HALAMAN SELESAI
            |--------------------------------------------------------------------------
            */

            window.addEventListener(
                'pageshow',
                function () {


                    loader.classList.remove(
                        'show'
                    );


                    setTimeout(
                        function () {

                            loader.style.display =
                                'none';

                        },
                        200
                    );

                }
            );

        }

    }
);

</script>