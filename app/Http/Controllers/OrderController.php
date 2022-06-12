<?php

namespace App\Http\Controllers;

use App\Food;
use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('search')) {
            return view('order.index', [
                'title' => 'Order',
                'foods' => Food::where('nama', 'LIKE', '%' . $request->search . '%')->orderBy('nama')->paginate(5),
                'orders' => Order::where('status', 0)->orderBy('nama')->paginate(5),
                'total' => Order::where('status', 0)->sum('subtotal')
            ]);
        } else if ($request->filter != '') {
            return view('order.index', [
                'title' => 'Order',
                'foods' => Food::where('kategori', $request->filter)->orderBy('nama')->paginate(5),
                'orders' => Order::where('status', 0)->orderBy('nama')->paginate(5),
                'total' => Order::where('status', 0)->sum('subtotal')
            ]);
        } else {
            return view('order.index', [
                'title' => 'Order',
                'foods' => Food::orderBy('nama')->paginate(5),
                'orders' => Order::where('status', 0)->orderBy('nama')->paginate(5),
                'total' => Order::where('status', 0)->sum('subtotal')
            ]);
        }
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
    public function store(Request $request)
    {
        Order::create([
            'kode' => 'TMP001',
            'nama' => $request->nama,
            'harga' => $request->harga,
            'qty' => $request->qty,
            'subtotal' => $request->harga * $request->qty,
            'status' => 0
        ]);

        return redirect()->route('order.index')->with('message', 'Makanan berhasil ditambahkan kedalam sistem');
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
    public function update(Request $request, $id)
    {
        //
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
