@extends('site.layout') 
@section('title', 'Cart') 
    
@section('conteudo')
@if (count($itens) > 0)
    
  <table class="striped">
      <thead>
        <tr>
            <th></th>
            <th>Name</th>
            <th>Item Price</th>
            <th>Quantity</th>
            <th></th>
            <th></th>
        </tr>
      </thead>

      <tbody>
          @foreach($itens as $item)
              <tr>
                  <td><img src="{{ $item->attributes->img}}" alt="{{ $item->attributes->img }}" width="70" class="responsive-img circle"></td>
                  <td class="text-center">{{ $item->name }}</td>
                  <td class="text-center">R$ {{ number_format($item->price, 2, ',', '.')}}</td>
                  <td class="text-center">{{ $item->quantity }}</td>
                  <td><button data-target="itemUpdate{{ $item->id }}" class="btn-floating waves-effect waves-light orange modal-trigger"><i class="material-icons">refresh</i></button></td>
                  <td><button data-target="item{{ $item->id }}" class="btn-floating waves-effect waves-light red modal-trigger"><i class="material-icons">delete</i></button></td>
                  {{-- <a class="btn-floating waves-effect waves-light red btn modal-trigger" href="#modal1"><i class="material-icons">delete</i></a> --}}
            </tr>
            
            <!-- Modal Structure -->
            <div id="item{{ $item->id }}" class="modal">
              <div class="modal-content">
                <h4>Excluir item</h4>
                <p>Tem certeza que deseja excluir este item?</p>
              </div>
              <div class="modal-footer">
                <form name="formDelete" action="{{ route('product.delete-cart', ['id' => $item->id]) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <!-- <a href="javascript:formDelete.submit()" class="modal-close waves-effect waves-green btn-flat green">Sim</a> -->
                  <button type="submit" class="modal-close waves-effect waves-green btn-flat green">Sim</button>
                </form>
                <a href="" class="modal-close waves-effect waves-green btn-flat red">Não</a>
              </div>
            </div>

            <div id="itemUpdate{{ $item->id }}" class="modal">
              <div class="modal-content">
                <h4>Item {{ $item->name }}</h4>

                <div class="form-group">
                  <label for="nome">Nome:</label>
                  <input type="text" class="form-control" name="nome" value="{{ $item->name }}" readonly>
                </div>

                <div class="form-group">
                  <label for="nome">Preço:</label>
                  <input type="text" class="form-control" name="preco" value="R$ {{ number_format($item->price, 2, ',', '.') }}" readonly>
                </div>
  
                <div class="form-group">
                  <label for="preco">Quantidade:</label>
                  <input type="number" class="form-control" id="qtdeItem{{ $item->id }}" name="qtd" value="{{ $item->quantity }}" required onchange="updateQuantity({{$item->id}}, this.value)">
                </div>

              </div>
              <div class="modal-footer">
                <form id="formUpdate" action="{{ route('product.update-cart', ['id' => $item->id]) }}" method="POST">
                  @csrf
                  @method('PUT')
                  <input type="hidden" name="qtd" id="novaQtdeItem{{ $item->id }}">
                  <button type="submit" class="modal-close waves-effect waves-green btn-flat green">Sim</button>
                </form>
                <a href="" class="modal-close waves-effect waves-green btn-flat red">Não</a>
              </div>
            </div>
          @endforeach
      </tbody>

      <div class="row container center">
        <button class="btn-large waves-effect waves-light blue">Continuar Comprando<i class="material-icons right">arrow_back</i></button>
        <button data-target="clearCart" class="btn-large waves-effect waves-light blue modal-trigger">Limpar Carrinho<i class="material-icons right">clear</i></button>
        <button class="btn-large waves-effect waves-light green">Finalizar Pedido<i class="material-icons right">check</i></button>
      </div>

      <!-- Modal Structure -->
      <div id="clearCart" class="modal">
        <div class="modal-content">
          <h4>Limpar Carrinho</h4>
          <p>Tem certeza que deseja limpar o carrinho?</p>
        </div>
        
        <div class="modal-footer">
          <form action="{{ route('product.clear-cart') }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="modal-close waves-effect waves-green btn-flat green">Sim</button>
          </form>
          <a href="" class="modal-close waves-effect waves-green btn-flat red">Não</a>
        </div>
      </div>

    </table>

    <script>
      function updateQuantity(idItem, value) {
        let id = `novaQtdeItem`
        // let elem = document.getElementById(id);
        // elem.value = value;

        console.log(id);
      }

      document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.modal');
        console.log(elems);
        var instances = M.Modal.init(elems);
      });
    </script>
@else
    <div class="row container center">
      <h3>Carrinho Vazio</h3>
    </div>
@endif
@endsection 