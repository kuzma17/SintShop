<div class="categories">

    <h2>@lang('menu.categories')</h2>

    <div class="row justify-content-center">
        @foreach($categories as $category)
            <div class="col-3 p-0">
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
    </div>
</div>
