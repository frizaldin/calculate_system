<x-layouts>
    <x-nav.navbar.breadcrumb />
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12">
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
                                    <th class="text-center">Photo</th>
                                    <th class="text-center">Nama Project</th>
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
                                        </td>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
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
                                        <td>
                                            {{ $item->name }}
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
