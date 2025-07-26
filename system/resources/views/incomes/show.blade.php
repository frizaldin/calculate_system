@extends('components.layouts')

@section('content')
    <div class="container mt-4">
        <h2>Detail Pemasukan</h2>
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <td>{{ $item->id }}</td>
            </tr>
            <tr>
                <th>Judul</th>
                <td>{{ $item->title }}</td>
            </tr>
            <tr>
                <th>Tanggal</th>
                <td>{{ $item->date }}</td>
            </tr>
            <tr>
                <th>Jumlah</th>
                <td>{{ number_format($item->amount, 2) }}</td>
            </tr>
        </table>
        <a href="{{ $base_url }}" class="btn btn-secondary">Kembali</a>
        <a href="{{ $base_url . '/edit/' . $item->id }}" class="btn btn-warning">Edit</a>
    </div>
@endsection
