a@extends('layouts.app')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/cart_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/cart_responsive.css') }}">

    <!-- Cart -->

    <div class="cart_section">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="cart_container">
                        <div class="cart_title">Shopping Cart</div>
                        <div class="cart_items">
                            <ul class="cart_list">
                                @foreach ($cart as $item)
                                    <li class="cart_item clearfix">
                                        <div class="cart_item_image"><img src="{{ asset($item->options->image) }}"
                                                alt=""></div>
                                        <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
                                            <div class="cart_item_name cart_info_col">
                                                <div class="cart_item_title">Name</div>
                                                <div class="cart_item_text">{{ $item->name }}</div>
                                            </div>
                                            @if ($item->options->color == null)
                                            @else
                                                <div class="cart_item_quantity cart_info_col">
                                                    <div class="cart_item_title">Color</div>
                                                    <div class="cart_item_text">{{ $item->options->color }}</div>
                                                </div>
                                            @endif
                                            @if ($item->options->size == null)
                                            @else
                                                <div class="cart_item_quantity cart_info_col">
                                                    <div class="cart_item_title">Size</div>
                                                    <div class="cart_item_text">{{ $item->options->size }}</div>
                                                </div>
                                            @endif
                                            <div class="cart_item_quantity cart_info_col">
                                                <div class="cart_item_title">Quantity</div>
                                                <form method="post" action="{{ route('update.cartitem') }}">
                                                    @csrf
                                                    <input type="hidden" name="productid" value="{{ $item->rowId }}">
                                                    <br><br>
                                                    <input type="number" name="qty" value="{{ $item->qty }}"
                                                        style="width: 50px;">
                                                    <button type="submit" class="btn btn-success btn-sm"><i
                                                            class="fas fa-check-square"></i> </button>
                                                </form>
                                            </div>
                                            <div class="cart_item_price cart_info_col">
                                                <div class="cart_item_title">Price</div>
                                                <div class="cart_item_text">${{ $item->price }}</div>
                                            </div>
                                            <div class="cart_item_total cart_info_col">
                                                <div class="cart_item_title">Total</div>
                                                <div class="cart_item_text">${{ $item->qty * $item->price }}</div>
                                            </div>
                                            <div class="cart_item_total cart_info_col">
                                                <div class="cart_item_title">Action</div><br>
                                                <a href="{{ url('remove/cart/' . $item->rowId) }}"
                                                    class="btn btn-sm btn-danger">X</a>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Order Total -->
                        <div class="order_total">
                            <div class="order_total_content text-md-right">
                                <div class="order_total_title">Order Total:</div>
                                <div class="order_total_amount">${{ Cart::total() }}</div>
                            </div>
                        </div>

                        <div class="cart_buttons">
                            <button type="button" class="button cart_button_clear">All Cancels</button>
                            <a href="{{ route('user.checkout') }}" class="button cart_button_checkout">Checkout</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('frontend/js/cart_custom.js') }}"></script>
@endsection
