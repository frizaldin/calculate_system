<x-layouts>
    <x-nav.navbar.breadcrumb />
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="card bg-corner-img mb-0">
                        <div class="card-body">
                            <div class="row d-flex justify-content-center">
                                <div class="col-9">
                                    <p class="text-muted text-uppercase mb-0 fw-normal fs-13">Sisa Uang</p>
                                    <h4 class="mt-1 mb-0 fw-medium">Rp.
                                        {{ number_format($wallet) }}</h4>
                                </div>
                                <!--end col-->
                                <div class="col-3 align-self-center">
                                    <div
                                        class="d-flex justify-content-center align-items-center thumb-md border-dashed border-primary rounded mx-auto">
                                        <i class="iconoir-dollar-circle fs-22 align-self-center mb-0 text-primary"></i>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>
                        <!--end card-body-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                @foreach ($unpaid_items as $item)
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="m-0 card-title">Pembayaran {{ $item->title }}</h6>
                            </div>
                            <div class="card-body">
                                <strong><code>Rp. {{ number_format($item->amount) }}</code></strong>
                            </div>
                            <div class="card-footer">
                                <button type="button" class="btn btn-soft-danger pay-bill"
                                    data-id="{{ $item->id }}">Bayar Tagihan</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <x-slot name="js">
        <script>
            $(document).ready(function() {
                $('.pay-bill').on('click', function() {
                    var id = $(this).data('id');
                    if (!id) {
                        Swal.fire({
                            icon: 'error',
                            title: 'ID Tidak Ditemukan',
                            text: 'ID tagihan tidak ditemukan.',
                            confirmButtonText: 'OK'
                        });
                        return;
                    }

                    $.ajax({
                        url: "{{ url('/monthly_finances/pay_bill') }}",
                        type: 'POST',
                        data: {
                            id: id
                        },
                        beforeSend: function() {
                            Swal.fire({
                                title: 'Memproses...',
                                text: 'Mohon tunggu sebentar.',
                                allowOutsideClick: false,
                                didOpen: () => {
                                    Swal.showLoading()
                                }
                            });
                        },
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: 'Pembayaran berhasil!',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                location.reload();
                            });
                        },
                        error: function(xhr) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: 'Terjadi kesalahan saat membayar tagihan.',
                                confirmButtonText: 'OK'
                            });
                        }
                    });
                });
            });
        </script>
    </x-slot>
</x-layouts>
