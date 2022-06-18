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

            DB::update('update orders set kode = ?, status = ? where kode = ?', [$finalKode, 1, 'TMPTRX']);

            return redirect()->route('order.index')->with('message', 'Kembalian  : Rp.' . number_format($kembalian, 0, ',', '.'));
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
