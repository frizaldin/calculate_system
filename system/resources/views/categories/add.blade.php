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
                            <label for="" class="form-label">Tipe Kategori</label>
                            <select name="type" class="form-control">
                                <option value="">Pilih Tipe Kategori</option>
                                @foreach (type_radio_options() as $value => $label)
                                    <option value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <label for="" class="form-label">Judul Kategori</label>
                            <input type="text" name="name" class="form-control" id=""
                                placeholder="Masukan Nama Kategori">
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <label for="" class="form-label">Deskripsi Kategori</label>
                            <textarea name="description" class="form-control" rows="3" placeholder="Masukan Deskripsi Kategori"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <label class="form-label">Status</label>
                            <div>
                                @foreach (status_radio_options() as $value => $label)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status"
                                            id="status{{ $label }}" value="{{ $value }}"
                                            {{ $value == '1' ? 'checked' : '' }}>
                                        <label class="form-check-label"
                                            for="status{{ $label }}">{{ $label }}</label>
                                    </div>
                                @endforeach
                            </div>
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
