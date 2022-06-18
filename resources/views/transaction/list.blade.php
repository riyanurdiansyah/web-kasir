@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Blank Page') }}</h1>

    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <table class="table table-bordered table-stripped" id="tbfood">
        <thead>
            <tr>
                <th>No</th>
                <th>Invoice</th>
                <th>Total</th>
                <th>Bayar</th>
                <th>Kembalian</th>
                <th>Tanggal</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $trans)
                <tr>
                    <td scope="row">{{ $loop->iteration }}</td>
                    <td>{{ $trans->kode }}</td>
                    <td>@currency($trans->total)</td>
                    <td>@currency($trans->bayar)</td>
                    <td>@currency($trans->kembalian)</td>
                    <td>{{ $trans->created_at }}</td>
                    <td class="text-center">
                        <a href="{{ route('transactions.edit', $trans->kode) }}" class="btn btn-sm btn-primary">Detail</a>
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
