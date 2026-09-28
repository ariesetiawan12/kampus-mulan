document.addEventListener(
    "DOMContentLoaded",
    function () {

        /*
        |--------------------------------------------------------------------------
        | PRINT OTOMATIS
        |--------------------------------------------------------------------------
        |
        | Tidak langsung print ketika halaman dibuka.
        | User tetap bisa mengecek laporan terlebih dahulu.
        |
        */

        const tombolPrint =
            document.querySelector(
                ".btn-print"
            );


        if (tombolPrint) {

            tombolPrint.addEventListener(
                "click",
                function () {

                    window.print();

                }
            );

        }


        /*
        |--------------------------------------------------------------------------
        | SETELAH PRINT
        |--------------------------------------------------------------------------
        */

        window.addEventListener(
            "afterprint",
            function () {

                console.log(
                    "Laporan selesai dicetak."
                );

            }
        );

    }
);