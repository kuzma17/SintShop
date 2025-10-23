<div class="categories">

    <h1>{{__('menu.categories')}}</h1>

    <div class="row justify-content-center">
        @foreach($categories as $category)
            <div class="col-12 col-sm-6 col-md-3 p-0">
                <a href="{{route('catalog', $category->slug)}}">
                    <div class="category">
                        <img src="/images/{{$category->image}}" alt="{{$category->name}}">
                        <div class="title_category">
                            {{$category->name}}
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>
