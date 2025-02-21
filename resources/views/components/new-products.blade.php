@if($goods->count())
<div>
    <h3>Новинки</h3>
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
                <i class="fa-solid fa-chevron-left"></i>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselProducts" data-bs-slide="next">
                <i class="fa-solid fa-chevron-right"></i>
            </button>
        </div>
</div>
@endif