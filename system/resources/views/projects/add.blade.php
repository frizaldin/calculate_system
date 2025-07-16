<x-layouts>
    <x-nav.navbar.breadcrumb />
    <form action="{{ $base_url . '/create' }}" method="POST" class="_form">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">{{ $title }}</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <label for="" class="form-label">Nama Project</label>
                            <input type="text" name="name" class="form-control" id=""
                                placeholder="Masukan Nama Kategori">
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <label for="" class="form-label">Foto Produk </label>
                            <input type="file" name="photo" class="form-control"
                                placeholder="Masukan URL Foto Produk">
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
