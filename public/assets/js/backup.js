// ==========================================
// BACKUP DATABASE
// ==========================================

document.addEventListener("DOMContentLoaded", function () {

    const btnBackup =
        document.getElementById("btnBackup");


    if (!btnBackup) {
        return;
    }


    btnBackup.addEventListener("click", function () {

        Swal.fire({

            title: "Backup Database?",

            html: `
                <p>
                    Sistem akan membuat salinan
                    seluruh database perpustakaan.
                </p>

                <p class="text-muted mb-0">
                    File akan otomatis diunduh
                    dalam format <strong>.sql</strong>.
                </p>
            `,

            icon: "question",

            showCancelButton: true,

            confirmButtonText:
                '<i class="bi bi-database-down"></i> Ya, Backup',

            cancelButtonText:
                "Batal",

            confirmButtonColor:
                "#173B6C",

            cancelButtonColor:
                "#6c757d",

        }).then(function (result) {

            if (result.isConfirmed) {

                // Loading
                Swal.fire({

                    title:
                        "Membuat Backup...",

                    text:
                        "Mohon tunggu sebentar.",

                    allowOutsideClick:
                        false,

                    allowEscapeKey:
                        false,

                    didOpen: function () {

                        Swal.showLoading();

                    }

                });


                // Redirect ke endpoint download
                window.location.href =
                    "/backup/download";


                // Tutup loading setelah beberapa saat
                setTimeout(function () {

                    Swal.close();

                    Swal.fire({

                        icon: "success",

                        title:
                            "Backup Berhasil",

                        text:
                            "File database berhasil dibuat dan diunduh.",

                        confirmButtonColor:
                            "#173B6C"

                    });

                }, 1800);

            }

        });

    });

});