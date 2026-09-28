document.addEventListener(
    "DOMContentLoaded",
    function () {

        /*
        |--------------------------------------------------------------------------
        | LAPORAN - FILTER
        |--------------------------------------------------------------------------
        */

        const form =
    document.querySelector(
        ".laporan-filter form"
    );

if (form) {

    form.addEventListener(
        "submit",
        function (event) {

            const mulai =
                form.querySelector(
                    '[name="tanggal_mulai"]'
                );

            const selesai =
                form.querySelector(
                    '[name="tanggal_selesai"]'
                );

            if (
                mulai.value &&
                selesai.value &&
                mulai.value > selesai.value
            ) {

                alert(
                    "Tanggal mulai tidak boleh lebih besar dari tanggal selesai."
                );

                event.preventDefault();

            }

        }
    );

}


        /*
        |--------------------------------------------------------------------------
        | ANIMASI CARD
        |--------------------------------------------------------------------------
        */

        const cards =
            document.querySelectorAll(
                ".laporan-summary"
            );


        cards.forEach(
            function (card, index) {

                card.style.opacity = "0";

                card.style.transform =
                    "translateY(10px)";


                setTimeout(
                    function () {

                        card.style.transition =
                            "opacity .4s ease, transform .4s ease";

                        card.style.opacity =
                            "1";

                        card.style.transform =
                            "translateY(0)";

                    },
                    index * 80
                );

            }
        );


        /*
        |--------------------------------------------------------------------------
        | HIGHLIGHT MENU
        |--------------------------------------------------------------------------
        */

        const menuCards =
            document.querySelectorAll(
                ".laporan-menu-card"
            );


        menuCards.forEach(
            function (card) {

                card.addEventListener(
                    "click",
                    function () {

                        card.classList.add(
                            "clicked"
                        );

                    }
                );

            }
        );

    }
);