// ======================================
// BUKU.JS
// ======================================

document.addEventListener("DOMContentLoaded", function () {

    const form = document.getElementById("formBuku");

    const modalTitle = document.getElementById("modalTitle");

    const btnTambah = document.getElementById("btnTambah");

    const preview = document.getElementById("preview");

    const cover = document.getElementById("cover");

    // TAMBAHAN: KODE BUKU
    const kodeBuku = document.getElementById("kode_buku");


    // ======================================
    // PREVIEW COVER
    // ======================================

    if (cover) {

        cover.addEventListener("change", function () {

            const file = this.files[0];

            if (file) {

                preview.src = URL.createObjectURL(file);

            }

        });

    }


    // ======================================
    // TAMBAH
    // ======================================

    if (btnTambah) {

        btnTambah.addEventListener("click", function () {

            modalTitle.innerHTML =
            '<i class="bi bi-book-fill"></i> Tambah Buku';

            form.action = "/buku";

            document.getElementById("method").innerHTML = "";

            form.reset();

            // KOSONGKAN KODE BUKU SAAT TAMBAH
            kodeBuku.value = "";

            preview.src = "/assets/img/no-image.png";

        });

    }


    // ======================================
    // EDIT
    // ======================================

    document.querySelectorAll(".btn-edit").forEach(function (button) {

        button.addEventListener("click", function () {

            let id = this.dataset.id;

            fetch("/buku/" + id + "/edit")

            .then(res => res.json())

            .then(data => {

                modalTitle.innerHTML =
                '<i class="bi bi-pencil-square"></i> Edit Buku';

                form.action = "/buku/" + id;

                document.getElementById("method").innerHTML =
                '<input type="hidden" name="_method" value="PUT">';


                // ======================================
                // KODE BUKU
                // ======================================

                kodeBuku.value = data.kode_buku || "";


                // ======================================
                // DATA BUKU
                // ======================================

                document.getElementById("judul").value = data.judul;

                document.getElementById("kategori_id").value = data.kategori_id;

                document.getElementById("rak_id").value = data.rak_id;

                document.getElementById("penulis").value = data.penulis;

                document.getElementById("penerbit").value = data.penerbit;

                document.getElementById("tahun_terbit").value = data.tahun_terbit;

                document.getElementById("isbn").value = data.isbn;

                document.getElementById("stok").value = data.stok;

                document.getElementById("deskripsi").value = data.deskripsi;

                document.getElementById("status").value = data.status;


                // ======================================
                // COVER
                // ======================================

                if(data.cover){

                    preview.src="/storage/"+data.cover;

                }else{

                    preview.src="/assets/img/no-image.png";

                }

            });

        });

    });


    // ======================================
    // DETAIL
    // ======================================

    document.querySelectorAll(".btn-show").forEach(function(button){

        button.addEventListener("click",function(){

            let id=this.dataset.id;

            fetch("/buku/"+id)

            .then(res=>res.json())

            .then(data=>{

                Swal.fire({

                    title:data.judul,

                    width:700,

                    html:`

                    <img
                    src="${data.cover ?
                    '/storage/'+data.cover :
                    '/assets/img/no-image.png'}"
                    style="width:150px;
                    border-radius:10px;
                    margin-bottom:15px;">

                    <table class="table">

                        <tr>

                            <th>Kode</th>

                            <td>${data.kode_buku}</td>

                        </tr>

                        <tr>

                            <th>Penulis</th>

                            <td>${data.penulis}</td>

                        </tr>

                        <tr>

                            <th>Penerbit</th>

                            <td>${data.penerbit}</td>

                        </tr>

                        <tr>

                            <th>ISBN</th>

                            <td>${data.isbn}</td>

                        </tr>

                        <tr>

                            <th>Stok</th>

                            <td>${data.stok}</td>

                        </tr>

                        <tr>

                            <th>Status</th>

                            <td>${data.status}</td>

                        </tr>

                    </table>

                    `,

                    confirmButtonText:"Tutup"

                });

            });

        });

    });


    // ======================================
    // DELETE
    // ======================================

    document.querySelectorAll(".btn-delete").forEach(function(button){

        button.addEventListener("click",function(e){

            e.preventDefault();

            let formDelete=this.closest("form");

            Swal.fire({

                title:"Hapus Buku?",

                text:"Data buku akan dihapus permanen.",

                icon:"warning",

                showCancelButton:true,

                confirmButtonColor:"#173B6C",

                cancelButtonColor:"#dc3545",

                confirmButtonText:"Ya, Hapus",

                cancelButtonText:"Batal"

            })

            .then((result)=>{

                if(result.isConfirmed){

                    formDelete.submit();

                }

            });

        });

    });

});