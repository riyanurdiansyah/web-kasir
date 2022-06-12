<?php

namespace App\Http\Controllers;

use App\Food;
use App\Http\Requests\AddFoodRequest;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('food.list', [
            'title' => 'Kelola Makanan',
            'foods' => Food::paginate(5)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('food.create', [
            'title' => 'New Food',
            'foods' => Food::paginate(5)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Food::create([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'kategori' => $request->kategori
        ]);

        return redirect()->route('food.index')->with('message', 'Makanan berhasil ditambahkan kedalam sistem');
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
    public function edit(Food $food)
    {
        return view('food.edit', [
            'title' => 'Edit User',
            'food' => $food
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AddFoodRequest $request, Food $food)
    {
        $food->nama = $request->nama;
        $food->harga = $request->harga;
        $food->kategori = $request->kategori;
        $food->save();

        return redirect()->route('food.index')->with('message', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Food $food)
    {
        $food->delete();

        return redirect()->route('food.index')->with('message', 'Data berhasil dihapus');
    }
}
