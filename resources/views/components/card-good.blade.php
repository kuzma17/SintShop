<div class="col-12 col-sm-6 col-md-{{$countRow}} col-lg-{{$countRow}} p-0">
    <div class="good-card">
        <a href="{{route('good', [$good->category->slug, $good->slug])}}">
            <div class="photo">
                @if($good->photos->count() > 0)
                    <img src="/images/goods/{{$good->first_photo->src}}">
                @else
                    <img src="/images/no_photo.jpg">
                @endif
            </div>
            <div class="title">
                {{$good->title}}
            </div>
        </a>
        <div class="row">
            <div class="col-6">
                <div class="price">
                    {{$good->price}} грн.
                </div>
            </div>
            <div class="col-6">
                <x-button-add-cart
                    :good=$good
                ></x-button-add-cart>
            </div>
        </div>
        <x-existence
            :good=$good
        ></x-existence>
    </div>
</div>
