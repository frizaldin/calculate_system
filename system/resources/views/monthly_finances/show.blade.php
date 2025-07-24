@extends('components.layouts')

@section('content')
    <div class="container mt-4">
        <h2>Detail Angsuran/Pengeluaran Bulanan</h2>
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <td>{{ $finance->id }}</td>
            </tr>
            <tr>
                <th>Judul</th>
                <td>{{ $finance->title }}</td>
            </tr>
            <tr>
                <th>Angsuran</th>
                <td>{{ $finance->installments }}</td>
            </tr>
            <tr>
                <th>Tanggal Tagihan</th>
                <td>{{ $finance->billed_date }}</td>
            </tr>
            <tr>
                <th>Tipe</th>
                <td>{{ $finance->type }}</td>
            </tr>
            <tr>
                <th>Jumlah</th>
                <td>{{ number_format($finance->amount, 2) }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>{{ $finance->status }}</td>
            </tr>
        </table>
        <a href="{{ route('monthly_finances.index') }}" class="btn btn-secondary">Kembali</a>
        <a href="{{ route('monthly_finances.edit', $finance->id) }}" class="btn btn-warning">Edit</a>
    </div>
@endsection
