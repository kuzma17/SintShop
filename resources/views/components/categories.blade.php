<div class="categories">

    <h3>{{__('menu.categories')}}</h3>

    <div class="row justify-content-center">
        @foreach($categories as $category)
            <div class="col-12 col-sm-6 col-md-3 p-0">
                <a href="{{route('catalog', [$category->slug, $category->id])}}">
                    <div class="category">
                        <img src="/images/{{$category->image}}" >
                        <div class="title_category">
                            {{$category->title}}
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
            <div class="col-12 col-sm-6 col-md-3 p-0">
                <a href="{{route('page', 'repair')}}">
                    <div class="category">
                        <img src="/images/repair.jpg" >
                        <div class="title_category">
                            @lang('menu.repair')
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-12 col-sm-6 col-md-3 p-0">
                <a href="{{route('page', 'replacing-cartridges')}}">
                    <div class="category">
                        <img src="/images/services.jpg" >
                        <div class="title_category">
                            @lang('menu.replacing_cartridges')
                        </div>
                    </div>
                </a>
            </div>
    </div>
</div>
