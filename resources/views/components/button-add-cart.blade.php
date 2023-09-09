<div class="button">
    <button-add-cart
        title="@lang('catalog.buy')"
        title_on='<i class="fa-solid fa-cart-arrow-down"></i>'
        :id="{{$good->id}}"
        :store_qty="{{$good->quantity}}"
        :cart_qty="{{$cart_good_qty}}"
        :price="{{$good->price}}"
    ></button-add-cart>
</div>
