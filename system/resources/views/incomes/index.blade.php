<x-layouts>
    <x-nav.navbar.breadcrumb />
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="card-title">{{ $title ?? 'Pemasukan' }}</h4>
                        <a href="{{ $base_url . '/add' }}" class="btn btn-outline-primary">Tambah</a>
                    </div>
                </div>
                <div class="card-body" id="loader-content-table" style="display: none;">
                    <div class="table-responsive">
                        <table class="table mb-0 table-centered">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center" style="width: 100px">Aksi</th>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Judul</th>
                                    <th class="text-center">Tanggal</th>
                                    <th class="text-center">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($collection as $item)
                                    <tr id="data-{{ $item->id }}">
                                        <td>
                                            <a href="{{ $base_url . '/edit/' . $item->id }}"
                                                class="btn btn-primary mb-1 "><i class="fa-solid fa-pencil"></i></a>
                                            <form action="{{ $base_url . '/delete' }}" style="display:inline-block"
                                                class="deleteForm-{{ $item->id }}">
                                                @csrf
                                                <button type="button"
                                                    onclick="return confirmation('{{ $item->id }}')"
                                                    class="btn btn-danger "><i class="fa-solid fa-trash"></i></button>
                                            </form>
                                        </td>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->date }}</td>
                                        <td>{{ number_format($item->amount) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $collection->links('pagination::bootstrap-5') }}
                </div>
                <div class="card-footer d-flex justify-content-center align-items-center" style="min-height: 50vh"
                    id="loader-content">
                    <l-hatch size="50" stroke="4" speed="3.5" color="white"
                        style="position: relative; margin-right: 10px;"></l-hatch>
                </div>
            </div>
        </div>
    </div>
    <x-slot name="js">
        <script src="{{ asset('js/status-helper.js') }}"></script>
        <script src="{{ asset('js/delete/delete.js') }}"></script>
    </x-slot>
</x-layouts>
