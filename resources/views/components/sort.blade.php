<div class="sort">
    <div class="row">
        <label class="col-auto">
            @lang('filter.sort'):
        </label>
        <div class="col p-0" >
            <div class="select dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                @lang('filter.'.$sort)
            </div>
            <div class="dropdown-menu">
                <div class="list-group" style="border-radius: 5px">
                    <a href="{{$route}}?sort=new" class="list-group-item list-group-item-action">@lang('filter.new')</a>
                    <a href="{{$route}}?sort=priceAsc" class="list-group-item list-group-item-action">@lang('filter.priceAsc')</a>
                    <a href="{{$route}}?sort=priceDesc" class="list-group-item list-group-item-action">@lang('filter.priceDesc')</a>
                </div>
            </div>
        </div>
    </div>
</div>
