@extends('layouts.admin')

@section('main-content')
@push('head')
<script src="{{ asset('js/time.js') }}"></script>
@endpush
    <!-- Main Content goes here -->

    <div class="row">
        <div class="card text-center mr-4" style="width: 55%">
            <div class="card-header">
              <b>DAFTAR MENU</b>
            </div>
            {{-- <form action="/order" method="GET">
              <input class="form-control ml-4 mt-2" type="search" name="search" placeholder="Cari nama" style="width: 20%">
            </form> --}}

            <div class="form-group form-group-lg mb-2 text-left ml-4 mt-3">
              <select class="custom-select filter" id="filter" name="filter" style="width: 25%">
                <option value="">Pilih Kategori</option>
                <option value="1">Makanan</option>
                <option value="2">Minuman</option>
                <option value="3">Lainnya</option>
              </select>
            </div>
            <div class="mr-4 ml-4 mt-2">
            <table class="table table-bordered table-stripped">
              <thead>
                  <tr>
                      <th>No</th>
                      <th>Menu</th>
                      <th>Harga</th>
                      <th>Kategori</th>
                      <th>#</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($foods as $food)
                      <tr>
                          <td scope="row">{{ $loop->iteration }}</td>
                          <td class="text-left">{{ $food->nama }}</td>
                          <td>@currency($food->harga)</td>
                          @if ($food->kategori == 1)
                              <td>Makanan</td>
                          @elseif ($food->kategori == 2)
                              <td>Minuman</td>
                          @else
                              <td>Lainnya</td>
                          @endif
                          <td>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-foodname="{{ $food->nama }}" data-harga="{{ $food->harga }}" data-target="#tambahModal">
                              Tambah
                            </button>
                              </div>
                          </td>
                      </tr>
                  @endforeach
              </tbody>
          </table> 
          {{ $foods->links() }}
          </div>
          </div>
          <div class="card text-center" style="width: 40%">
            <div class="card-header">
              INVOICE
            </div>
            <div class="card-body">
              <h5 class="card-title">RM SINAR FAMILY 7</h5>

            <div class="row mt-4">
              <div class="col-sm text-left ml-4">
                <ul class="pl-0 small" style="list-style: none;text-transform: uppercase;">
                    <li>NOTA : {{ $orders[0]->kode }}</li>
                    <li>KASIR : <b>{{ Auth::user()->name }} {{ Auth::user()->last_name }}</b></li>
                </ul>
              </div>
              <hr>
              <div class="col-sm text-right mr-4">
                <ul class="pl-0 small" style="list-style: none;text-transform: uppercase;">
                    <li> <?php echo  date("j-m-Y"); ?></li>
                    <li id="clock"></li>
                </ul>
              </div>
            </div>
            <div class="card-body pt-0">
              <hr class="mt-0">
                <div class="row">
                  <div class="col text-left">
                      <span><b>Nama Barang</b></span>
                  </div>
                  <div class="col-1 px-0 text-center">
                      <span><b>Qty</b></span>
                  </div>
                  <div class="col-3 px-0 text-center">
                      <span><b>Harga</b></span>
                  </div>
                  <div class="col-3 pl-0 text-right">
                      <span><b>Subtotal</b></span>
                  </div>
                  <div class="col-12">
                      <hr class="mt-2">
                  </div>
                </div>

                @foreach ($orders as $order)

                  <div class="row mb-2">
                    <div class="col text-left">

                      <form action="{{ route('order.destroy', $order->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="fa fa-times fa-md text-danger mr-2" onclick="return confirm('Kamu yakin ingin menghapus {{ $order->nama }}?')" style="text-decoration:none;"></button>
                        <span  class="text-dark">{{ $order->nama }}</span>
                    </form>
                    </div>
                    <div class="col-1 px-0 text-center">
                      <span>{{ $order->qty }}</span>
                    </div>
                    <div class="col-3 px-0 text-center">
                      <span>@currency($order->harga)</span>
                    </div>
                    <div class="col-3 pl-0 text-right">
                      <span>@currency($order->subtotal)</span>
                    </div>
                  </div>
                @endforeach
                {{ $orders->links() }}
            <hr>
            <ul class="list-group border-0">
                <li class="list-group-item p-0 border-0 d-flex justify-content-between align-items-center">
                    <b>Total</b>
                    <span><b>@currency($total)</b></span>
                </li>
                <li class="list-group-item p-0 border-0 d-flex justify-content-between align-items-center">
                    <b>Bayar</b>
                    <span><b></b></span>
                </li>
                <li class="list-group-item p-0 border-0 d-flex justify-content-between align-items-center">
                    <b>Kembalian</b>
                    <span><b></b></span>
                </li>
            </ul>
          </div>
    </div>
    </div>
  </div>

    <form action="{{ route('order.store') }}" method="post">
      @csrf
    <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="tambahModalLabel">Detail Pesanan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="nama">Menu</label>
              <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" readonly>
              @error('nama')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="form-group">
              <label for="harga">Harga</label>
              <input type="text" class="form-control @error('harga') is-invalid @enderror" name="harga" id="harga"readonly>
              @error('harga')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="form-group">
              <label for="qty">Qty</label>
              <input type="number" class="form-control @error('qty') is-invalid @enderror" name="qty" id="qty" value="1" min="1">
              @error('qty')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            {{-- <div class="form-group">
              <label for="subtotal">Subtotal</label>
              <input type="text" class="form-control @error('subtotal') is-invalid @enderror" name="subtotal" id="subtotal" readonly>
              @error('subtotal')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div> --}}
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Tambah</button>
          </div>
        </div>
      </div>
    </div>
    </form>
    @section('js')
    <script type="text/javascript">
      function showTime() {
          var a_p = "";
          var today = new Date();
          var curr_hour = today.getHours();
          var curr_minute = today.getMinutes();
          var curr_second = today.getSeconds();
          if (curr_hour < 12) {
              a_p = "AM";
          } else {
              a_p = "PM";
          }
          if (curr_hour == 0) {
              curr_hour = 12;
          }
          if (curr_hour > 12) {
              curr_hour = curr_hour - 12;
          }
          curr_hour = checkTime(curr_hour);
          curr_minute = checkTime(curr_minute);
          curr_second = checkTime(curr_second);
       document.getElementById('clock').innerHTML=curr_hour + ":" + curr_minute + ":" + curr_second + " " + a_p;
          }
  
      function checkTime(i) {
          if (i < 10) {
              i = "0" + i;
          }
          return i;
      }
      setInterval(showTime, 500);

      </script>
      @stop

    <!-- End of Main Content -->
@endsection
