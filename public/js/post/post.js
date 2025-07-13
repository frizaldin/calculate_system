if (typeof ignoreConfirmation === 'undefined') {
    var ignoreConfirmation = document.currentScript.getAttribute('ignoreConfirmation');
}

var $editors = $(".ckeditor");
if ($editors.length) {
    for (instance in ClassicEditor.instances) {
        ClassicEditor.instances[instance].updateElement();
    }
}

$('._form').submit(function (e) {
    e.preventDefault()

    const run = (e) => {
        showLoading()

        $.ajax({
            url: this.action,
            type: "POST",
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
            success: function (e) {
                console.log(e);
                Swal.close();

                // Cek jika ada error validasi
                if (e.success === false && e.errors) {
                    let pesanError = e.message ? e.message + "\n" : "";
                    // Gabungkan semua pesan error dari setiap field
                    for (const field in e.errors) {
                        if (Array.isArray(e.errors[field])) {
                            pesanError += e.errors[field].join('\n') + "\n";
                        } else {
                            pesanError += e.errors[field] + "\n";
                        }
                    }
                    Swal.fire({
                        title: 'Gagal!',
                        text: pesanError.trim(),
                        icon: 'error',
                        showConfirmButton: true,
                    });
                    return;
                }

                Swal.fire({
                    title: (e.success == true) ? 'Berhasil!' : 'Gagal!',
                    text: e.message,
                    icon: (e.success == true) ? 'success' : 'error',
                    showConfirmButton: false,
                    timer: (e.success == true) ? 1500 : 10000
                });
                if (e.url) {
                    window.location.replace(e.url)
                }
                if (e.reload) {
                    window.location.reload()
                }
            },
            error: function (xhr, status, error) {
                Swal.close()
                var err = eval("(" + xhr.responseText + ")");
                console.log(error.errors.name);
                
                Swal.fire({
                    title: 'Gagal!',
                    text: err.message,
                    icon: 'error',
                    buttons: {
                        cancel: "Tutup",
                    },
                });
            }
        });
        return false;
    };

    if (ignoreConfirmation) {
        run(e)
    } else {
        Swal.fire({
            title: 'Apakah data anda sudah benar?',
            text: "Pastikan data yang anda masukan sudah benar untuk di simpan",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, data sudah benar',
            cancelButtonText: 'Tidak, saya akan cek lagi'
        }).then((result) => {
            if (result.isConfirmed) {
                run(e)
            }
        })
    }

})
