<?php

namespace App\Http\Controllers;

use App\Food;
use App\Http\Requests\AddOrderRequest;
use App\Order;
use App\Transaction;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('order.index', [
            'title' => 'Order',
            'foods' => Food::orderBy('nama')->get(),
            'orders' => Order::where('status', 0)->orderBy('nama')->get(),
            'total' => Order::where('status', 0)->sum('subtotal')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Order $order)
    {
        if ($request->flag == 0) {
            Order::create([
                'kode' => 'TMPTRX',
                'nama' => $request->nama,
                'harga' => $request->harga,
                'qty' => $request->qty,
                'subtotal' => $request->harga * $request->qty,
                'bayar' => 0,
                'kembalian' => 0,
                'status' => 0
            ]);

            return redirect()->route('order.index');
        } else {
            $query = DB::table('transactions')->select(DB::raw('MAX(RIGHT(id,4)) as kode'));
            $kode = "";
            if ($query->count() > 0) {
                foreach ($query->get() as $q) {
                    $tmp = ((int)$q->kode) + 1;
                    $kode = sprintf("%04s", $tmp);
                }
            } else {
                $kode = "0001";
            }

            Transaction::create([
                'kode' => 'TRX-' . $kode,
                'total' => $request->totalharga,
                'bayar' => $request->bayar,
                'kembalian' => $request->bayar - $request->totalharga,
                'status' => 0
            ]);

            $finalKode = 'TRX-' . $kode;
            $kembalian = $request->bayar - $request->totalharga;
            $kembalianTemp = $request->bayar - $request->totalharga;

            $cepean = 0;
            $gocapan = 0;
            $duapuluan = 0;
            $cebanan = 0;
            $gocengan = 0;
            $duaribuan = 0;
            $seribuan = 0;
            $gopean = 0;
            $duaratusan = 0;
            $seratusan = 0;

            for ($i = 0; $kembalianTemp > 0; $i++) {

                if ($kembalianTemp > 100000) {
                    $cepean = $cepean + 1;
                    $kembalianTemp = $kembalianTemp - 100000;
                } else if ($kembalianTemp >= 50000) {
                    $gocapan = $gocapan + 1;
                    $kembalianTemp = $kembalianTemp - 50000;
                } else if ($kembalianTemp >= 20000) {
                    $duapuluan = $duapuluan + 1;
                    $kembalianTemp = $kembalianTemp - 20000;
                } else if ($kembalianTemp >= 10000) {
                    $cebanan = $cebanan + 1;
                    $kembalianTemp = $kembalianTemp - 10000;
                } else if ($kembalianTemp >= 5000) {
                    $gocengan = $gocengan + 1;
                    $kembalianTemp = $kembalianTemp - 5000;
                } else if ($kembalianTemp >= 2000) {
                    $duaribuan = $duaribuan + 1;
                    $kembalianTemp = $kembalianTemp - 2000;
                } else if ($kembalianTemp >= 1000) {
                    $seribuan = $seribuan + 1;
                    $kembalianTemp = $kembalianTemp - 1000;
                } else if ($kembalianTemp >= 500) {
                    $gopean = $gopean + 1;
                    $kembalianTemp = $kembalianTemp - 500;
                } else if ($kembalianTemp >= 200) {
                    $duaratusan = $duaratusan + 1;
                    $kembalianTemp = $kembalianTemp - 200;
                } else if ($kembalianTemp >= 100) {
                    $seratusan = $seratusan + 1;
                    $kembalianTemp = $kembalianTemp - 100;
                }
            }

            DB::update('update orders set kode = ?, status = ? where kode = ?', [$finalKode, 1, 'TMPTRX']);

            return redirect()->route('order.index')->with('message', 'Kembalian  : Rp.' . number_format($kembalian, 0, ',', '.') . '         | RINCIAN ===> ' . $cepean . ' Lembar Rp100.000  ||  ' . $gocapan . ' Lembar Rp50.000  ||  ' . $duapuluan . ' Lembar Rp20.000  ||  ' . $cebanan . ' Lembar Rp10.000  ||  ' . $gocengan . ' Lembar Rp5.000  ||  ' . $duaribuan . ' Lembar Rp2.000  ||  ' . $seribuan . ' Lembar Rp1.000  ||  ' . $gopean . ' Koin Rp500  ||  ' . $seratusan . ' Koin Rp100');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function bayar(Request $request)
    {
        Transaction::create([
            'kode' => IdGenerator::generate(['table' => 'customers', 'length' => 10, 'prefix' => 'TRX-']),
            'bayar' => $request->bayar,
            'kembalian' =>  $request->bayar -  $request->totalharga
        ]);

        return redirect()->route('order.index')->with('message', 'Transaksi berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AddOrderRequest $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('order.index')->with('message', 'Data berhasil dihapus');
    }
}
