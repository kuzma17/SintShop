@if($goods->count())
<div>
    <h1>Новинки</h1>
        <div id="carouselProducts" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach($goods->chunk(4) as $item)
                    <div class="carousel-item @if($loop->first) active @endif">
                        <div class="row">
                            @foreach($item as $good)
                                <x-card-good
                                    :good="$good"
                                    type="new"
                                ></x-card-good>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselProducts" data-bs-slide="prev">
                <svg class="icon"><use xlink:href="#fa-chevron-left"></use></svg>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselProducts" data-bs-slide="next">
                <svg class="icon"><use xlink:href="#fa-chevron-right"></use></svg>
            </button>
        </div>
</div>
@endif