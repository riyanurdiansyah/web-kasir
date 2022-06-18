@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Blank Page') }}</h1>

    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <table class="table table-bordered table-stripped">
        <thead>
            <tr>
                <th>No</th>
                <th>Invoice</th>
                <th class="text-center">Menu</th>
                <th class="text-center">Harga</th>
                <th class="text-center">Qty</th>
                <th class="text-right">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td scope="row">{{ $loop->iteration }}</td>
                    <td>{{ $order->kode }}</td>
                    <td class="text-center">{{ $order->nama }}</td>
                    <td class="text-center">@currency($order->harga)</td>
                    <td class="text-center">{{ $order->qty }}</td>
                    <td class="text-right" id="subtotal">@currency($order->subtotal)</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="5"><h5><b>TOTAL</b></h5></td>
                <td class="text-right"><h5><b>@currency($total)</b></h5></td>
            </tr>
        </tbody>
    </table>

    <a href="{{ route('transactions.index') }}" class="btn btn-default">Kembali</a>
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
