@extends('layouts.page')

@section('link', Breadcrumbs::render('cart'))

@section('title', __('cart.cart'))

@section('body')
    <div class="cart">
        <cart
            :goods="{{json_encode($goods)}}"
            :count="{{$cart_count}}"
            :sum="{{json_encode($total_sum)}}"
        ></cart>

        @if($cart_count > 0)
            @include('order.create')
        @endif

    </div>
@endsection
