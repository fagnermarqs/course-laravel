<?php

namespace App\Http\Controllers;

use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;

class CarrinhoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        \Cart::update($id, array(
            'quantity' => array(
                'relative' => false,
                'value' => $request->qtd
            ),
          ));

        return redirect()->route('product.cart');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function cartList() {
        $itens = \Cart::getContent();

        return view('product.show-cart', compact('itens'));
    }

    public function addCart(Request $request) {
        $prodCart = \Cart::add([
            'id' => $request->id,
            'name' => $request->nome,
            'price' => $request->preco,
            'quantity' => $request->qtd,
            'attributes' => array(
                'img' => $request->image
            )
        ]);

        return redirect()->route('product.index');
    }

    public function delete(string $id) {
        $item = \Cart::get($id);
        $deleted = \Cart::remove($id);
        
        return redirect()->route('product.cart')->with(compact('item', 'deleted'));
    }

    public function clear() {
        \Cart::clear();

        return redirect()->route('product.cart');
    }
}
