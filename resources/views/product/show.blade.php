@extends('site.layout')
@php
    $prod = session('produto')    
@endphp

@section('title', $prod->nome)
@section('conteudo')
    <div class="row container">
        <div class="col s1 m4">
            <img src="{{ $prod->image }}" alt="" class="responsive-img"> 
        </div>
    </div>

    <div class="col s1 m4">
        <h1>{{ $prod->nome }}</h1>
        <p> {{ $prod->descricao }} </p>
        <p> Postado por: {{ $prod->user->name }} </p>
        <p> Categoria: {{ $prod->categoria->descricao }} </p>
        <p>Preço: R$ {{ number_format($prod->preco, 2, ',', '.') }}</p>
        <form action="{{ route('product.add-cart') }}" method="POST">
            @csrf
            <button class="btn orange btn-large">Comprar</button>
            <input type="hidden" name="id" value="{{ $prod->id}}">
            <input type="hidden" name="nome" value="{{ $prod->nome}}">
            <input type="hidden" name="preco" value="{{ $prod->preco}}">
            <input type="hidden" name="image" value="{{ $prod->image}}">
            <input type="number" name="qtd">
        </form>
    </div>
@endsection