@extends('Layouts.app')

@section('content')
<div class="container">
@include('helpers.flash-messages')
<div class="cart_section">
     <div class="container-fluid">
         <div class="row">
             <div class="col-lg-10 offset-lg-1">
                 <div class="cart_container">
                     <div class="cart_title">Koszyk {{ $cart->getItems()->count() }}</div>
                     <form action="{{ route('orders.store')}}" method="POST" id="order-form">
                        @csrf
                     <div class="cart_items">
                         <ul class="cart_list">
                            @foreach( $cart->getItems() as $item)
                             <li class="cart_item clearfix">
                                 <div class="cart_item_image"><img src="{{ asset($item->getImage()) }}" alt="Zdjęcie produktu"></div>
                                 <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
                                     <div class="cart_item_name cart_info_col">
                                         <div class="cart_item_title">Name</div>
                                         <div class="cart_item_text">{{$item->getName()}}</div>
                                     </div>
                                     <div class="cart_item_quantity cart_info_col">
                                         <div class="cart_item_title">Quantity</div>
                                         <div class="cart_item_text">{{$item->getQuantity()}}</div>
                                     </div>
                                     <div class="cart_item_price cart_info_col">
                                         <div class="cart_item_title">Price</div>
                                         <div class="cart_item_text">{{$item->getPrice()}} zł</div>
                                     </div>
                                     <div class="cart_item_total cart_info_col">
                                         <div class="cart_item_title">Total</div>
                                         <div class="cart_item_text">{{$item->getSum()}} zł</div>
                                     </div>
                                     <div class=" cart_info_col">
                                     <button type="button" class="btn btn-danger btn-sm delete" data-id="{{ $item -> getProductId() }}">
                                        <i class="fa-solid fa-trash"></i>
                                     </button>
                                     </div>
                                 </div>
                             </li>
                             @endforeach
                         </ul>
                     </div>
                     <div class="order_total">
                         <div class="order_total_content text-md-right">
                             <div class="order_total_title">Order Total:</div>
                             <div class="order_total_amount">{{$cart->getSum()}} zł</div>
                         </div>
                     </div>
                     <div class="cart_buttons"> 
                        <a href="/" type="button" class="button cart_button_clear">Wróć do sklepu</a>
                        <button type="submit" class="button cart_button_checkout" {{ !$cart->hasItems() ? 'disabled' : ''}}>Zaplać</button>
                    </div>
                 </div>
                </form>
             </div>
         </div>
     </div>
 </div>
</div>
@endsection
@section('scripts')
  const deleteUrl = "{{ url('cart') }}/";
  const confirmDelete= "{{ __('shop.messages.delete_confirm') }}";
@endsection
@section('js-files')
@vite (['resources\js\delete.js'])
@endsection