<x-layouts>
    <x-nav.navbar.breadcrumb />
    <form action="{{ $base_url . '/create' }}" method="POST" class="_form">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">{{ $title ?? 'Tambah Pengeluaran' }}</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <label class="form-label">Tipe Sumber</label>
                            <select id="source_type" class="form-control">
                                <option value="none">Tidak dari keduanya</option>
                                <option value="wishlist">Wishlist</option>
                                <option value="monthly_finance">Monthly Finance</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3 source-group" id="wishlist_group" style="display:none;">
                        <div class="form-group">
                            <label class="form-label">Wishlist</label>
                            <select name="wishlist_id" class="form-control">
                                <option value="">-- Pilih Wishlist --</option>
                                @foreach ($wishlists as $wishlist)
                                    <option value="{{ $wishlist->id }}" data-amount="{{ $wishlist->price }}">
                                        {{ $wishlist->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3 source-group" id="monthly_finance_group" style="display:none;">
                        <div class="form-group">
                            <label class="form-label">Monthly Finance</label>
                            <select name="monthly_finance_id" class="form-control">
                                <option value="">-- Pilih Monthly Finance --</option>
                                @foreach ($monthlyFinances as $mf)
                                    <option value="{{ $mf->id }}" data-amount="{{ $mf->amount }}">
                                        {{ $mf->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <label class="form-label">Tujuan Pengeluaran</label>
                            <input type="text" name="purpose" class="form-control" placeholder="Masukan Tujuan"
                                required>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <label class="form-label">Tanggal</label>
                            <input type="date" name="date" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <label class="form-label">Jumlah</label>
                            <input type="text" name="amount" class="form-control price" placeholder="Masukan Jumlah"
                                required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ $base_url }}" class="btn btn-secondary "><i class="fa-solid fa-arrow-left me-1"></i>
                    Kembali</a>
                <button type="submit" class="btn btn-success "><i class="fa-solid fa-floppy-disk me-1"></i>
                    Simpan</button>
            </div>
        </div>
    </form>
    <x-slot name="js">
        <script>
            $(function() {
                function setAmountFromSelect(select) {
                    var amount = $(select).find('option:selected').data('amount');
                    if (amount !== undefined) {
                        var $amountInput = $("input[name='amount']");
                        $amountInput.val(amount);
                        $amountInput.trigger('input'); // trigger masking
                    }
                }

                function toggleSource() {
                    var val = $('#source_type').val();
                    $('.source-group').hide();
                    if (val === 'wishlist') {
                        $('#wishlist_group').show();
                        $("select[name='wishlist_id']").prop('disabled', false);
                        $("select[name='monthly_finance_id']").prop('disabled', true);
                        setAmountFromSelect($("select[name='wishlist_id']"));
                    } else if (val === 'monthly_finance') {
                        $('#monthly_finance_group').show();
                        $("select[name='monthly_finance_id']").prop('disabled', false);
                        $("select[name='wishlist_id']").prop('disabled', true);
                        setAmountFromSelect($("select[name='monthly_finance_id']"));
                    } else {
                        $("select[name='wishlist_id']").prop('disabled', true);
                        $("select[name='monthly_finance_id']").prop('disabled', true);
                        var $amountInput = $("input[name='amount']");
                        $amountInput.val('');
                        $amountInput.trigger('input');
                    }
                }
                $('#source_type').on('change', toggleSource);
                $("select[name='wishlist_id']").on('change', function() {
                    setAmountFromSelect(this);
                });
                $("select[name='monthly_finance_id']").on('change', function() {
                    setAmountFromSelect(this);
                });
                toggleSource();
            });
        </script>
        <script src="{{ asset('js/post/post.js') }}"></script>
    </x-slot>
</x-layouts>
