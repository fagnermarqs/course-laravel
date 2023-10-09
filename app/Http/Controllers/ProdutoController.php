<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
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
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $novoProduto = new Produto();
        $novoProduto->fill($request->all());

        dd($novoProduto);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $produto = Produto::where('slug', $slug)->get()->first();
        session(['produto' => $produto]);
        return view('product.show', compact('slug'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function productsByCategory(string $category) {
        $produtos = Produto::whereHas('categoria', function ($query) use ($category) {
            $query->where('descricao', '=', $category);
        })->paginate(2);

        return view('product.list-by-category', compact('produtos', 'category'));
    }
}
