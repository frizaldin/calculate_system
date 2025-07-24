<x-layouts>
    <x-nav.navbar.breadcrumb />
    <form action="{{ $base_url . '/update' }}" method="POST" class="_form">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">{{ $title ?? 'Edit Angsuran/Pengeluaran Bulanan' }}</h4>
            </div>
            <div class="card-body">
                <input type="hidden" name="id" value="{{ $item->id }}">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <label class="form-label">Judul</label>
                            <input type="text" name="title" class="form-control" placeholder="Masukan Judul"
                                value="{{ $item->title }}" required>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <label class="form-label">Angsuran (opsional)</label>
                            <input type="number" name="installments" class="form-control"
                                placeholder="Masukan Angsuran" value="{{ $item->installments }}">
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <label class="form-label">Tanggal Tagihan</label>
                            <input type="number" name="billed_day" class="form-control" placeholder="Pilih hari (1-31)"
                                min="1" max="31" value="{{ $item->billed_day }}" required>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <label class="form-label">Frekuensi Pembayaran</label>
                            <select name="frequently" class="form-control" required>
                                <option value="Monthly" {{ $item->frequently == 'Monthly' ? 'selected' : '' }}>Bulanan
                                </option>
                                <option value="Yearly" {{ $item->frequently == 'Yearly' ? 'selected' : '' }}>Tahunan
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <label class="form-label">Tipe</label>
                            <select name="type" class="form-control" required>
                                <option value="Temporary" {{ $item->type == 'Temporary' ? 'selected' : '' }}>Temporary
                                </option>
                                <option value="Permanent" {{ $item->type == 'Permanent' ? 'selected' : '' }}>Permanent
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <label class="form-label">Jumlah</label>
                            <input type="text" step="0.01" name="amount" class="form-control price"
                                placeholder="Masukan Jumlah" value="{{ $item->amount }}" required>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-control" required>
                                <option value="Done" {{ $item->status == 'Done' ? 'selected' : '' }}>Done</option>
                                <option value="On Going" {{ $item->status == 'On Going' ? 'selected' : '' }}>On Going
                                </option>
                            </select>
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
        <script src="{{ asset('js/post/post.js') }}"></script>
    </x-slot>
</x-layouts>
