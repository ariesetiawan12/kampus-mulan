// ==========================================
// ANGGOTA.JS
// ==========================================

document.addEventListener("DOMContentLoaded", function () {

    const form = document.getElementById("formAnggota");
    const modalTitle = document.getElementById("modalTitle");
    const btnTambah = document.getElementById("btnTambah");

    const kodeAnggota = document.getElementById("kode_anggota");
    const nis = document.getElementById("nis");
    const nama = document.getElementById("nama");
    const kelas = document.getElementById("kelas_id");
    const jenisKelamin = document.getElementById("jenis_kelamin");
    const noHp = document.getElementById("no_hp");
    const alamat = document.getElementById("alamat");
    const status = document.getElementById("status");
    const method = document.getElementById("method");


    // ==========================================
    // TAMBAH ANGGOTA
    // ==========================================

    if (btnTambah) {

        btnTambah.addEventListener("click", function () {

            modalTitle.innerHTML =
                '<i class="bi bi-person-plus-fill"></i> Tambah Anggota';

            form.action = "/anggota";

            method.innerHTML = "";

            form.reset();

            // Kode tetap mengikuti kode yang diberikan Controller
            if (kodeAnggota) {
                kodeAnggota.value = kodeAnggota.dataset.kode || kodeAnggota.value;
            }

            // Default status
            if (status) {
                status.value = "Aktif";
            }

        });

    }


    // ==========================================
    // EDIT ANGGOTA
    // ==========================================

    document.querySelectorAll(".btn-edit").forEach(function (button) {

        button.addEventListener("click", function () {

            const id = this.dataset.id;

            fetch("/anggota/" + id + "/edit")

                .then(response => {

                    if (!response.ok) {
                        throw new Error("Gagal mengambil data anggota.");
                    }

                    return response.json();

                })

                .then(data => {

                    modalTitle.innerHTML =
                        '<i class="bi bi-pencil-square"></i> Edit Anggota';

                    form.action = "/anggota/" + id;

                    method.innerHTML =
                        '<input type="hidden" name="_method" value="PUT">';

                    // Kode
                    if (kodeAnggota) {
                        kodeAnggota.value = data.kode_anggota;
                    }

                    // Data anggota
                    nis.value = data.nis ?? "";

                    nama.value = data.nama ?? "";

                    kelas.value = data.kelas_id ?? "";

                    jenisKelamin.value = data.jenis_kelamin ?? "";

                    noHp.value = data.no_hp ?? "";

                    alamat.value = data.alamat ?? "";

                    status.value = data.status ?? "Aktif";

                })

                .catch(error => {

                    console.error(error);

                    Swal.fire({

                        icon: "error",

                        title: "Gagal",

                        text: "Data anggota tidak dapat diambil."

                    });

                });

        });

    });


    // ==========================================
    // DETAIL ANGGOTA
    // ==========================================

    document.querySelectorAll(".btn-show").forEach(function (button) {

        button.addEventListener("click", function () {

            const id = this.dataset.id;

            fetch("/anggota/" + id)

                .then(response => {

                    if (!response.ok) {
                        throw new Error("Gagal mengambil detail anggota.");
                    }

                    return response.json();

                })

                .then(data => {

                    const kelasNama =
                        data.kelas
                            ? data.kelas.nama_kelas
                            : "-";

                    const jenisKelaminText =
                        data.jenis_kelamin === "L"
                            ? "Laki-laki"
                            : "Perempuan";

                    const statusBadge =
                        data.status === "Aktif"
                            ? '<span class="badge bg-success">Aktif</span>'
                            : '<span class="badge bg-danger">Nonaktif</span>';

                    Swal.fire({

                        title: data.nama,

                        icon: "info",

                        width: 650,

                        html: `

                            <div class="text-start">

                                <table class="table table-bordered">

                                    <tr>
                                        <th width="180">
                                            Kode Anggota
                                        </th>

                                        <td>
                                            ${data.kode_anggota}
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>
                                            NIS
                                        </th>

                                        <td>
                                            ${data.nis}
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>
                                            Nama
                                        </th>

                                        <td>
                                            ${data.nama}
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>
                                            Kelas
                                        </th>

                                        <td>
                                            ${kelasNama}
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>
                                            Jenis Kelamin
                                        </th>

                                        <td>
                                            ${jenisKelaminText}
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>
                                            Nomor HP
                                        </th>

                                        <td>
                                            ${data.no_hp ?? "-"}
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>
                                            Alamat
                                        </th>

                                        <td>
                                            ${data.alamat ?? "-"}
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>
                                            Status
                                        </th>

                                        <td>
                                            ${statusBadge}
                                        </td>
                                    </tr>

                                </table>

                            </div>

                        `,

                        confirmButtonColor: "#173B6C",

                        confirmButtonText: "Tutup"

                    });

                })

                .catch(error => {

                    console.error(error);

                    Swal.fire({

                        icon: "error",

                        title: "Gagal",

                        text: "Detail anggota tidak dapat ditampilkan."

                    });

                });

        });

    });


    // ==========================================
    // DELETE ANGGOTA
    // ==========================================

    document.querySelectorAll(".btn-delete").forEach(function (button) {

        button.addEventListener("click", function (e) {

            e.preventDefault();

            const formDelete = this.closest("form");

            Swal.fire({

                title: "Hapus Data?",

                text: "Data anggota akan dihapus secara permanen.",

                icon: "warning",

                showCancelButton: true,

                confirmButtonColor: "#173B6C",

                cancelButtonColor: "#dc3545",

                confirmButtonText: "Ya, Hapus",

                cancelButtonText: "Batal"

            }).then((result) => {

                if (result.isConfirmed) {

                    formDelete.submit();

                }

            });

        });

    });


    // ==========================================
    // RESET MODAL SETELAH DITUTUP
    // ==========================================

    const modalAnggota =
        document.getElementById("modalAnggota");

    if (modalAnggota) {

        modalAnggota.addEventListener(
            "hidden.bs.modal",
            function () {

                // Jangan mengubah form saat sedang
                // menampilkan error validasi Laravel.

                if (form) {

                    method.innerHTML = "";

                }

            }
        );

    }

});