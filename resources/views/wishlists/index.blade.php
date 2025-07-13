<x-layouts>
    <x-nav.navbar.breadcrumb />
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        @foreach (\App\Models\Category::all() as $category)
                            <div class="{{ request()->category_id == $category->id ? 'col-md-12' : 'col-md-3' }} {{ request()->category_id && request()->category_id != $category->id ? 'd-none' : '' }}"
                                onclick="window.location.href='{{ $base_url . '/?category_id=' . $category->id }}'"
                                style="cursor: pointer;">
                                <div class="card my-1">
                                    <div class="card-header"><small>{{ $category->name }}</small></div>
                                    <div class="card-body">
                                        <span>{{ $category->wishlists->count() }} Item</span><br>
                                        <hr class="my-2">
                                        <span>Rp. {{ number_format($category->wishlists->sum('total_price')) }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @if (request()->category_id)
                    <div class="card-footer">
                        <a href="{{ $base_url }}" class="btn btn-primary w-100">Clear Filter</a>
                    </div>
                @endif
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="card-title">{{ $title }}</h4>
                        <a href="{{ $base_url . '/add' }}" class="btn btn-outline-primary">Tambah</a>
                    </div> <!--end row-->
                </div><!--end card-header-->
                <div class="card-body" id="loader-content-table" style="display: none;">
                    <div class="table-responsive">
                        <table class="table  mb-0 table-centered">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center" style="width: 100px">Aksi</th>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Foto</th>
                                    <th class="text-center">Nama Produk</th>
                                    <th class="text-center">Kategori</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Harga</th>
                                    <th class="text-center">Jumlah</th>
                                    <th class="text-center">Total Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <input type="text" class="form-control form-filter" name="name"
                                            placeholder="Ketikan Sesuatu" value="{{ request()->name }}">
                                    </td>
                                    <td>
                                        <select class="form-control form-filter" name="category_id">
                                            <option value="">All</option>
                                            @foreach (\App\Models\Category::all() as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ request()->category_id && request()->category_id == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control form-filter" name="status">
                                            <option value="">All</option>
                                            <option value="wishlist">Wishlist</option>
                                            <option value="purchased">Purchased</option>
                                        </select>
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                @foreach ($collection as $item)
                                    <tr id="data-{{ $item->id }}">
                                        <td>
                                            <a href="{{ $base_url . '/edit/' . $item->id }}"
                                                class="btn btn-primary mb-1 ">
                                                <i class="fa-solid fa-pencil"></i>
                                            </a>
                                            <form action="{{ $base_url . '/delete' }}" style="display:inline-block"
                                                class="deleteForm-{{ $item->id }}">
                                                @csrf
                                                <button type="button"
                                                    onclick="return confirmation('{{ $item->id }}')"
                                                    class="btn btn-danger ">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                            @if ($item->link_ecommerce)
                                                <a href="{{ $item->link_ecommerce }}" class="btn btn-primary mt-1 "
                                                    title="Link Ecommerce">
                                                    <i class="fa-solid fa-link"></i>
                                                </a>
                                            @endif
                                        </td>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="text-center">
                                            @if ($item->photo)
                                                <img src="{{ $item->photo }}" alt="{{ $item->name }}"
                                                    style="width: 50px; height: 50px; object-fit: cover;"
                                                    class="rounded">
                                            @else
                                                <div
                                                    style="width: 50px; height: 50px; background: #f8f9fa; 
                                                           display: flex; align-items: center; justify-content: center; 
                                                           border-radius: 5px;">
                                                    <i class="fa-solid fa-image text-muted"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->category->name ?? '-' }}</td>
                                        <td>{!! badgeStatusWishlist($item->status) !!}</td>
                                        <td class="text-end">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                        <td class="text-center">{{ $item->qty }}</td>
                                        <td class="text-end">Rp {{ number_format($item->total_price, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table><!--end /table-->
                    </div><!--end /tableresponsive-->
                    {{ $collection->links('pagination::bootstrap-5') }}
                </div><!--end card-body-->
                <div class="card-footer d-flex justify-content-center align-items-center" style="min-height: 50vh"
                    id="loader-content">
                    <l-hatch size="50" stroke="4" speed="3.5" color="white"
                        style="position: relative; margin-right: 10px;">
                    </l-hatch>
                </div>
            </div><!--end card-->
        </div> <!--end col-->
    </div>
    <x-slot name="js">
        <script src="{{ asset('js/status-helper.js') }}"></script>
        <script src="{{ asset('js/delete/delete.js') }}"></script>
    </x-slot>
</x-layouts>
