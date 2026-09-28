<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Perpustakaan Digital')
    </title>


    {{-- =====================================================
        GOOGLE FONT
    ====================================================== --}}

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


    {{-- =====================================================
        BOOTSTRAP CSS
    ====================================================== --}}

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
        rel="stylesheet">


    {{-- =====================================================
        BOOTSTRAP ICON
    ====================================================== --}}

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
        rel="stylesheet">


    {{-- =====================================================
        SWEETALERT
    ====================================================== --}}

    <script
        src="https://cdn.jsdelivr.net/npm/sweetalert2@11">
    </script>


    {{-- =====================================================
        CSS UTAMA
    ====================================================== --}}

    <link
        rel="stylesheet"
        href="{{ asset('assets/css/style.css') }}">


    {{-- =====================================================
        CSS TAMBAHAN PER HALAMAN
    ====================================================== --}}

    @stack('styles')

</head>


<body>


    {{-- =====================================================
        SIDEBAR
    ====================================================== --}}

    @include('layouts.sidebar')


    {{-- =====================================================
        MAIN
    ====================================================== --}}

    <div class="main">


        {{-- =================================================
            NAVBAR
        ================================================== --}}

        @include('layouts.navbar')


        {{-- =================================================
            CONTENT
        ================================================== --}}

        <div class="page-content">

            @yield('content')

        </div>


        {{-- =================================================
            FOOTER
        ================================================== --}}

        @include('layouts.footer')

    </div>



    {{-- =====================================================
        BOOTSTRAP JAVASCRIPT
    ====================================================== --}}

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js">
    </script>


    {{-- =====================================================
        CHART JS
    ====================================================== --}}

    <script
        src="https://cdn.jsdelivr.net/npm/chart.js">
    </script>


    {{-- =====================================================
        JAVASCRIPT PER HALAMAN
    ====================================================== --}}

    @stack('scripts')



    {{-- =====================================================
        SUCCESS MESSAGE
    ====================================================== --}}

    @if(session('success'))

        <script>

            Swal.fire({

                icon: 'success',

                title: 'Berhasil',

                text: @json(session('success')),

                timer: 2000,

                showConfirmButton: false

            });

        </script>

    @endif



    {{-- =====================================================
        ERROR MESSAGE
    ====================================================== --}}

    @if(session('error'))

        <script>

            Swal.fire({

                icon: 'error',

                title: 'Gagal',

                text: @json(session('error'))

            });

        </script>

    @endif



    {{-- =====================================================
        VALIDATION ERROR
    ====================================================== --}}

    @if($errors->any())

        <script>

            Swal.fire({

                icon: 'error',

                title: 'Terjadi Kesalahan',

                html: @json(
                    implode('<br>', $errors->all())
                )

            });

        </script>

    @endif


</body>

</html>