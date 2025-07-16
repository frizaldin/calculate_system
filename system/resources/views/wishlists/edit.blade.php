<x-layouts>
    <x-nav.navbar.breadcrumb />
    <form action="{{ $base_url . '/update' }}" method="POST" class="_form">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">{{ $title }}</h4>
            </div>
            <div class="card-body">
                <input type="hidden" name="id" value="{{ $item->id }}">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="" class="form-label">Kategori</label>
                            <select name="category_id" class="form-control" required>
                                <option value="">Pilih Kategori</option>
                                @foreach (\App\Models\Category::all() as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $item->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="" class="form-label">Nama Produk</label>
                            <input type="text" name="name" class="form-control" placeholder="Masukan Nama Produk"
                                value="{{ $item->name }}" required>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="" class="form-label">Harga</label>
                            <input type="text" name="price" class="form-control price" placeholder="Masukan Harga"
                                min="0" step="0.01" value="{{ $item->price }}" required>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="" class="form-label">Jumlah</label>
                            <input type="number" name="qty" class="form-control" placeholder="Masukan Jumlah"
                                min="1" value="{{ $item->qty }}" required>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <label for="" class="form-label">Foto Produk (URL)</label>
                            <input type="url" name="photo" class="form-control"
                                placeholder="Masukan URL Foto Produk" value="{{ $item->photo }}">
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <label for="" class="form-label">Link E-commerce</label>
                            <input type="url" name="link_ecommerce" class="form-control"
                                placeholder="Masukan Link E-commerce" value="{{ $item->link_ecommerce }}">
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
