<x-layouts>
    <x-nav.navbar.breadcrumb />
    <form action="{{ $base_url . '/update' }}" method="POST" class="_form">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">{{ $title ?? 'Edit Pemasukan' }}</h4>
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
                            <label class="form-label">Tanggal</label>
                            <input type="date" name="date" class="form-control" value="{{ $item->date }}"
                                required>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <label class="form-label">Jumlah</label>
                            <input type="text" name="amount" class="form-control price" placeholder="Masukan Jumlah"
                                value="{{ $item->amount }}" required>
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
