document.addEventListener("DOMContentLoaded", function () {

    // =====================================================
    // ELEMENT
    // =====================================================

    const sidebar =
        document.querySelector(".sidebar");

    const main =
        document.querySelector(".main");

    const menu =
        document.querySelector(".menu");

    // BISA ID ATAU CLASS
    const toggleButton =
        document.querySelector(
            "#toggleSidebar, .toggle-sidebar"
        );

    const loader =
        document.getElementById(
            "sidebarPageLoader"
        );


    // =====================================================
    // DEBUG
    // =====================================================

    console.log("===== SIDEBAR CHECK =====");

    console.log(
        "Sidebar:",
        sidebar
    );

    console.log(
        "Main:",
        main
    );

    console.log(
        "Toggle:",
        toggleButton
    );

    console.log(
        "Mobile:",
        window.innerWidth <= 768
    );


    // =====================================================
    // CEK
    // =====================================================

    if (!sidebar) {

        console.error(
            "SIDEBAR TIDAK DITEMUKAN"
        );

        return;

    }

    if (!toggleButton) {

        console.error(
            "TOMBOL SIDEBAR TIDAK DITEMUKAN"
        );

        return;

    }


    // =====================================================
    // OVERLAY
    // =====================================================

    let overlay =
        document.querySelector(
            ".sidebar-overlay"
        );


    if (!overlay) {

        overlay =
            document.createElement("div");

        overlay.className =
            "sidebar-overlay";

        document.body.appendChild(
            overlay
        );

    }


    // =====================================================
    // CEK MOBILE
    // =====================================================

    function isMobile() {

        return window.innerWidth <= 768;

    }


    // =====================================================
    // BUKA MOBILE
    // =====================================================

    function openMobile() {

        console.log(
            "BUKA SIDEBAR MOBILE"
        );


        // pastikan desktop collapsed hilang
        sidebar.classList.remove(
            "collapsed"
        );


        if (main) {

            main.classList.remove(
                "collapsed"
            );

        }


        // buka sidebar
        sidebar.classList.add(
            "show"
        );


        // tampilkan overlay
        overlay.classList.add(
            "show"
        );

    }


    // =====================================================
    // TUTUP MOBILE
    // =====================================================

    function closeMobile() {

        console.log(
            "TUTUP SIDEBAR MOBILE"
        );


        sidebar.classList.remove(
            "show"
        );


        overlay.classList.remove(
            "show"
        );

    }


    // =====================================================
    // TOGGLE
    // =====================================================

    toggleButton.addEventListener(
        "click",
        function (event) {

            event.preventDefault();

            event.stopPropagation();


            console.log(
                "HAMBURGER DIKLIK"
            );


            // =================================================
            // MOBILE
            // =================================================

            if (isMobile()) {

                if (
                    sidebar.classList.contains(
                        "show"
                    )
                ) {

                    closeMobile();

                } else {

                    openMobile();

                }

                return;

            }


            // =================================================
            // DESKTOP
            // =================================================

            sidebar.classList.toggle(
                "collapsed"
            );


            if (main) {

                main.classList.toggle(
                    "collapsed"
                );

            }


            // simpan status
            const collapsed =
                sidebar.classList.contains(
                    "collapsed"
                );


            localStorage.setItem(
                "sidebarCollapsed",
                collapsed
            );


            // posisi loader
            if (loader) {

                loader.style.left =
                    collapsed
                        ? "85px"
                        : "280px";

            }

        }
    );


    // =====================================================
    // OVERLAY CLICK
    // =====================================================

    overlay.addEventListener(
        "click",
        function () {

            closeMobile();

        }
    );


    // =====================================================
    // MENU CLICK
    // =====================================================

    const links =
        sidebar.querySelectorAll(
            ".menu a"
        );


    links.forEach(
        function (link) {

            link.addEventListener(
                "click",
                function () {

                    // simpan scroll
                    if (menu) {

                        sessionStorage.setItem(
                            "sidebarScroll",
                            menu.scrollTop
                        );

                    }


                    // mobile tutup
                    if (isMobile()) {

                        closeMobile();

                    }


                    // loading
                    if (!loader) {
                        return;
                    }


                    const href =
                        this.getAttribute(
                            "href"
                        );


                    if (
                        !href ||
                        href === "#" ||
                        href.startsWith(
                            "javascript:"
                        ) ||
                        this.target === "_blank"
                    ) {

                        return;

                    }


                    loader.style.display =
                        "flex";


                    requestAnimationFrame(
                        function () {

                            loader.classList.add(
                                "show"
                            );

                        }
                    );

                }
            );

        }
    );


    // =====================================================
    // RESTORE SCROLL
    // =====================================================

    if (menu) {

        const savedScroll =
            sessionStorage.getItem(
                "sidebarScroll"
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


        menu.addEventListener(
            "scroll",
            function () {

                sessionStorage.setItem(
                    "sidebarScroll",
                    menu.scrollTop
                );

            }
        );

    }


    // =====================================================
    // RESTORE DESKTOP
    // =====================================================

    if (!isMobile()) {

        const saved =
            localStorage.getItem(
                "sidebarCollapsed"
            );


        if (saved === "true") {

            sidebar.classList.add(
                "collapsed"
            );


            if (main) {

                main.classList.add(
                    "collapsed"
                );

            }

        }

    }


    // =====================================================
    // PAGE SHOW
    // =====================================================

    if (loader) {

        window.addEventListener(
            "pageshow",
            function () {

                loader.classList.remove(
                    "show"
                );


                setTimeout(
                    function () {

                        loader.style.display =
                            "none";

                    },
                    200
                );

            }
        );

    }


    // =====================================================
    // RESIZE
    // =====================================================

    window.addEventListener(
        "resize",
        function () {

            if (isMobile()) {

                sidebar.classList.remove(
                    "collapsed"
                );


                if (main) {

                    main.classList.remove(
                        "collapsed"
                    );

                }

            } else {

                closeMobile();


                const saved =
                    localStorage.getItem(
                        "sidebarCollapsed"
                    );


                if (saved === "true") {

                    sidebar.classList.add(
                        "collapsed"
                    );


                    if (main) {

                        main.classList.add(
                            "collapsed"
                        );

                    }

                }

            }

        }
    );


    // =====================================================
    // ESC
    // =====================================================

    document.addEventListener(
        "keydown",
        function (event) {

            if (
                event.key === "Escape" &&
                isMobile()
            ) {

                closeMobile();

            }

        }
    );

});