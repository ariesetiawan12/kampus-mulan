document.addEventListener(
    "DOMContentLoaded",
    function () {

        /*
        |--------------------------------------------------------------------------
        | ANIMASI MASUK
        |--------------------------------------------------------------------------
        */

        const items =
            document.querySelectorAll(
                ".tentang-card, .fitur-card"
            );


        items.forEach(
            function (item, index) {

                item.style.opacity = "0";

                item.style.transform =
                    "translateY(12px)";


                setTimeout(
                    function () {

                        item.style.transition =
                            "opacity .4s ease, transform .4s ease";

                        item.style.opacity =
                            "1";

                        item.style.transform =
                            "translateY(0)";

                    },
                    80 + (index * 70)
                );

            }
        );


        /*
        |--------------------------------------------------------------------------
        | HERO
        |--------------------------------------------------------------------------
        */

        const hero =
            document.querySelector(
                ".tentang-hero"
            );


        if (hero) {

            hero.style.opacity = "0";

            hero.style.transform =
                "translateY(10px)";


            requestAnimationFrame(
                function () {

                    hero.style.transition =
                        "opacity .5s ease, transform .5s ease";

                    hero.style.opacity =
                        "1";

                    hero.style.transform =
                        "translateY(0)";

                }
            );

        }

    }
);