@extends('site.layout')

@section('title', 'Home Page')

@section('conteudo')
    @foreach ($produtos as $produto)
    <div class="row container">
      <div class="col s12 m4">
        <div class="card">
          <div class="card-image">
            <img src="{{ $produto->image }}">
            <span class="card-title">{{ $produto->nome }}</span>
          </div>
          <div class="card-content">
            {{-- <p>{{ Str::limit($produto->descricao, 20, '...') }}</p> --}}
            <p>{{ $produto->descricao }}</p>
          </div>
          <div class="card-action">
            <a href="{{ route('product.show', $produto->slug) }}">Details</a>
          </div>
        </div>
      </div>
    </div>
    @endforeach
    <div class="row center">
      {{ $produtos->links('custom.pagination') }}
    </div>
@endsection