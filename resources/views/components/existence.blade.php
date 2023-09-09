<div class="existence">
    @if($good->quantity > 0 && $good->quantity > 10)
        <span style="color: green">@lang('catalog.in_stock')</span>
    @elseif($good->quantity > 0 && $good->quantity <= 10)
        <span style="color: red">@lang('catalog.end_good') {{$good->quantity}} шт.</span>
    @else
        <span>@lang('catalog.expected')</span>
    @endif
</div>
