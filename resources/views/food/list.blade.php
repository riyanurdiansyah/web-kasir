@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Blank Page') }}</h1>

    <!-- Main Content goes here -->

    <a href="{{ route('food.create') }}" class="btn btn-primary mb-3">Tambah Menu</a>

    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <table class="table table-bordered table-stripped" id="tbfood">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Kategori</th>
                <th>#</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($foods as $food)
                <tr>
                    <td scope="row">{{ $loop->iteration }}</td>
                    <td>{{ $food->nama }}</td>
                    <td>{{ $food->harga }}</td>
                    @if ($food->kategori == 1)
                        <td>Makanan</td>
                    @elseif ($food->kategori == 2)
                        <td>Minuman</td>
                    @else
                        <td>Lainnya</td>
                    @endif
                    <td>
                        <div class="d-flex">
                            <a href="{{ route('food.edit', $food->id) }}" class="btn btn-sm btn-primary mr-2">Ubah</a>
                            <form action="{{ route('food.destroy', $food->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Kamu yakin ingin menghapus?')">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- End of Main Content -->
@endsection

@push('notif')
    @if (session('success'))
        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success border-left-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
@endpush
