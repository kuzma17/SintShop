<div class="col-12 col-sm-6 col-md-4 col-lg-3 p-0">
    <div class="good-card">
        <a href="{{route('good', [$good->slug, $good->id])}}">
            <div class="photo">
                <img src="/images/goods/{{$good->photos->first()->src}}">
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
