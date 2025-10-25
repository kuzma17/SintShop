<div class="button">
    <button-add-cart
        title="@lang('catalog.buy')"
        title_on='<svg class="icon"><use xlink:href="#fa-cart-arrow-down"></use></svg>'
        :id="{{$good->id}}"
        :store_qty="{{$good->quantity? $good->quantity: 0}}"
        :cart_qty="{{$cart_good_qty}}"
        :price="{{$good->price}}"
    ></button-add-cart>
</div>
