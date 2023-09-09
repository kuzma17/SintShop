@extends('layouts.app')

@section('content')

<div class="container">
    <div class="link">
        {{ Breadcrumbs::render('cart') }}
    </div>

    <h4>@lang('cart.cart')</h4>

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
</div>

@endsection
