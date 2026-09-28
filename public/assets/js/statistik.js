document.addEventListener(
    "DOMContentLoaded",
    function () {


        /*
        |--------------------------------------------------------------------------
        | CEK DATA
        |--------------------------------------------------------------------------
        */

        if (
            typeof window.statistikData ===
            "undefined"
        ) {

            console.warn(
                "Data statistik tidak ditemukan."
            );

            return;

        }



        /*
        |--------------------------------------------------------------------------
        | CEK CHART.JS
        |--------------------------------------------------------------------------
        */

        if (
            typeof Chart ===
            "undefined"
        ) {

            console.error(
                "Chart.js belum dimuat."
            );

            return;

        }



        /*
        |--------------------------------------------------------------------------
        | DATA
        |--------------------------------------------------------------------------
        */

        const data =
            window.statistikData;



        /*
        |--------------------------------------------------------------------------
        | GRAFIK PEMINJAMAN
        |--------------------------------------------------------------------------
        */

        const canvasPeminjaman =
            document.getElementById(
                "chartPeminjaman"
            );


        if (canvasPeminjaman) {


            const ctx =
                canvasPeminjaman
                    .getContext("2d");


            new Chart(
                ctx,
                {

                    type: "line",


                    data: {

                        labels: [

                            "Jan",
                            "Feb",
                            "Mar",
                            "Apr",
                            "Mei",
                            "Jun",
                            "Jul",
                            "Agu",
                            "Sep",
                            "Okt",
                            "Nov",
                            "Des"

                        ],


                        datasets: [

                            {

                                label:
                                    "Peminjaman",


                                data:
                                    data.peminjaman,


                                fill: true,


                                tension:
                                    0.4,


                                borderWidth:
                                    3,


                                pointRadius:
                                    4,


                                pointHoverRadius:
                                    6

                            }

                        ]

                    },


                    options: {

                        responsive:
                            true,


                        maintainAspectRatio:
                            false,


                        interaction: {

                            intersect:
                                false,

                            mode:
                                "index"

                        },


                        plugins: {

                            legend: {

                                display:
                                    false

                            },


                            tooltip: {

                                displayColors:
                                    false,


                                callbacks: {

                                    title:
                                        function (
                                            tooltipItems
                                        ) {

                                            return (
                                                tooltipItems[0]
                                                    .label
                                            );

                                        },


                                    label:
                                        function (
                                            context
                                        ) {

                                            return (
                                                " Peminjaman: " +
                                                context.parsed.y +
                                                " transaksi"
                                            );

                                        }

                                }

                            }

                        },


                        scales: {

                            y: {

                                beginAtZero:
                                    true,


                                ticks: {

                                    precision:
                                        0

                                },


                                grid: {

                                    color:
                                        "rgba(23,59,108,.08)"

                                }

                            },


                            x: {

                                grid: {

                                    display:
                                        false

                                }

                            }

                        }

                    }

                }
            );

        }



        /*
        |--------------------------------------------------------------------------
        | GRAFIK STATUS BUKU
        |--------------------------------------------------------------------------
        */

        const canvasStatus =
            document.getElementById(
                "chartStatusBuku"
            );


        if (canvasStatus) {


            const ctx =
                canvasStatus
                    .getContext("2d");


            new Chart(
                ctx,
                {

                    type:
                        "doughnut",


                    data: {

                        labels: [

                            "Tersedia",
                            "Dipinjam",
                            "Rusak"

                        ],


                        datasets: [

                            {

                                data: [

                                    data.buku.tersedia,

                                    data.buku.dipinjam,

                                    data.buku.rusak

                                ],


                                borderWidth:
                                    3

                            }

                        ]

                    },


                    options: {

                        responsive:
                            true,


                        maintainAspectRatio:
                            false,


                        cutout:
                            "68%",


                        plugins: {

                            legend: {

                                display:
                                    false

                            },


                            tooltip: {

                                callbacks: {

                                    label:
                                        function (
                                            context
                                        ) {

                                            return (
                                                " " +
                                                context.label +
                                                ": " +
                                                context.parsed
                                            );

                                        }

                                }

                            }

                        }

                    }

                }
            );

        }



        /*
        |--------------------------------------------------------------------------
        | ANIMASI ANGKA
        |--------------------------------------------------------------------------
        |
        | Hanya animasi angka statistik.
        | Tidak mempengaruhi Show / Modal / Print.
        |
        */

        const statisticNumbers =
            document.querySelectorAll(
                ".statistik-card h2"
            );


        statisticNumbers.forEach(
            function (element) {


                const target =
                    parseInt(
                        element.textContent
                            .trim(),
                        10
                    );


                if (
                    isNaN(target)
                ) {

                    return;

                }


                let current =
                    0;


                const duration =
                    700;


                const start =
                    performance.now();


                function animate(
                    timestamp
                ) {


                    const progress =
                        Math.min(
                            (
                                timestamp -
                                start
                            ) /
                            duration,
                            1
                        );


                    const eased =
                        1 -
                        Math.pow(
                            1 - progress,
                            3
                        );


                    current =
                        Math.floor(
                            target *
                            eased
                        );


                    element.textContent =
                        current
                            .toLocaleString(
                                "id-ID"
                            );


                    if (
                        progress <
                        1
                    ) {

                        requestAnimationFrame(
                            animate
                        );

                    } else {

                        element.textContent =
                            target
                                .toLocaleString(
                                    "id-ID"
                                );

                    }

                }


                requestAnimationFrame(
                    animate
                );

            }
        );

    }
);