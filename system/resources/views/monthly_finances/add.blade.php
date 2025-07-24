<x-layouts>
    <x-nav.navbar.breadcrumb />
    <form action="{{ $base_url . '/create' }}" method="POST" class="_form">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">{{ $title ?? 'Tambah Angsuran/Pengeluaran Bulanan' }}</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <label class="form-label">Judul</label>
                            <input type="text" name="title" class="form-control" placeholder="Masukan Judul"
                                required>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <label class="form-label">Angsuran (opsional)</label>
                            <input type="number" name="installments" class="form-control"
                                placeholder="Masukan Angsuran">
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <label class="form-label">Tanggal Tagihan</label>
                            <input type="date" name="billed_date" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <label class="form-label">Tipe</label>
                            <select name="type" class="form-control" required>
                                <option value="Temporary">Temporary</option>
                                <option value="Permanent">Permanent</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <label class="form-label">Jumlah</label>
                            <input type="text" step="0.01" name="amount" class="form-control price"
                                placeholder="Masukan Jumlah" required>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-control" required>
                                <option value="Done">Done</option>
                                <option value="On Going">On Going</option>
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
