<div class="search">
    <form name="search" method="get" action="{{route('search')}}">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="@lang('main.search_production')">
            <div class="input-group-btn">
                <button class="btn btn-default" type="submit">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>
        </div>
    </form>
</div>
