@extends('Layouts.app')
@section('content')
<div class="container">
@include('helpers.flash-messages')
<div class="row">
  <div class="col-6">
    <h1>{{ __('shop.product.index_title') }} <i class="fa-solid fa-list"></i></h1>
  </div>
  <div class="col-6">
    <a class="float-right" href="{{ route('products.create') }}">
    <button type="button" class="btn btn-primary">{{ __('shop.button.add') }}</button>
    </a>
  </div>

</div>
<div class="row">
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">{{__('shop.product.fields.name')}}</th>
      <th scope="col">{{__('shop.product.fields.description')}}</th>
      <th scope="col">{{__('shop.product.fields.amount')}}</th>
      <th scope="col">{{__('shop.product.fields.price')}}</th>
      <th scope="col">{{__('shop.product.fields.category')}}</th>
      <th scope="col">Akcje</th>
    </tr>
  </thead>
  <tbody>
    @foreach($products as $product)
         <tr>
            <th scope="row">{{  $product -> id  }}</th>
            <td>{{  $product -> name  }}</td>
            <td>{{  $product -> description  }}</td>
            <td>{{  $product -> amount  }}</td>
            <td>{{  $product -> price  }}</td> 
            <td>@if(isset($product ->category)){{  $product ->category->name }} @endif</td>
            <td>
            <a href="{{route('products.show', $product->id)}}">
              <button class="btn btn-success btn-sm "><i class="fa-solid fa-image"></i></button>
              </a>
              <a href="{{route('products.edit', $product->id)}}">
              <button class="btn btn-primary btn-sm "><i class="fa-solid fa-file-pen"></i></button>
              </a>
            <button class="btn btn-danger btn-sm delete" data-id="{{ $product -> id }}"><i class="fa-solid fa-trash"></i></button>
            </td>
         </tr>
    @endforeach
  </tbody>
</table>
{{ $products->links() }}
  </div>
</div>
@endsection
@section('scripts')
  const deleteUrl = "{{ url('products') }}/";
  const confirmDelete= "{{ __('shop.messages.delete_confirm') }}";
@endsection
@section('js-files')
@vite (['resources\js\delete.js'])
@endsection