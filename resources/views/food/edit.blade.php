@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Blank Page') }}</h1>

    <!-- Main Content goes here -->

    <div class="card">
        <div class="card-body">
            <form action="{{ route('food.update', $food->id) }}" method="post">
                @csrf
                @method('put')

                <div class="form-group">
                  <label for="nama">Nama</label>
                  <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" placeholder="Nama" autocomplete="off" value="{{ old('nama') ?? $food->nama }}">
                  @error('nama')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="harga">Harga</label>
                  <input type="text" class="form-control @error('harga') is-invalid @enderror" name="harga" id="harga" placeholder="Harga" autocomplete="off" value="{{ old('harga') ?? $food->harga }}">
                  @error('harga')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group form-group-lg mb-3">
                  <label for="kategori">Kategori</label>
                  <select class="custom-select" id="kategori" name="kategori" value="{{ old('kategori') ?? $food->kategori }}">
                    <option value="1" {{ $food->kategori == 1 ? 'selected' : ''}}>Makanan</option>
                    <option value="2" {{ $food->kategori == 2 ? 'selected' : ''}}>Minuman</option>
                    <option value="3" {{ $food->kategori == 3 ? 'selected' : ''}}>Lainnya</option>
                  </select>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('food.index') }}" class="btn btn-default">Kembali</a>

            </form>
        </div>
    </div>

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
