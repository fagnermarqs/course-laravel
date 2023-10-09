@extends('site.layout')
@section('title', 'Cart')
    
@section('conteudo')



<table>
    <thead>
      <tr>
          <th>Name</th>
          <th>Item Price</th>
          <th>Quantity</th>
      </tr>
    </thead>

    <tbody>
        @foreach($itens as $item)
            <tr>
                <td class="text-center">{{ $item->name }}</td>
                <td class="text-center">R$ {{ number_format($item->price, 2, ',', '.')}}</td>
                <td class="text-center">{{ $item->quantity }}</td>
          </tr>
        @endforeach
    </tbody>
  </table>
        


@endsection