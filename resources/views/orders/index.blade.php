@extends('Layouts.app')
@section('content')
<div class="container">
@include('helpers.flash-messages')
<div class="row">
  <div class="col-6">
    <h1>{{ __('Zamówienia') }} <i class="fa-solid fa-list"></i></h1>
  </div>
</div>
<div class="row">
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Ilość</th>
      <th scope="col">Cena</th>
      <th scope="col">Produkty</th>

    </tr>
  </thead>
  <tbody>
    @foreach($orders as $order)
         <tr>
            <th scope="row">{{  $order-> id  }}</th>
            <th scope="row">{{  $order-> quantity  }}</th>
            <th scope="row">{{  $order-> price  }}</th>
            <th scope="row">
            @foreach($order->products as $product)
            
                <ul>
                    <li>
                        {{ $product->name }} - {{ $product->description }}
                    </li>
                </ul>

            @endforeach
            </th>
         </tr>
    @endforeach
  </tbody>
</table>
  </div>
</div>
@endsection